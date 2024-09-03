<?php

namespace App\Livewire\Projeto;

use App\Models\{Group, Projeto, Task, User};
use Carbon\Carbon;
use Exception;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjetoShow extends Component
{
    use LivewireAlert;

    public Projeto $projeto;

    public $membros;

    public $membro;

    public $membros_existentes;

    protected $listeners = ['users-attach' => '$refresh', 'task-created' => '$refresh', 'column-created' => '$refresh', 'task-deleted' => '$refresh', 'task-updated' => '$refresh'];
    public function render(): View
    {
        return view('livewire.projeto.projeto-show')->layout('layouts.app');
    }
    public function mount(Projeto $id): void
    {
        $this->authorize('view-projeto', $id);
        $this->projeto            = $id->load('board.groups.tasks.users');
        $this->membros_existentes = $this->projeto->users;

        $this->membros = User::where('is_active', 1)
            ->whereNotIn('id', $this->membros_existentes->pluck('id')->toArray())
            ->get();
    }
    public function reorderGroups($group_ids): void
    {
        $this->authorize('reorder-group-projeto');

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
        $this->authorize('reorder-task-projeto');

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
        $this->authorize('attach-for-me');

        try {
            $task->user_id = auth()->user()->id;
            $task->save();
            $this->alert('success', 'Tarefa vinculada a mim com sucesso!');
        } catch (Exception $exception) {
            $this->alert('error', $exception->getMessage());
        }
    }
    public function deleteTask(Task $task)
    {
        $this->authorize('destroy-task');

        try {
            $task->delete();
            $this->dispatch('task-deleted')->self();
            $this->alert('success', 'Tarefa exclúida com sucesso!');
        } catch (Exception $exception) {
            $this->alert('error', $exception->getMessage());
        }
    }
    #[Computed]
    public function calculateProgress($task_id)
    {
        $task = Task::find($task_id);

        if ($task->started_at === null || $task->finished_at === null) {
            return 0;
        }

        $start = Carbon::parse($task->started_at);

        $end = Carbon::parse($task->finished_at);

        $now = Carbon::now();

        if ($now->lt($start)) {
            return 0;
        }

        if ($now->gte($end)) {
            return 100;
        }

        $totalDuration   = $start->diffInDays($end);
        $elapsedDuration = $start->diffInDays($now);

        // Evita divisão por zero
        if ($totalDuration == 0) {
            return 100;
        }
        $progress = ($elapsedDuration / $totalDuration) * 100;

        return round($progress, 2);
    }
    public function destroyGroup(Group $group)
    {
        $this->authorize('destroy-group');

        try {
            $group->delete();
            $this->alert('success', 'Grupo excluído com sucesso!');
        } catch (Exception) {
            $this->alert('error', 'Entre em contato com o suporte');
        }
    }
}
