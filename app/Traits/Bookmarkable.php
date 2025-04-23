<?php

namespace App\Traits;

use App\Models\Bookmark;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait Bookmarkable
{
    public function bookmarks(): MorphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function isBookmarkedBy($user): bool
    {
        if (!$user) return false;

        return $this->bookmarks()
            ->where('user_id', $user->id)
            ->exists();
    }

    public function bookmarkCount(): int
    {
        return $this->bookmarks()->count();
    }

    public function toggleBookmark($user): bool
    {
        if (!$user) return false;

        $existing = $this->bookmarks()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            return false;
        } else {
            $this->bookmarks()->create();
            return true;
        }
    }

    protected function currentBookmark(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->bookmarked ? $this->bookmarks()->where('user_id', Auth::user()->id)->first() : null,
        );
    }

    protected function bookmarked(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isBookmarkedBy(Auth::user()),
        );
    }
}
