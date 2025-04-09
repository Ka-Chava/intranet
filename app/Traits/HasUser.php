<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUser
{
    public static function bootHasUser()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
