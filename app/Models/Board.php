<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Board extends Model
{
    protected $fillable = ['projeto_id'];

    public function projeto(): BelongsTo
    {
        return $this->belongsTo(Projeto::class);
    }
    public function groups(): hasMany
    {
        return $this->hasMany(Group::class);
    }
}
