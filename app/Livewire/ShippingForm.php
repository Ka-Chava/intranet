<?php

namespace App\Livewire;

use App\Facades\Cart as CartFacade;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ShippingForm extends Component
{
    #[Reactive]
    public $addresses = [];
    public $customer;
    #[Modelable]
    public $address;

    public function mount()
    {
        $this->address = CartFacade::getAddress();
    }

    public function render()
    {
        return view('livewire.shipping-form');
    }

    public function updatedAddress($value)
    {
        $this->dispatch('cart:address', $value);
        $this->address = $value;
    }

    #[On('cart:updated')]
    public function handleAddressChange()
    {
        $this->address = CartFacade::getAddress();
    }
}
