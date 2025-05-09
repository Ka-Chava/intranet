<?php

namespace App\Data;
use Carbon\Carbon;
use Livewire\Wireable;

class Order extends GraphqlModel implements Wireable
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

    public function getCreatedAt() {
        return Carbon::make($this->raw['createdAt']);
    }

    public function getPlacedAt() {
        return $this->getClosedAt()->format('M d, y');
    }

    public function getRemainingDaysToOrder() {
        return Carbon::now()->addMonth(1)->startOfMonth()->diffForHumans();
    }

    public function getClosedAt() {
        return Carbon::make($this->raw['closedAt'] ?? $this->raw['createdAt']);
    }

    public function getNextOrder() {
        $created = $this->getCreatedAt();
        return $created->addMonth(1)->startOfMonth();
    }

    public function getNextOrderDate() {
        $created = $this->getNextOrder();
        return $created->format('M d, y');
    }

}
