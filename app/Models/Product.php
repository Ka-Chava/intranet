<?php

namespace App\Models;

class Product extends GraphqlModel
{
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
}
