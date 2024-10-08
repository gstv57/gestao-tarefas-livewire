<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Criar Usuário</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <form wire:submit="save">
                        <div class="form-group @error('name') {{ 'has-error' }} @enderror">
                            <label for="name">Nome</label>
                            <input wire:model="name" type="text" class="form-control" id="name" name="name" placeholder="Digite um nome">
                        </div>
                        <div class="form-group @error('email') {{ 'has-error' }} @enderror">
                            <label for="email">E-mail</label>
                            <input wire:model="email" type="email" class="form-control" id="email" name="email" placeholder="Digite um e-mail">
                        </div>
                        <div class="form-group @error('password') {{ 'has-error' }} @enderror">
                            <label for="password">Senha</label>
                            <div class="input-group">
                                <input wire:model="password" type="password" class="form-control" id="password" name="password" placeholder="Digite uma senha">
                            </div>
                        </div>

                        <div class="form-group @error('role_id') {{ 'has-error' }} @enderror">
                            <label for="role_id">Cargo</label>
                            <select wire:model="role_id" class="form-control" id="role_id" name="role_id">
                                    <option selected>Selecione uma opção de cargo</option>
                                @forelse($roles as $role)
                                    <option value="{{ $role->id }}">{{$role->name}}</option>
                                @empty
                                    <option selected>Nenhum cargo cadastrado.</option>
                                @endforelse
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button class="btn btn-warning text-white" wire:click="unfill()">Limpar</button>
                        <a href="{{route('usuarios.index')}}" wire:navigate class="btn btn-danger">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
