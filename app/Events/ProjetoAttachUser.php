<?php

namespace App\Events;

use App\Models\Projeto;
use Illuminate\Broadcasting\{Channel, InteractsWithSockets};
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjetoAttachUser implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $users;

    public Projeto $projeto;
    public function __construct(array $users_ids, PRojeto $projeto)
    {
        $this->users   = $users_ids;
        $this->projeto = $projeto;
    }
    public function broadcastOn(): array
    {
        return array_map(function ($user_id) {
            return new Channel('user-attach.' . $user_id);
        }, $this->users);
    }

    public function broadcastWith(): array
    {
        return ['projeto' => $this->projeto];
    }
}
