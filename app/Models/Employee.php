<?php

namespace App\Models;

class Employee extends GraphqlModel
{
    public function getName() {
        return $this->raw['firstName'] . ' ' . $this->raw['lastName'];
    }

    public function hasTag($value) {
        return in_array($value, $this->tags);
    }

    public function getOnlyId() {
        return str_replace('gid://shopify/Customer/', '', $this->id);
    }

    /**
     * Checks if the customer can order this month
     * @return bool
     */
    public function canOrderThisMonth() {
        if($this->hasTag('monthly_order_complete')) {
            return false;
        }
        else {
            return true;
        }
    }

    public function getTags() {
        return $this->raw['tags'];
    }

    public function getEmail() {
        return $this->raw['email'];
    }
}
