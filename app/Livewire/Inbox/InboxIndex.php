<?php

namespace App\Livewire\Inbox;

use App\Models\{InboxMessage};
use Livewire\Attributes\On;
use Livewire\Component;

class InboxIndex extends Component
{
    public $sentMessages;

    public $receivedMessages;

    public $user;
    public function getListeners()
    {
        return [
            "echo:inbox.{$this->user->id},SendMessageEvent" => 'receiveMessage',
        ];
    }
    public function render()
    {
        return view('livewire.inbox-index')->layout('layouts.app');
    }
    public function mount()
    {
        $this->user = auth()->user();
        $this->getMessagesInbox();
    }
    #[On('created-message')]
    public function getMessagesInbox()
    {
        $user     = auth()->id();
        $messages = InboxMessage::with('sender', 'receiver')
            ->where('sender_id', $user)
            ->orWhere('receiver_id', $user)
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $this->sentMessages     = $messages->where('sender_id', $user)->sortByDesc('created_at');
        $this->receivedMessages = $messages->where('receiver_id', $user);
    }
    public function receiveMessage()
    {
        $this->getMessagesInbox();
        $this->dispatch('$refresh')->self();
    }
}
