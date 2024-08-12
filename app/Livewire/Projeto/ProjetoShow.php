<?php

namespace App\Livewire\Projeto;

use App\Models\{Group, Projeto, Task, User};
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Mockery\Exception;

class ProjetoShow extends Component
{
    use LivewireAlert;

    public Projeto $projeto;

    public $membros;

    public $membro;

    public $membros_existentes;

    public function render(): View
    {
        return view('livewire.projeto.projeto-show')->layout('layouts.app');
    }

    public function mount(Projeto $id): void
    {
        $this->projeto            = $id->load('board.groups.tasks.user');
        $this->membros_existentes = $this->projeto->users;
        $this->membros            = User::where('is_active', 1)
            ->whereNotIn('id', $this->membros_existentes->pluck('id')->toArray())
            ->get();
    }

    public function reorderGroups($group_ids): void
    {
        $groups = Group::query()->findMany($group_ids)
            ->map(function (Group $group) use ($group_ids) {
                $group->position = array_flip($group_ids)[$group->id];

                return $group;
            });

        Group::query()->upsert(
            $groups->toArray(),
            ['id'],
            ['position']
        );
    }

    public function reorderTasks($params): void
    {
        $groupId = $params['groupId'];
        $taskIds = $params['tasksIds'];

        Task::query()->findMany($taskIds)
            ->each(function (Task $task) use ($groupId, $taskIds) {
                $task->position = array_flip($taskIds)[$task->id];
                $task->group_id = $groupId;
                $task->save();
            });
    }

    public function attachForMe(Task $task): void
    {
        try {
            $task->user_id = auth()->user()->id;
            $task->save();
            $this->alert('success', 'Tarefa vinculada a mim com sucesso!');
        } catch (\Exception $exception) {
            $this->alert('error', $exception->getMessage());
        }
    }

    public function attachMember(): void
    {
        try {
            $this->projeto->users()->attach($this->membro);
            $this->alert('success', 'Membro vinculado com sucesso!');
        } catch (Exception $e) {
            $this->alert('error', 'Aconteceu algo de errado ao vinculado um membro! Entre em contato com o suporte.');
        }
    }
    public function detachMember(): void
    {
        try {
            $this->projeto->users()->detach($this->membro);
            $this->alert('success', 'Membro desvinculado com sucesso!');
        } catch (Exception $e) {
            $this->alert('error', 'Aconteceu algo de errado ao desvincular um membro! Entre em contato com o suporte.');
        }
    }
}
