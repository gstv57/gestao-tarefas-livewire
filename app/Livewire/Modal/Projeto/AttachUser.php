<?php

namespace App\Livewire\Modal\Projeto;

use App\Livewire\Projeto\ProjetoShow;
use App\Livewire\Traits\IsModal;
use App\Models\{Projeto, User};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class AttachUser extends Component
{
    use IsModal;

    use LivewireAlert;

    public $projeto;

    public $users;

    public string $query = '';

    public array $users_selected = [];

    public function render()
    {
        return view('livewire.modal.projeto.attach-user');
    }
    public function mount(Projeto $projeto)
    {
        $this->projeto = $projeto;
        $this->get_users_in_project();
    }
    private function get_users_in_project()
    {
        $users_ids   = $this->projeto->users()->pluck('users.id')->toArray();
        $this->users = User::whereNotIn('id', $users_ids)->limit(50)->get();
    }
    public function attachUser()
    {
        $ids = [];

        foreach ($this->users_selected as $user) {
            $ids[] = $user->id;
        }
        $this->projeto->users()->attach($ids);

        $this->dispatch('close-modal')->self();
        $this->dispatch('users-attach')->to(ProjetoShow::class);
        $this->alert('success', 'Usúarios vinculados com sucesso!');
    }
    public function updatedQuery()
    {
        $this->users = User::where('name', 'like', '%' . $this->query . '%')
            ->whereDoesntHave('projetos', function ($query) {
                $query->where('projeto_id', $this->projeto->id);
            })
            ->get();
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

    #[On('hidden')]
    public function cleanup()
    {
        $this->users_selected = [];
        $this->query          = '';
        $this->get_users_in_project();
    }
}
