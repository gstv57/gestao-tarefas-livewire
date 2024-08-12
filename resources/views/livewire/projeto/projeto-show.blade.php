<main class="content">
    @livewire('projeto.toolbar.toolbar-show')
    <div class="container-fluid">
{{--        <livewire:projeto.participante.participante-show :participantes="$projeto->users"></livewire:projeto.participante.participante-show>--}}
        <div class="row"
             x-data=""
             x-init="Sortablejs.create($el, {
                animation: 150,
                handle: '#cursor-move',
                onSort({ to }) {
                    const group_ids = Array.from(to.children).map(item => item.getAttribute('group-id'))
                    @this.reorderGroups(group_ids);
                }
             })"
        >
            @if($projeto->board)
                @foreach($projeto->board->groups->sortBy('position') as $group)
                    <div class="col-12 col-lg-6 col-xl-3" group-id="{{ $group->id }}" style="border-radius: 5px;">
                        <div class="card card-border-primary" style="border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; border: 1px solid black;">
                            <div class="card-header text-center">
                                <h5 class="card-title">{{ $group->name }}</h5>
                                <i class="fas fa-grip-vertical drag-handle" style="cursor: grab;" id="cursor-move"></i>
                            </div>
                            <div class="card-body p-3" style="background-color: #1a2035; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">
                                <div class="card mb-3 bg-light" style="border-radius: 5px;"
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
                                     })"
                                >
                                    @foreach($group->tasks->sortBy('position') as $task)
                                        <div task-id="{{ $task->id }}"
                                             class="card-body p-3 cursor-pointer position-relative" style="background-color: #1a2035; border-radius: 5px; margin: 1px; color: white;">
                                            <p>
                                                {{ $task->name }}
                                            </p>
                                            @if($task->user_id)
                                                <div class="float-right mt-1">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" width="32" height="32" class="rounded-circle" alt="Avatar">
                                                    {{ $task->user->name ?? '' }}
                                                </div>
                                            @endif
                                            @if(!$task->user_id)
                                                <div class="dropdown position-absolute top-0 end-0 p-2">
                                                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li><a class="dropdown-item" href="#" wire:click="attachForMe({{ $task->id }})">Vincular a mim</a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="btn btn-primary btn-sm">Add new</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <style>
            body{
                margin-top:20px;
                background: #fafafa
            }
            .card {
                margin-bottom: 1.5rem;
                box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .025)
            }
            .card-border-primary {
                border-top: 4px solid #2979ff
            }
            .card-header {
                border-bottom-width: 1px
            }
            .card-actions a {
                color: #495057;
                text-decoration: none
            }
            .card-actions svg {
                width: 16px;
                height: 16px
            }
            .card-title {
                font-weight: 500;
                margin-top: .1rem
            }

            .card-table tr td:first-child,
            .card-table tr th:first-child {
                padding-left: 1.25rem
            }

            .card-table tr td:last-child,
            .card-table tr th:last-child {
                padding-right: 1.25rem
            }
            .card {
                margin-bottom: 1.5rem;
                box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,.025);
            }
            .card {
                position: relative;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #e5e9f2;
                border-radius: .2rem;
            }

            .card-header:first-child {
                border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
            }

            .card-header {
                border-bottom-width: 1px;
            }
            .card-header {
                padding: .75rem 1.25rem;
                margin-bottom: 0;
                color: inherit;
                background-color: #fff;
                border-bottom: 1px solid #e5e9f2;
            }

        </style>
    </div>
    <div class="container mt-5">
        <div class="modal fade" id="slideOver" tabindex="-1" aria-labelledby="slideOverLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-end">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1a2035; color: white;">
                        <h5 class="modal-title" id="slideOverLabel">Adicionar Membros</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Conteúdo do slide over -->
                        <div class="border border-solid border-dark rounded-3 p-3 d-flex flex-column">
                           <form wire:submit="attachMember">
                               <label for="usersSelect" class="form-label">Usuários</label>
                               <select id="usersSelect" class="form-select mb-2" wire:model="membro">
                                   <option>Escolha um usúario</option>
                                   @foreach($membros as $membro)
                                       <option value="{{ $membro->id }}">{{ $membro->name }}</option>
                                   @endforeach
                               </select>
                               <div class="d-flex justify-content-end">
                                   <button class="btn btn-dark">Vincular</button>
                               </div>
                           </form>
                        </div>

                        <div class="border border-solid border-dark rounded-3 p-3 d-flex flex-column mt-2">
                            <span class="text-center bg-dark text-white">Lista de Usúarios no Projeto</span>
                            <ul>
                                @foreach($membros_existentes as $membro)
                                    <li>{{ $membro->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
