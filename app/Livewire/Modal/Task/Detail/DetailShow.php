<?php

namespace App\Livewire\Modal\Task\Detail;

use App\Livewire\Projeto\ProjetoShow;
use App\Livewire\Traits\IsModal;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\{On, Validate};
use Livewire\{Component, WithFileUploads};

class DetailShow extends Component
{
    use IsModal;

    use LivewireAlert;

    use WithFileUploads;

    public Task $task;

    public string $name;

    public string $description;

    public $started_at;

    public $finished_at;

    public bool $user_in_task;

    #[Validate(['files.*' => 'image|max:1024'])]
    public $files;

    public function render()
    {
        $this->authorize('detail-task');

        return view('livewire.modal.task.detail.detail-show');
    }

    #[On('show-modal')]
    public function show(Task $task)
    {
        $this->task         = $task->load('detail', 'users');
        $this->name         = $task->name;
        $this->started_at   = $task->started_at ? Carbon::parse($task->started_at)->format('Y-m-d') : null;
        $this->finished_at  = $task->finished_at ? Carbon::parse($task->finished_at)->format('Y-m-d') : null;
        $this->description  = $task->detail->description ?? '';
        $this->user_in_task = $this->user_are_in_task();
        $this->visibily     = true;
    }

    public function save()
    {
        $this->task->update([
            'name'        => $this->name,
            'started_at'  => $this->started_at ? Carbon::parse($this->started_at)->format('Y-m-d') : null,
            'finished_at' => $this->finished_at ? Carbon::parse($this->finished_at)->format('Y-m-d') : null,
        ]);

        if ($this->task->detail) {
            $this->task->detail->update([
                'description' => $this->description,
            ]);
        }

        if (!$this->task->detail) {
            $this->task->detail()->create([
                'description' => $this->description,
            ]);
        }

        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $uuid = Str::uuid()->toString();
                $ext  = $file->getClientOriginalExtension();
                $name = "task_{$this->task->id}_$uuid.$ext";
                $dir  = 'task_files';
                $file->storeAs($dir, $name);

                $this->task->files()->create([
                    'path'     => $dir . '/' . $name,
                    'extensao' => $ext,
                ]);
            }
        }

        $this->dispatch('close-modal')->self();
        $this->dispatch('task-updated')->to(ProjetoShow::class);
        $this->alert('success', 'Tarefa atualizada com sucesso!');
    }

    public function joinTask()
    {
        $this->task->users()->attach(auth()->user()->id);
        $this->user_in_task = true;
    }
    public function unjoinTask()
    {
        $this->task->users()->detach(auth()->user()->id);
        $this->user_in_task = false;
    }
    private function user_are_in_task()
    {
        return $this->task->users->contains(auth()->user()->id);
    }

    #[On('hidden')]
    public function hidden()
    {
        $this->files = '';
        $this->dispatch('$refresh')->self();
    }
}
