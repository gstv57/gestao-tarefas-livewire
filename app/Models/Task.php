<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Task extends Model
{
    protected $fillable = ['name', 'group_id', 'user_id', 'position', 'started_at', 'finished_at'];

    protected $casts = ['started_at' => 'datetime', 'finished_at' => 'datetime'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tasks_users');
    }
    public function detail(): HasOne
    {
        return $this->hasOne(TaskDetail::class);
    }
    public function files(): HasMany
    {
        return $this->hasMany(TaskFileUpload::class);
    }
}
