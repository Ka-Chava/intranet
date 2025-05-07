<?php

namespace App\Livewire;

use App\Facades\Cart as CartFacade;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProductsForm extends Component
{
    #[Validate('required')]
    public $items = [];

    public $products = [];
    public $limit = 0;

    #[On('order:processed')]
    public function handleOrderProcessed()
    {
        $this->setInitialStateForItems();
    }

    public function submit()
    {
        $this->validate([
            'items' => 'required|array',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        $total = collect($this->items)->sum(fn($item) => (int) ($item['quantity'] ?? 0));

        if ($total > 2) {
            $this->addError('items', 'Limit reached');
            $this->addError('general', '2 bag limit per order');
            $this->addError('general', 'Remove an item before adding a new one');
            return;
        }

        $cart = CartFacade::get();

        if (!($total + $cart->totalQuantity)) {
            $this->addError('general', 'Please add at least one item');
            return;
        }

        $this->dispatch('cart:update', $this->items);
        //$this->dispatch('cart:clear');
    }

    public function mount()
    {
        $this->setInitialStateForItems();
    }

    public function render()
    {
        return view('livewire.products-form');
    }

    private function setInitialStateForItems()
    {
        if (!isset($this->products)) {
            return;
        }

        $cart = CartFacade::get();
        $this->limit = CartFacade::getLimit();

        $this->items = collect($this->products)->map(function ($product) use ($cart) {
            $quantity = $cart->getLineQuantity($product->variant);

            return [
                'id' => $product->variant,
                'title' => $product->title,
                'quantity' => $quantity ?? 0,
            ];
        })->toArray();
    }
}
