<?php

namespace App\Contracts;

interface IBookmarkable
{
    public function isBookmarkedBy($user): bool;
    public function toggleBookmark($user): bool;
}
