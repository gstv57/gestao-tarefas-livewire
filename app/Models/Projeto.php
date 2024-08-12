<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasOne};

class Projeto extends Model
{
    protected $fillable = ['name', 'visibility', 'description', 'priority', 'start_date', 'end_date', 'user_id'];

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'projetos_users');
    }
    public function board(): hasOne
    {
        return $this->hasOne(Board::class);
    }
}
