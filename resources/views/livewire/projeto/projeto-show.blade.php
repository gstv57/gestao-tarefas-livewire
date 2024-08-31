<main class="content">
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
                            <div class="text-center card-header">
                                <h5 class="card-title">{{ $group->name }}</h5>
                                <i class="fas fa-grip-vertical drag-handle" style="cursor: grab;" id="cursor-move"></i>
                            </div>
                            <div class="p-3 card-body" style="background-color: #1a2035; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">
                                <div class="mb-3 card bg-light" style="border-radius: 5px;"
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
                                             class="p-3 cursor-pointer card-body position-relative" style="background-color: #1a2035; border-radius: 5px; margin: 1px; color: white;">
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
                                                <div class="top-0 p-2 dropdown position-absolute end-0">
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
                                <a href="#" class="btn btn-primary btn-sm">Criar</a>
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
</main>
