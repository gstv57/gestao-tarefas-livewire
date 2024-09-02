<x-modal wire:model="visibily" title="Criar uma nova Role">
    <div class="container mt-4">
        <div class="row">
            <!-- Coluna para o formulário de cadastro do role -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Nome do Role</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="roleName" wire:model="name" placeholder="Digite o nome do role" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="roleDescription" class="form-label">Descrição do Role</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="roleDescription" placeholder="Digite a descrição do role" rows="3"></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-auto d-flex justify-content-end">
                            <button type="submit" wire:click="save" class="btn btn-success">Salvar</button>
                            <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal" wire:click="$dispatchTo('role.role-create', 'close-modal')">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-secondary h-100">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Permissões do Sistema</h5>
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        @forelse($permissions as $permission)
                            <div class="form-check" wire:key="{{ $permission->id }}">
                                <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" wire:model="permissionsSelected" value="{{ $permission->id }}">
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">Nenhuma permissão cadastrada.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-modal>
