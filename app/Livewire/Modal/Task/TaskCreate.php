<?php

namespace App\Livewire\Modal\Task;

use App\Livewire\Projeto\ProjetoShow;
use App\Models\{Group,Task};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskCreate extends Component
{
    use LivewireAlert;

    public bool $visibily = false;

    public string $nome = '';

    public Group $group;

    public function render()
    {
        $this->authorize('create-task');

        return view('livewire.modal.task.task-create');
    }
    #[On('hidden')]
    public function cleanup()
    {
        $this->nome = '';
    }
    #[On('show-modal')]
    public function show($id)
    {
        $this->group    = Group::find($id);
        $this->visibily = true;
    }
    #[On('close-modal')]
    public function hide()
    {
        $this->visibily = false;
        $this->dispatch('hidden')->self();
    }

    public function save()
    {
        $this->validate([
            'nome' => ['required', 'string'],
        ]);
        Task::create([
            'name'     => $this->nome,
            'group_id' => $this->group->id,
        ]);
        $this->dispatch('close-modal')->self();
        $this->dispatch('task-created')->to(ProjetoShow::class);
        $this->alert('success', 'Task criada com sucesso!');
    }
}
