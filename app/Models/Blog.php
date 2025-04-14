<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
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

    public function articlesPublished(): HasMany
    {
        return $this->hasMany(BlogPost::class)->whereNotNull('published_at');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Storage::disk('public')->url($value) : null,
        );
    }
}
