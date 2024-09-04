<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Events\UsuarioCriado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany, HasOne};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    protected $dispatchesEvents = [
        'created' => UsuarioCriado::class,
    ];
    public function roles(): belongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }
    public function hasPermission($permission): bool
    {
        // remover logs no futuro
        // \Log::info("Checking permission: {$permission} for user: {$this->id}");
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
        // \Log::info('Permission check result: ' . ($result ? 'true' : 'false'));
    }
    public function projetos(): belongsToMany
    {
        return $this->belongsToMany(Projeto::class, 'projetos_users');
    }
    public function is_admin(): bool
    {
        return $this->roles()->where('name', 'Administrador')->exists();
    }
    public function belongsToProject($project): bool
    {
        if (is_numeric($project)) {
            return $this->projetos()->where('projetos.id', $project)->exists();
        }

        return $this->projetos()->where('projetos.id', $project->id)->exists();
    }
    public function inbox(): hasOne
    {
        return $this->hasOne(Inbox::class);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->inbox()->create();
        });
    }
    public function notification(): hasMany
    {
        return $this->hasMany(Notification::class);
    }
}
