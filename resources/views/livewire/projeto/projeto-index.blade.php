<div class="container-fluid">
    <h1 class="h3 mb-3">Projetos</h1>
    <div class="row">
        <!-- Card Template for Project -->
        @foreach ($projetos as $projeto)
            <div class="col-12 col-lg-6 col-xl-4 mb-4">
                <div class="card card-border-{{ $projeto->status }}">
                    <div class="card-header">
                        <h5 class="card-title">{{ $projeto->name }}</h5>
                        <small class="text-muted">{{ $projeto->status_text }}</small>
                    </div>
                    <div class="card-body">
                        <p>{{ $projeto->description }}</p>
                        <a href="{{ route('projetos.show', $projeto->id) }}" wire:navigate class="btn btn-primary btn-block">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
