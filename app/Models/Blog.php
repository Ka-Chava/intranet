<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;

class Blog extends Model
{
    use HasTags;
    use HasUser;

    public static function boot()
    {
        parent::boot();
        self::bootHasUser();
    }

    public function articles(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}
