<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $casts = [
        'date' => 'date'
    ];
    public function getDate() {
        return $this->getDate()->format('M d, y');
    }
}
