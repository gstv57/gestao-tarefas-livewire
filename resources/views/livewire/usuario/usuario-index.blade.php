<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Gerenciador de Usuários</h3>
            <a href="{{ route('usuarios.create') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Adicionar Usuário
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar por nome ou email..." aria-label="Buscar por nome ou email" wire:model.live="search">
                        <button class="btn btn-light" type="button">
                            <i class="bi bi-x-circle"></i> Limpar
                        </button>
                    </div>
                </div>
{{--                <div class="col-md-4">--}}
{{--                    <div class="input-group">--}}
{{--                        <label class="input-group-text" for="filtroCargo"><i class="bi bi-filter"></i></label>--}}
{{--                        <select class="form-select" id="filtroCargo" wire:model="role">--}}
{{--                            <option value="all" selected>Todos os Cargos</option>--}}
{{--                            @foreach($roles as $role)--}}
{{--                                <option value="{{ $role->name }}">{{ $role->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <table class="table table-hover table-striped">
                <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Ação</th>
                </tr>
                </thead>
                <tbody>
                @forelse($usuarios as $usuario)
                    <tr wire:key="{{ $usuario->id }}">
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            @foreach($usuario->roles as $role)
                                <span class="badge bg-dark"><b>{{ $role->name }}</b></span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('usuarios.show', $usuario->id) }}" wire:navigate class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <a href="{{ route('usuarios.show', $usuario->id) }}" wire:navigate class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="confirm('Tem certeza que deseja excluir este usuário?') || event.stopImmediatePropagation()" wire:click="delete({{ $usuario->id }})">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-4">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</div>
