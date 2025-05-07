<?php

namespace App\Data;

use Livewire\Wireable;

class Product extends GraphqlModel implements Wireable
{
    public function __construct(array $raw = [])
    {
        parent::__construct($raw);
    }

    public function toLivewire()
    {
        return $this->raw;
    }

    public static function fromLivewire($value)
    {
        return new self($value);
    }

    public function getTitle() {
        return $this->raw['title'];
    }

    public function getImageUrl() {
        return $this->raw['featuredImage']['url'];
    }

    public function getImageAlt() {
        return $this->raw['featuredImage']['altText'];
    }

    public function getInventory() {
        return $this->raw['totalInventory'];
    }

    public function getVariant() {
        return $this->raw['variant']['id'];
    }
}
