<?php

namespace App\Livewire\Modal\Group;

use App\Livewire\Projeto\ProjetoShow;
use App\Livewire\Traits\IsModal;
use App\Models\{Board, Group};
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class GroupCreate extends Component
{
    use LivewireAlert;
    use IsModal;

    public string $nome = '';

    public int $posicao = 0;

    public $board;

    public function mount(Board $board)
    {
        $this->authorize('create-group');
        $this->board = $board;
    }
    public function render()
    {
        return view('livewire.modal.group.group-create');
    }
    public function save()
    {
        $this->validate([
            'nome'    => ['required', 'string'],
            'posicao' => ['required', 'integer'],
        ]);
        Group::create([
            'name'     => $this->nome,
            'position' => $this->posicao,
            'board_id' => $this->board->id,
        ]);

        $this->dispatch('close-modal')->self();
        $this->dispatch('column-created')->to(ProjetoShow::class);
        $this->alert('success', 'Coluna criada com sucesso!');
    }

    #[On('hidden')]
    public function cleanup()
    {
        $this->nome    = '';
        $this->posicao = 0;
    }
}
