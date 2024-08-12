<div class="form-container bg-light rounded shadow-sm p-4">
    <h1 class="mb-4">Criar Novo Projeto</h1>
    <form wire:submit="store" method="POST">
        @csrf
        <div class="mb-3 @error('name') {{ 'has-error' }} @enderror">
            <label for="name" class="form-label">Nome do Projeto</label>
            <input type="text" class="form-control" id="name" name="name" wire:model="name">
        </div>

        <div class="mb-3 @error('name') {{ 'has-error' }} @enderror">
            <label for="visibility" class="form-label">Visibilidade</label>
            <select class="form-select" id="visibility" name="visibility" wire:model="visibility">
                <option value="public">Público</option>
                <option value="private">Privado</option>
            </select>
        </div>

        <div class="mb-3 @error('name') {{ 'has-error' }} @enderror">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" id="description" name="description" rows="3" wire:model="description"></textarea>
        </div>

        <div class="mb-3 @error('name') {{ 'has-error' }} @enderror">
            <label for="priority" class="form-label">Prioridade</label>
            <select class="form-select" id="priority" name="priority" wire:model="priority">
                <option value="low">Baixa</option>
                <option value="medium">Média</option>
                <option value="high">Alta</option>
            </select>
        </div>

        <div class="mb-3 @error('name') {{ 'has-error' }} @enderror">
            <label for="start_date" class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="start_date" name="start_date" wire:model="start_date">
        </div>

        <div class="mb-3 @error('name') {{ 'has-error' }} @enderror">
            <label for="end_date" class="form-label">Data de Término</label>
            <input type="date" class="form-control" id="end_date" name="end_date" wire:model="end_date">
        </div>

        <button type="submit" class="btn btn-primary">Criar Projeto</button>
    </form>
</div>
