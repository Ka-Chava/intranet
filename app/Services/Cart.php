<?php

namespace App\Services;

use App\Data\Cart as CartDTO;
use App\Data\CartItem;

class Cart
{

    public static int $LIMIT = 2;

    protected const SESSION_KEY = 'cart';

    public function get()
    {
        $cart = session()->get(self::SESSION_KEY, []);
        if (!$cart) {
            $cart = new CartDTO();
            $this->store($cart);
        }

        return $cart;
    }

    public function add(array $items)
    {
        $cart = $this->get();

        foreach ($items as $newItem) {
            if (!isset($newItem['id']) || !isset($newItem['quantity'])) {
                continue;
            }

            $found = false;

            foreach ($cart->items as &$cartItem) {
                if ($cartItem->id == $newItem['id']) {
                    $cartItem->setQuantity($cartItem->quantity + $newItem['quantity']);
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $cart->addItem(new CartItem($newItem['id'], $newItem['quantity'], $newItem['title']));
            }
        }

        return $this->store($cart);
    }

    public function updateItem($variantId, $quantity) {
        $cart = $this->get();
        $items = $cart->items;

        foreach ($items as &$item) {
            if ($item->id == $variantId) {
                $item->setQuantity($quantity);
                return $this->store($cart);
            }
        }

        return $cart;
    }

    public function change($items)
    {
        $cart = $this->get();

        foreach ($items as $update) {
            if (!isset($update['id']) || !isset($update['quantity'])) {
                continue;
            }

            if ($update['quantity'] <= 0) {
                $cart = $this->remove($update['id']);
                continue;
            }

            $added = $this->hasItem($update['id']);

            if ($added) {
                $cart = $this->updateItem($update['id'], $update['quantity']);
            } else {
                $cart = $this->add([['id' => $update['id'], 'quantity' => $update['quantity'], 'title' => $update['title']]]);
            }
        }

        return $cart;
    }

    public function remove($variantIds)
    {
        $cart = $this->get();
        $variantIds = is_array($variantIds) ? $variantIds : [$variantIds];
        $cart->setItems(array_filter($cart->items, fn($item) => !in_array($item->id, $variantIds)));
        return $this->store($cart);
    }

    public function clear()
    {
        return $this->store(new CartDTO());
    }

    public function hasItem($variantId): bool
    {
        $cart = $this->get();

        foreach ($cart->items as $item) {
            if ($item->id == $variantId) {
                return true;
            }
        }

        return false;
    }

    public function setAddress(string $address)
    {
        $cart = $this->get();
        $cart->setAddress($address);
        return $this->store($cart);
    }

    public function getAddress(): ?string
    {
        return $this->get()->getAddress();
    }

    public function forgetAddress()
    {
        $cart = $this->get();
        $cart->setAddress(null);
        return $this->store($cart);
    }

    public function getLimit()
    {
        return self::$LIMIT;
    }

    private function store($cart)
    {
        session()->put(self::SESSION_KEY, $cart);
        return $cart;
    }
}

