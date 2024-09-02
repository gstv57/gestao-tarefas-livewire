<?php

namespace App\Livewire\Modal\Projeto;

use App\Livewire\Projeto\ProjetoShow;
use App\Livewire\Traits\IsModal;
use App\Models\{Projeto, User};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ListUserProject extends Component
{
    use IsModal;

    use LivewireAlert;

    public string $query = '';

    public $projeto;

    public $users;

    public array $users_selected = [];
    public function render()
    {
        return view('livewire.modal.projeto.list-user-project');
    }

    public function mount(Projeto $projeto)
    {
        $this->projeto = $projeto;
        $this->users   = $this->projeto->users;
    }

    public function usersSelected(User $id)
    {
        $this->users_selected[] = $id;
    }

    public function removeUserSelected(User $id)
    {
        foreach ($this->users_selected as $key => $user) {
            if ($user->id === $id->id) {
                unset($this->users_selected[$key]);

                break;
            }
        }
        $this->users_selected = array_values($this->users_selected);
    }
    public function dettachUser()
    {
        $ids = [];

        foreach ($this->users_selected as $user) {
            $ids[] = $user->id;
        }
        $this->projeto->users()->detach($ids);

        $this->dispatch('close-modal')->self();
        $this->dispatch('users-attach')->to(ProjetoShow::class);
        $this->alert('success', 'Usúarios desvinculados com sucesso!');
    }

    public function updatedQuery()
    {
        $this->users = User::where('name', 'like', '%' . $this->query . '%')
            ->WhereHas('projetos', function ($query) {
                $query->where('projeto_id', $this->projeto->id);
            })
            ->get();
    }

    #[On('hidden')]
    public function cleanup()
    {
        $this->users_selected = [];
        $this->query          = '';
        $this->users          = $this->projeto->users;
    }
}
