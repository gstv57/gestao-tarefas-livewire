<x-modal wire:model="visibily" title="Criar colunas novas">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Digite o nome" wire:model="nome">
        @error('nome')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="posicao">Posição:</label>
        <input type="number" id="posicao" class="form-control @error('posicao') is-invalid @enderror" placeholder="Digite a posição" wire:model="posicao">
        @error('posicao')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <button id="cadastrar" wire:click="save" class="btn btn-primary">Cadastrar</button>
        <button id="fechar" class="btn btn-danger" wire:click="dispatchTo('modal.group.group-create', 'close-modal')">Fechar</button>
    </div>
</x-modal>
