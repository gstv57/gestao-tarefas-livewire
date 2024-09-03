<?php

namespace App\Livewire\Modal\Inbox;

use App\Livewire\InboxIndex;
use App\Livewire\Traits\IsModal;
use App\Models\{InboxMessage, User};
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateMessage extends Component
{
    use IsModal;

    use LivewireAlert;

    public $to = '';

    public $content;

    public $users = [];

    public function render()
    {
        $this->users = User::where('name', 'like', '%' . $this->to . '%')
            ->orWhere('email', 'like', '%' . $this->to . '%')
            ->get();

        return view('livewire.modal.inbox.create-message');
    }

    public function sendMessage()
    {
        $this->validate([
            'to'      => ['required', 'exists:users,email'],
            'content' => ['required', 'string'],
        ]);

        try {
            InboxMessage::create([
                'inbox_id'    => auth()->user()->inbox->id,
                'sender_id'   => auth()->id(),
                'receiver_id' => $this->getUser($this->to),
                'content'     => $this->content,
                'type'        => InboxMessage::TYPE_SENT,
                'created_at'  => Carbon::parse(now())->format('d-m-Y H:i:s'),
                'updated_at'  => Carbon::parse(now())->format('d-m-Y H:i:s'),
            ]);

            $this->alert('success', 'Mensagem enviada com sucesso!');
            $this->dispatch('close-modal')->self();
            $this->dispatch('created-message')->to(InboxIndex::class);

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
    private function getUser(string $mail): int
    {
        return User::where('email', $mail)->first()->id;
    }

    #[On('hidden')]
    public function cleanup()
    {
        $this->to      = '';
        $this->content = '';
        $this->users   = [];
    }
}
