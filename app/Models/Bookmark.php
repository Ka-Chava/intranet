<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{

    use HasUser;

    protected $fillable = ['bookmarkable_id', 'bookmarkable_type'];

    public static function boot()
    {
        parent::boot();
        self::bootHasUser();
    }

    public function bookmarkable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
