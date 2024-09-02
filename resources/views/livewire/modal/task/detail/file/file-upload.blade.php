<x-modal wire:model="visibily" title="Arquivos Existentes no Projeto">
    <div class="container">
        <div class="row g-3">
            @if(!empty($files))
                @foreach($files as $file)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card border-dark shadow-sm h-70">
                            <img src="{{ Storage::url($file->path) }}" class="card-img-top" alt="File" style="object-fit: cover; height: 200px;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{$file->extensao}}</h5>
                                <div class="mt-auto">
                                    <a href="{{ Storage::url($file->path) }}" class="btn btn-primary btn-sm" target="_blank">Visualizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p class="text-center text-muted">Nenhum arquivo encontrado.</p>
                </div>
            @endif
        </div>
        <div class="row">
            <button class="btn btn-primary btn-sm" wire:click="$dispatchTo('modal.task.detail.file.file-upload', 'close-modal')">Voltar </button>
        </div>
    </div>
</x-modal>
