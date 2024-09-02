<x-modal title="Detalhes" wire:model="visibily">
    <div class="row">
        <!-- Seção Principal -->
        <div class="col-md-7">
            <!-- Input para o Título da Tarefa -->
            <div class="mb-3">
                <label for="taskTitle" class="form-label">Título</label>
                <input type="text" class="form-control" id="taskTitle" placeholder="Digite o título da tarefa" wire:model="name">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Input para a Descrição da Tarefa -->
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Descrição</label>
                <textarea class="form-control" id="taskDescription" rows="5" placeholder="Digite a descrição da tarefa" wire:model="description"></textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Seção de Anexos -->
            <div class="mb-3 d-flex">
                <div class="me-2 flex-grow-1">
                    <label for="taskAttachments" class="form-label">Anexos</label>
                    <input type="file" class="form-control" id="taskAttachments" wire:model="files" multiple>
                    @error('files.*') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button type="button" class="btn btn-sm btn-info align-self-end" title="Ver Arquivos Existentes"
                        wire:click="$dispatchTo('modal.role.role-edit', 'show-modal', { task: {{ $task->id ?? '' }} })">
                    <i class="fas fa-folder"></i>
                </button>
            </div>
        </div>
        <!-- Seção Lateral -->
        <div class="col-md-5">
            <div class="mt-4">
                @if($user_in_task)
                    <button class="btn btn-danger w-100 mb-2" wire:click="unjoinTask">
                        <i class="fas fa-sign-out-alt me-2"></i> Sair
                    </button>
                @else
                    <button class="btn btn-success w-100 mb-2" wire:click="joinTask">
                        <i class="fas fa-sign-in-alt me-2"></i> Juntar-se
                    </button>
                @endif
            </div>
            <!-- Data de Início -->

            <div class="mb-3">
                <label for="startDate" class="form-label">Data de Início</label>
                <input type="date" class="form-control" id="startDate" wire:model="started_at">
            </div>

            <!-- Data de Fim -->
            <div class="mb-3">
                <label for="endDate" class="form-label">Data de Fim</label>
                <input type="date" class="form-control" id="endDate" wire:model="finished_at">
            </div>

            <!-- Usuários da Tarefa -->
            <div class="mb-3">
                <ul class="list-group shadow-sm">
                    @if(!empty($task->users))
                        @foreach($task->users as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle text-info me-3"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <span class="fw-bold">{{ Str::limit($user->name, 10) }}</span>
                                </div>

                                <div>
                                    <span class="badge bg-success rounded-pill px-2 py-1 small">
                                        <i class="fas fa-check-circle me-1"></i> Live
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <button class="btn btn-primary" wire:click="save">Salvar</button>
                <button id="fechar" class="btn btn-danger" wire:click="dispatchTo('modal.task.detail.detail-show', 'close-modal')">Cancelar</button>
            </div>
        </div>
    </div>
</x-modal>
