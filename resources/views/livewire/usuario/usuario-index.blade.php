<div class="card">
    <div class="card-header">
        <div class="card-title">Usúarios</div>
    </div>
    <div class="card-body">
        <table class="table table-head-bg-primary mt-4">
            <thead>
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
                <tr>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->role->name ?? ''}}</td>
                    <td>
                        <a href="{{route('usuarios.show', $usuario->id) }}" wire:navigate.hover class="btn btn-primary btn-rounded">Ver</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $usuarios->links() }}
    </div>
</div>
