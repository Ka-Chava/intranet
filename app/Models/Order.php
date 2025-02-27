<?php

namespace App\Models;
use Carbon\Carbon;

class Order extends GraphqlModel
{

    public function getCreatedAt() {
        return Carbon::make($this->raw['createdAt']);
    }

    public function getPlacedAt() {
        return $this->getClosedAt()->format('M d, y');
    }

    public function getRemainingDaysToOrder() {
        $start = $this->getCreatedAt();
        $next = $this->getNextOrder();
        return Carbon::now()->addMonth(1)->startOfMonth()->diffForHumans();
    }

    public function getClosedAt() {
        return Carbon::make($this->raw['closedAt']);
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
