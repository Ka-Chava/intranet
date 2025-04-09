<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\HasTags;

class BlogPost extends Model
{
    use HasTags;
    use HasUser;

    protected $fillable = [
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::bootHasUser();
    }

    public function blog(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Blog::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Author::class);
    }

    /**
     * Check if the blog post is published.
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        return !is_null($this->published_at);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Storage::disk('public')->url($value) : null,
        );
    }
}
