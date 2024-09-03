<?php

namespace App\Providers;

use App\Models\{Permission, Projeto, User};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        Model::preventLazyLoading(!$this->app->isProduction());

        Model::handleLazyLoadingViolationUsing(function (Model $model, string $relation) {
            info("Attempted to lazy load [$relation] on model [$model]");
        });

        //        $permissions = Permission::pluck('name')->toArray();
        //
        //        foreach ($permissions as $permission) {
        //            Gate::define($permission, function ($user) use ($permission) {
        //                return $user->hasPermission($permission);
        //            });
        //        }

        $permissions = Permission::pluck('name')->toArray();

        foreach ($permissions as $permission) {
            Gate::define($permission, function (User $user, ?Projeto $projeto = null) use ($permission) {
                if ($user->is_admin()) {
                    return true;
                }

                // Primeiro, verifica se o projeto foi fornecido e se o usuário pertence a ele
                if ($projeto && !$user->belongsToProject($projeto)) {
                    return false;
                }

                // Se não houver projeto ou o usuário pertencer ao projeto, verifica a permissão
                return $user->hasPermission($permission);
            });
        }
    }

}
