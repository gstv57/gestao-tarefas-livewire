<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskFileUpload extends Model
{
    protected $fillable = ['path', 'extensao'];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
