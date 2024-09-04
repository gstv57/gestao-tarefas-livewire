<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    public const PROJETO_NOTIFICATION_TITLE = 'Você foi adicionado ao projeto ';
    public const PROJETO_NOTIFICATION_BODY  = 'Veja agora e obtenha mais informações';
    public const PROJETO_NOTIFICATION_TYPE  = 'projeto-notification';

    protected $fillable = ['title', 'body', 'type', 'user_id', 'read'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
