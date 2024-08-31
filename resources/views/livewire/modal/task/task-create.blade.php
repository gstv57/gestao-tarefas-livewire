<x-modal title="Criar Task Nova" wire:model="visibily">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Digite o nome" wire:model="nome">
        @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <button wire:click="save" class="btn btn-primary">Cadastrar</button>
        <button id="fechar" class="btn btn-danger" wire:click="dispatchTo('modal.task.task-create', 'close-modal')">Fechar</button>
    </div>
</x-modal>
