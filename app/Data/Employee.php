<?php

namespace App\Data;

use Livewire\Wireable;

class Employee extends GraphqlModel implements Wireable
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

    public function getName() {
        return $this->raw['firstName'] . ' ' . $this->raw['lastName'];
    }

    public function hasTag($value) {
        return in_array($value, $this->tags);
    }

    public function getOnlyId() {
        return str_replace('gid://shopify/Customer/', '', $this->id);
    }

    public function getAddresses()
    {
        return collect($this->raw['addresses'] ?? [])
            ->map(fn($item) => new \App\Data\Address($item));
    }

    /**
     * Checks if the customer can order this month
     * @return bool
     */
    public function canOrderThisMonth() {
        $tagged = $this->hasTag('monthly_order_complete');
        $hasOrder = $this->raw['orders'] && count($this->raw['orders']['nodes']) > 0;
        return !$tagged && !$hasOrder;
    }

    public function getTags() {
        return $this->raw['tags'];
    }

    public function getEmail() {
        return $this->raw['email'];
    }
}
