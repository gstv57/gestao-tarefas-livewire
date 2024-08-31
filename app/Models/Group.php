<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Group extends Model
{
    protected $fillable = ['name', 'board_id', 'position'];

    public function board(): belongsTo
    {
        return $this->belongsTo(Board::class);
    }
    public function tasks(): hasMany
    {
        return $this->hasMany(Task::class);
    }

}
