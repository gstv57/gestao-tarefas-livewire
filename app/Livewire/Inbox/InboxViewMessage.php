<?php

namespace App\Livewire\Inbox;

use App\Events\SendMessageEvent;
use App\Models\{InboxMessage, User};
use Carbon\Carbon;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class InboxViewMessage extends Component
{
    use LivewireAlert;

    public $messages = [];

    public string $content = '';

    public $sender_id;

    public $user;

    public function getListeners()
    {
        return [
            "echo:inbox.{$this->user->id},SendMessageEvent" => 'receiveMessage',
        ];
    }

    public function render()
    {
        $this->markReadMessage($this->messages);

        return view('livewire.inbox.inbox-view-message')->layout('layouts.app');
    }

    public function mount(User $sender_id)
    {
        $this->user      = auth()->user();
        $this->sender_id = $sender_id;
        $this->getMessageBetweenUsers();
    }
    #[On('send-message')]
    public function getMessageBetweenUsers()
    {
        $this->messages = InboxMessage::with('sender', 'receiver')
            ->where(function ($query) {
                $query->where('sender_id', $this->sender_id->id)
                    ->where('receiver_id', auth()->user()->id);
            })
            ->orWhere(function ($query) {
                $query->where('receiver_id', $this->sender_id->id)
                    ->where('sender_id', auth()->user()->id);
            })
            ->orderBy('created_at')
            ->get();
    }
    public function sendMessage()
    {
        try {
            InboxMessage::create([
                'inbox_id'    => auth()->user()->id,
                'receiver_id' => $this->sender_id->id,
                'sender_id'   => auth()->user()->id,
                'content'     => $this->content,
                'type'        => InboxMessage::TYPE_SENT,
                'created_at'  => Carbon::parse(now())->format('d-m-Y H:i:s'),
            ]);
            $this->dispatch('send-message')->self();
            $this->content = '';
            event(new SendMessageEvent($this->sender_id->id));
            $this->alert('success', 'Mensagem enviada com sucesso!');
        } catch (Exception $e) {
            $this->alert('error', 'Algo de errado ao enviar a mensagem!');
        }
    }
    public function editMessage(InboxMessage $message)
    {
        try {
            if (auth()->user()->id === $message->sender_id) {
                // user can edit post
            }
        } catch (Exception $e) {
            $this->alert('error', 'Algo de errado ao editar a mensagem!');
        }
    }
    public function receiveMessage()
    {
        $this->getMessageBetweenUsers();
        $this->dispatch('$refresh')->self();
    }
    // remover esse metodo apos criação de um component para chatlive, por enquanto, quando um chat é aberto, ele marca todas as mensagens como read.
    public function markReadMessage($messages)
    {
        $ids = [];

        foreach ($messages as $message) {
            if (auth()->user()->id === $message->receiver_id) {
                $ids[] = $message->id;
            }
        }
        InboxMessage::whereIn('id', $ids)->update(['read' => true]);
    }
}
