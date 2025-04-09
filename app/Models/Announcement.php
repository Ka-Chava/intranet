<?php

namespace App\Models;


use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasUser;

    public static function boot()
    {
        parent::boot();
        self::bootHasUser();
    }
}
