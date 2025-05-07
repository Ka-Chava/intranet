<?php

namespace App\Data;

use Livewire\Wireable;

class CartItem implements Wireable
{
    public string $id;
    public string $title;
    public int $quantity;

    public function __construct(string $id, int $quantity, string $title = '')
    {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->title = $title;
    }

    public function toLivewire()
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'title' => $this->title
        ];
    }

    public static function fromLivewire($value)
    {
        return new self(
            $value['id'],
            $value['quantity'],
            $value['title']
        );
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
