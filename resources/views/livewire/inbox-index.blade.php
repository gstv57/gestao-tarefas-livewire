<div class="container-fluid">
    <div class="row">
        <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" wire:click="$dispatchTo('modal.inbox.create-message', 'show-modal')">Nova Mensagem</button>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="inbox-tab" data-bs-toggle="tab" data-bs-target="#inbox" type="button" role="tab" aria-controls="inbox" aria-selected="true">Caixa de Entrada</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sent-tab" data-bs-toggle="tab" data-bs-target="#sent" type="button" role="tab" aria-controls="sent" aria-selected="false">Mensagens Enviadas</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
                            <div class="list-group">
                                @forelse($receivedMessages as $mensagem)
                                    <div class="message-item">
                                        <div class="message-content">
                                            <h5 class="mb-1">{{ $mensagem->content }}</h5>
                                            <p class="mb-1">Remetente: {{ $mensagem->sender->name }}</p>
                                            <small>3 dias atrás</small>
                                        </div>
                                        <div class="message-options">
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Ver detalhes</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-reply"></i> Responder</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Excluir</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-info" role="alert">
                                        Não há mensagens recebidas.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
                            <div class="list-group">
                                @forelse($sentMessages as $mensagem)
                                    <div class="message-item">
                                        <div class="message-content">
                                            <h5 class="mb-1">{{ $mensagem->content }}</h5>
                                            <p class="mb-1">Para: {{ $mensagem->receiver->name }}</p>
                                            <small>{{ $mensagem->created_at->diffForHumans() }}</small>
                                        </div>
                                        <div class="message-options">
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Ver detalhes</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Editar</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Excluir</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-info" role="alert">
                                        Não há mensagens enviadas.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <livewire:modal.inbox.create-message></livewire:modal.inbox.create-message>
    <style>
        .message-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .message-content {
            flex-grow: 1;
        }
        .message-options {
            margin-left: 10px;
        }
    </style>
</div>
