<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Inbox\{InboxIndex, InboxViewMessage};
use App\Livewire\Projeto\{ProjetoCreate, ProjetoIndex, ProjetoShow};
use App\Livewire\Role\RoleIndex;
use App\Livewire\Usuario\{UsuarioCreate, UsuarioIndex, UsuarioShow};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/roles', RoleIndex::class)->name('roles.index');

    Route::get('/usuarios', UsuarioIndex::class)->name('usuarios.index');
    Route::get('/usuarios/criar', UsuarioCreate::class)->name('usuarios.create');
    Route::get('/usuarios/{id}', UsuarioShow::class)->name('usuarios.show');

    Route::get('/projetos', ProjetoIndex::class)->name('projeto.index');
    Route::get('/projetos/criar', ProjetoCreate::class)->name('projetos.create');
    Route::get('/projetos/{id}', ProjetoShow::class)->name('projetos.show');

    Route::get('/inbox', InboxIndex::class)->name('inbox.index');
    Route::get('/inbox/mensagens/{sender_id}', InboxViewMessage::class)->name('inbox.message.between.users');
});

require __DIR__ . '/auth.php';
