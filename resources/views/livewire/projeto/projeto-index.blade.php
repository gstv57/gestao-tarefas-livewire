<main class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-3">Projetos Ativos</h1>
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
                            <a href="{{ route('projetos.show', $projeto->id) }}" class="btn btn-primary btn-block">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <style>
            body {
                margin-top: 20px;
                background: #fafafa;
            }

            .card {
                margin-bottom: 1.5rem;
                box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .025);
            }

            .card-border-primary {
                border-top: 4px solid #2979ff;
            }

            .card-border-secondary {
                border-top: 4px solid #efefef;
            }

            .card-border-success {
                border-top: 4px solid #00c853;
            }

            .card-border-info {
                border-top: 4px solid #3d5afe;
            }

            .card-border-warning {
                border-top: 4px solid #ff9100;
            }

            .card-border-danger {
                border-top: 4px solid #ff1744;
            }

            .card-border-light {
                border-top: 4px solid #f8f9fa;
            }

            .card-border-dark {
                border-top: 4px solid #6c757d;
            }

            .card-header {
                border-bottom-width: 1px;
            }

            .card-title {
                font-weight: 500;
                margin-top: .1rem;
            }

            .card-body {
                padding: 1.25rem;
            }

            .btn-block {
                display: block;
                width: 100%;
                padding: .75rem;
                border-radius: .2rem;
                text-align: center;
            }
        </style>
    </div>
</main>

