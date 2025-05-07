<?php

namespace App\Livewire;

use App\Facades\Cart as CartFacade;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ShippingForm extends Component
{
    #[Reactive]
    public $addresses = [];
    #[Reactive]
    public $customer;
    public $address = null;

    public function mount()
    {
        $this->address = CartFacade::getAddress();
    }

    public function updatedAddress($value)
    {
        $this->dispatch('cart:address', $value);
        $this->address = $value;
    }

    public function render()
    {
        return view('livewire.shipping-form');
    }
}
