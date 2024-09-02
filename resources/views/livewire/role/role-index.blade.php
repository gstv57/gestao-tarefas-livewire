<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Lista de Roles</h4>
            <button class="btn btn-success" wire:click="$dispatchTo('role.role-create', 'show-modal')">Adicionar Role</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($roles as $role)
                        <tr wire:key="{{ $role->id }}">
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm text-white" wire:click="$dispatchTo('modal.role.role-edit', 'show-modal', { role: {{ $role->id }} })">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm" wire:click="destroyRole({{ $role->id }})" wire:confirm.prompt="Você tem certeza? \n\nDigite EXCLUIR para confirmar|EXCLUIR">
                                        <i class="bi bi-trash"></i> Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Nenhum role encontrado.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <livewire:role.role-create :permissions="$permissions"></livewire:role.role-create>
    <livewire:modal.role.role-edit :permissions="$permissions"></livewire:modal.role.role-edit>
    @script
        <script>
            $wire.on('role-deleted', () => {
                $wire.$refresh()
            });
        </script>
    @endscript
</div>
