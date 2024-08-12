<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    public const ROLE_ADMINISTRATOR = 1;
    public const ROLE_OWNER         = 2;
    public const ROLE_USER          = 3;

    protected $fillable = ['name'];
    public function permissions(): belongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
