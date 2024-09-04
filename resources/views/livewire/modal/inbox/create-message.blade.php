<div>
    <x-modal wire:model="visibily" title="Enviar uma nova mensagem">
        <div class="card-body">
            <form wire:submit="sendMessage">
                <!-- Campo de Destinatário -->
                <div class="mb-3" x-data="{ open: false, to: $wire.entangle('to').live }">
                    <label for="recipient" class="form-label">Destinatário</label>
                    <input type="text" class="form-control" id="recipient" placeholder="Digite o nome ou email do destinatário" required
                           x-model="to" @focus="open = true">

                    <!-- Lista de usuários filtrados -->
                    <div class="list-group mt-2" x-show="open && $wire.to.length > 0"
                         x-transition:enter.duration.550ms
                         x-transition:leave.duration.800ms
                         x-transition:enter.scale.60
                         x-transition:leave.scale.60
                        >
                        @foreach($users as $user)
                            <a href="#" class="list-group-item list-group-item-action" @click="open = false; to = '{{ $user->email }}'" wire:click.prevent="$set('to', '{{ $user->email }}')">
                                {{ $user->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Campo de Conteúdo da Mensagem -->
                <div class="mb-3">
                    <label for="messageContent" class="form-label">Conteúdo</label>
                    <textarea wire:model="content" class="form-control" id="messageContent" rows="5" placeholder="Digite a sua mensagem aqui..." required></textarea>
                </div>

                <!-- Botão de Envio -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                </div>
            </form>
        </div>
    </x-modal>

</div>
