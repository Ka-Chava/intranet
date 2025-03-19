<?php

namespace App\Models;

use App\Enums\CountryEnum;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $appends = ['country_name'];

    protected $casts = [
        'date' => 'date'
    ];

    public function getDate() {
        return $this->getDate()->format('M d, y');
    }

    public function getCountryNameAttribute(): string
    {
        return CountryEnum::tryFrom((int) $this->country)?->getName() ?? 'Unknown';
    }
}
