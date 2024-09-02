<?php

namespace App\Livewire\Modal\Task\Detail\File;

use App\Livewire\Traits\IsModal;
use App\Models\Task;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class FileUpload extends Component
{
    use IsModal;

    use LivewireAlert;

    public $files;

    public function render()
    {
        $this->authorize('upload-file-task');

        return view('livewire.modal.task.detail.file.file-upload');
    }

    #[On('show-modal')]
    public function show(Task $task)
    {
        $this->files    = $task->files;
        $this->visibily = true;
    }
}
