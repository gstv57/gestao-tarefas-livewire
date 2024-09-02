<?php

namespace App\Livewire\Projeto\Participante;

use Livewire\Component;

class ParticipanteShow extends Component
{
    public $participantes;
    public function render()
    {
        return view('livewire.projeto.participante.participante-show');
    }
    public function mount($participantes)
    {
        $this->authorize('list-user-projeto');
        $this->participantes = $participantes;
    }
}
