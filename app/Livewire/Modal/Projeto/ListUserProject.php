<?php

namespace App\Livewire\Modal\Projeto;

class ListUserProject extends AttachUser
{
    public function render()
    {
        return view('livewire.modal.projeto.list-user-project');
    }

    // sobreescrever os metodos, para ficar de acordo,
    // mudar a herença, e buscar por um nome mais abstrato.
}
