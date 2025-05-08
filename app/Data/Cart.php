<?php

namespace App\Data;

use Livewire\Wireable;

class Cart implements Wireable
{
    public int $totalQuantity = 0;
    public array $items;
    public ?string $address;

    public function __construct(array $items = [], ?string $address = '')
    {
        $this->items = $items;
        $this->address = $address;
        $this->calculateTotalQuantity();
    }

    public function toLivewire()
    {
        return [
            'totalQuantity' => $this->totalQuantity,
            'items' => array_map(fn($item) => $item->toLivewire(), $this->items),
            'address' => $this->address,
        ];
    }

    public static function fromLivewire($value)
    {
        $items = array_map(fn($item) => CartItem::fromLivewire($item), $value['items']);
        $address = $value['address'] ?? '';

        return new self($items, $address);
    }

    public function setItems(array $items)
    {
        $this->items = $items;
        $this->calculateTotalQuantity();
    }

    public function addItem(CartItem $item)
    {
        $this->items[] = $item;
        $this->calculateTotalQuantity();
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }

    public function setAddress(?string $address)
    {
        $this->address = $address;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getLineQuantity(string $id): int
    {
        $firstMatch = collect($this->items)->first(function($item) use ($id) {
            return $item->id == $id;
        });

        return $firstMatch ? $firstMatch->quantity : 0;
    }

    private function calculateTotalQuantity()
    {
        $this->totalQuantity = array_sum(array_column($this->items, 'quantity'));
    }
}
