<?php

namespace App\Livewire;

use App\Models\InboxMessage;
use Livewire\Attributes\On;
use Livewire\Component;

class InboxIndex extends Component
{
    public $sentMessages;

    public $receivedMessages;

    public function render()
    {
        return view('livewire.inbox-index')->layout('layouts.app');
    }
    public function mount()
    {
        $this->getMessagesInbox();
    }
    #[On('created-message')]
    public function getMessagesInbox()
    {
        $user = auth()->id();

        $messages = InboxMessage::where('sender_id', $user)
            ->orWhere('receiver_id', $user)
            ->paginate(10);

        $this->sentMessages     = $messages->where('sender_id', $user)->sortByDesc('created_at');
        $this->receivedMessages = $messages->where('receiver_id', $user);
    }
}
