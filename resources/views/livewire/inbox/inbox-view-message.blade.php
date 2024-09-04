<div class="container-fluid shadow bg-white">
    <div class="chat-header d-flex align-items-center p-2 border-bottom">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="Foto de perfil" class="rounded-circle me-2" style="width: 40px; height: 40px;">
        <div>
            <h5 class="mb-0"></h5>
            <small class="text-muted">
                <span class="status-indicator text-success">
                    {{ $sender_id->name }} ●
                </span>
                    Online
            </small>
        </div>
    </div>

    <div class="chat-body" id="chat-body border border-dark">
        @forelse($messages as $message)
            @if(auth()->user()->id === $message->sender_id)
                <div class="message message-sent text-end" wire:key="{{ $message->id }}">
                    <p>{{ $message->content }}</p>
                    <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                </div>
            @elseif(auth()->user()->id === $message->receiver_id)
                <div class="message message-received text-start" wire:key="{{ $message->id }}">
                    <p>{{ $message->content }}</p>
                    <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                </div>
            @endif
        @empty
            <p>Sem mensagens disponíveis.</p>
        @endforelse
    </div>
    <div class="chat-footer p-2">
        <div class="input-group">
            <textarea class="form-control" aria-label="Digite sua mensagem" placeholder="Digite sua mensagem..." wire:keydown.enter="sendMessage" wire:model="content"></textarea>
        </div>
    </div>

    <style>
        .chat-header img {
            object-fit: cover;
        }
        .status-indicator {
            font-size: 0.75em;
            margin-right: 0.25em;
        }
        .message-sent {
            background-color: #dcf8c6; /* Cor de fundo para mensagens enviadas */
            margin-left: auto; /* Alinhamento à direita */
            padding: 5px;
            border-radius: 6px;
            max-width: 60%;
            margin-top: 2px;
            margin-bottom: 2px;
            border: 1px solid #8fdf82;

        }

        .message-received {
            background-color: #ea868f;
            margin-right: auto; /* Alinhamento à esquerda */
            padding: 5px;
            border-radius: 6px;
            max-width: 60%;
            margin-top: 2px;
            margin-bottom: 2px;
            border: 1px solid #EA4d56;
        }
    </style>
</div>
