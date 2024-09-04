<?php

namespace App\Livewire;

use App\Models\{InboxMessage, Notification};
use Exception;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class HeaderLayout extends Component
{
    use LivewireAlert;
    public $inbox_not_read = [];

    public $notifications = [];

    public int $total_unread_notifications;
    public $all_notifications = [];

    public $user;
    public function getListeners()
    {
        return [
            "echo:inbox.{$this->user->id},SendMessageEvent"        => 'receiveMessage',
            "echo:user-attach.{$this->user->id},ProjetoAttachUser" => 'projetoAttachForMe',
        ];
    }
    public function render()
    {
        return view('livewire.header-layout');
    }
    public function mount()
    {
        $this->user = auth()->user();
        $this->getNotifications();
    }
    protected function getNotifications()
    {
        $this->inbox_not_read = InboxMessage::with('sender')
            ->where('receiver_id', auth()->user()->id)
            ->where('read', false)
            ->get()
            ->toArray();
        $inbox_not_read_count = count($this->inbox_not_read);

        $this->notifications = Notification::with('user')
            ->where('user_id', auth()->user()->id)
            ->where('read', false)
            ->orderBy('created_at', 'ASC')
            ->get()
            ->toArray();

        $notifications_count              = count($this->notifications);
        $this->all_notifications          = array_merge($this->inbox_not_read, $this->notifications);
        $this->total_unread_notifications = $inbox_not_read_count + $notifications_count;

        // dd($this->all_notifications); // Debug, se necessário
    }
    public function receiveMessage()
    {
        $this->getNotifications();
        $this->dispatch('$refresh')->self();
    }
    public function projetoAttachForMe($event)
    {
        DB::beginTransaction();
        try {
            Notification::create([
                'title'   => Notification::PROJETO_NOTIFICATION_TITLE . $event['projeto']['name'],
                'body'    => Notification::PROJETO_NOTIFICATION_BODY,
                'type'    => Notification::PROJETO_NOTIFICATION_TYPE,
                'user_id' => $this->user->id,
            ]);
            DB::commit();
            $this->getNotifications();
            $this->alert('success', 'Você foi vinculado a um projeto.');
            $this->dispatch('$refresh')->self();
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }
}
