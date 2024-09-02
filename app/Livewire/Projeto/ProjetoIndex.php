<?php

namespace App\Livewire\Projeto;

use App\Models\Projeto;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\{Component};

class ProjetoIndex extends Component
{
    public function render(): View|RedirectResponse
    {
        try {
            if (auth()->user()->is_admin()) {
                return view('livewire.projeto.projeto-index', [
                    'projetos' => Projeto::paginate(10),
                ])->layout('layouts.app');
            }

            return view('livewire.projeto.projeto-index', [
                'projetos' => Projeto::whereHas('users', function ($query) {
                    $query->where('user_id', auth()->id());
                })->get(),
            ])->layout('layouts.app');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
