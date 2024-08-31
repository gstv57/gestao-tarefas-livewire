<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['name', 'group_id', 'user_id', 'position'];
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
