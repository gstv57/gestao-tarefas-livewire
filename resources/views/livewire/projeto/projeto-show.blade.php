<div class="container-fluid content bg-dark text-light py-5">
    <div class="row g-2"
         x-data=""
         x-init="Sortablejs.create($el, {
                animation: 150,
                handle: '.drag-handle',
                onSort({ to }) {
                    const group_ids = Array.from(to.children).map(item => item.getAttribute('group-id'))
                    @this.reorderGroups(group_ids);
                }
             })"
    >
        @if($projeto->board)
            @foreach($projeto->board->groups->sortBy('position') as $group)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" group-id="{{ $group->id }}">
                    <div class="card bg-body h-100">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h5 class="card-title mb-0 text-black">{{ $group->name }}</h5>
                            <i class="fas fa-grip-vertical drag-handle" style="cursor: grab;"></i>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="flex-grow-1 mb-3"
                                 group-id="{{ $group->id }}"
                                 x-data=""
                                 x-init="Sortablejs.create($el, {
                                        animation: 150,
                                        group: 'group',
                                        onSort({ to }) {
                                            const groupId = to.getAttribute('group-id');
                                            const tasksIds = Array.from(to.children).map(item => item.getAttribute('task-id'))
                                            @this.reorderTasks({ groupId, tasksIds })
                                        }
                                     })">
                                @foreach($group->tasks->sortBy('position') as $task)
                                    <div task-id="{{ $task->id }}"
                                         class="p-2 mb-2 bg-dark text-light rounded cursor-pointer d-flex flex-column justify-content-between align-items-start">
                                        <!-- Nome da Tarefa -->
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <span>{{ $task->name }}</span>
                                            {{-- Botão para detalhes --}}
                                            <button
                                                wire:click="$dispatchTo('modal.task.detail.detail-show', 'show-modal', { task: {{ $task->id }} })"
                                                class="btn btn-info btn-sm" title="Ver mais detalhes">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>

                                        <!-- Barra de Progresso -->
                                        <div class="w-100 mt-2">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated
                                                    {{ $this->calculateProgress($task->id) < 33 ? 'bg-danger' : ($this->calculateProgress($task->id) < 66 ? 'bg-warning' : 'bg-success') }}"
                                                     role="progressbar"
                                                     style="width: {{ $this->calculateProgress($task->id) }}%"
                                                     aria-valuenow="{{ $this->calculateProgress($task->id) }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    {{ $this->calculateProgress($task->id) }}%
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                @endforeach

                            </div>
                            <button class="btn btn-primary btn-sm w-100"
                                    wire:click="$dispatchTo('modal.task.task-create', 'show-modal', { id: {{ $group->id }} })">
                                <i class="fas fa-plus me-1"></i> Nova Tarefa
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @can('settings-projeto')
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 flex">
            <div class="card bg-body mt-4">
                <div class="card-header d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-title mb-0 text-black">Configurações</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1 mb-3">
                        <button
                            class="btn btn-dark btn-sm w-100"
                            wire:click="$dispatchTo('modal.projeto.attach-user', 'show-modal')"
                        >
                            <i class="fas fa-user me-1"></i> Adicionar um usuário
                        </button>
                    </div>

                    <div class="flex-grow-1 mb-3">
                        <button
                            class="btn btn-dark btn-sm w-100"
                            wire:click="$dispatchTo('modal.projeto.list-user-project', 'show-modal')"
                        >
                            <i class="fas fa-user me-1"></i> Ver Usuários Ativos
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="mt-4 text-center">
        <button class="btn btn-success" x-data @click="Livewire.dispatchTo('modal.group.group-create', 'show-modal')">
            <i class="fas fa-plus me-1"></i> Nova Coluna
        </button>
    </div>

    @can('create-task')
        <livewire:modal.task.task-create></livewire:modal.task.task-create>
    @endcan

    @can('create-group')
        <livewire:modal.group.group-create :board="$projeto->board->id"></livewire:modal.group.group-create>
    @endcan

    @can('attach-user-projeto')
        <livewire:modal.projeto.attach-user :projeto="$projeto->id"></livewire:modal.projeto.attach-user>
    @endcan

    @can('list-user-projeto')
        <livewire:modal.projeto.list-user-project :projeto="$projeto->id"></livewire:modal.projeto.list-user-project>
    @endcan

    @can('detail-task')
        <livewire:modal.task.detail.detail-show></livewire:modal.task.detail.detail-show>
    @endcan

    @can('upload-file-task')
        <livewire:modal.task.detail.file.file-upload></livewire:modal.task.detail.file.file-upload>
    @endcan

    <style>
        .card {
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        .btn-success:hover {
            background-color: #157347;
            border-color: #146c43;
        }
    </style>
</div>
