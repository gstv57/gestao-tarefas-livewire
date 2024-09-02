<?php

namespace App\Livewire\Projeto;

use App\Models\Projeto;
use Exception;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProjetoCreate extends Component
{
    use LivewireAlert;

    public $name;

    public $visibility;

    public $description;

    public $priority;

    public $start_date;

    public $end_date;
    public function render()
    {

        return view('livewire.projeto.projeto-create')->layout('layouts.app');
    }
    public function store()
    {
        $validated = $this->validate([
            'name'        => ['required', 'string'],
            'visibility'  => ['required', Rule::in(['public', 'private'])],
            'description' => ['required', 'string'],
            'priority'    => ['required', Rule::in(['low', 'medium', 'high'])],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);
        $validated['user_id'] = auth()->user()->id;

        try {
            Projeto::create($validated);
            $this->alert('success', 'Redirecionando!');
            $this->unfill();
            //to_route("projetos.show");
        } catch (Exception $e) {
            dd($e->getMessage());
            $this->alert('error', 'Ocorreu um erro ao criar o projeto. Tente novamente.');
        }
    }
    public function unfill(): void
    {
        $this->reset();
    }

}
