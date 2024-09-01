<x-modal title="Vincular Usuário ao Projeto" wire:model="visibily" class="modal-lg">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3">Usuários Disponíveis</h5>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Buscar usuário..." wire:model.live="query" />
                    </div>
                </div>
                @if(!empty($users))
                    <div class="list-group user-list-scroll mb-3">
                        @forelse($users as $user)
                            <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" wire:click="usersSelected('{{ $user->id }}')">
                                <span>{{ $user->name }}</span>
                                <i class="fas fa-plus-circle text-primary"></i>
                            </button>
                        @empty
                            <div class="list-group-item text-muted">Sem usuários disponíveis para cadastrar</div>
                        @endforelse
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <h5 class="mb-3">Usuários Selecionados</h5>
                @if(!empty($users_selected))
                    <div class="list-group user-list-scroll mb-3">
                        @foreach($users_selected as $user)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $user->name }}</span>
                                <button class="btn btn-outline-danger btn-sm" wire:click="removeUserSelected({{ $user->id }})" title="Remover usuário">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">Nenhum usuário selecionado</div>
                @endif
            </div>
        </div>
    </div>
    <div class="mt-4 text-end">
        <button id="fechar" class="btn btn-danger" wire:click="dispatchTo('modal.projeto.attach-user', 'close-modal')">Cancelar</button>
        <button type="button" class="btn btn-primary" wire:click="attachUser">Vincular Usuários</button>
    </div>

    <style>
        .user-list-scroll {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }
        .user-list-scroll .list-group-item {
            border-left: none;
            border-right: none;
            border-radius: 0;
        }
        .user-list-scroll .list-group-item:first-child {
            border-top: none;
        }
        .user-list-scroll .list-group-item:last-child {
            border-bottom: none;
        }
        .user-list-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .user-list-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,.2);
            border-radius: 3px;
        }
        .user-list-scroll::-webkit-scrollbar-track {
            background-color: rgba(0,0,0,.1);
        }
        .modal-lg {
            max-width: 800px;
        }
    </style>
</x-modal>
