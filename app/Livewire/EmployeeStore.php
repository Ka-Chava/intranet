<?php

namespace App\Livewire;

use App\Facades\Cart as CartFacade;
use App\Repositories\ShopifyRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class EmployeeStore extends Component
{
    public $cart;
    public $customer;
    public $recent_order;
    public $products;
    public $available;
    public $confirmChecked = false;
    public $personalUseChecked = false;
    protected ShopifyRepository $repository;

    public function boot()
    {
        $this->repository = app('shopify.repository');
    }

    public function mount()
    {
        $this->refreshCustomer();
        $this->cart = CartFacade::get();

        $recent_orders = $this->repository->getLastOrders($this->customer);
        $this->recent_order = $recent_orders->first();

        $this->available = !$this->recent_order || $this->customer->canOrderThisMonth();

        $seconds = now()->addHours(24);
        $this->products = cache()->remember('products', $seconds, function () {
            return $this->repository->getProducts();
        });
    }

    public function render()
    {
        $addressId = CartFacade::getAddress();

        return view('livewire.employee-store', [
            'addresses' => $this->customer->addresses,
            'order_address' => collect($this->customer->addresses)->firstWhere('id', $addressId),
        ]);
    }

    public function process()
    {
        if (!$this->available) {
            $this->addError('general', 'The order is not available. Please try again later.');
            return;
        }

        $address = collect($this->customer->addresses)->firstWhere('id', $this->cart->address);
        $items = collect($this->cart->items)->map(function ($item) {
            return [
                'variantId' => $item->id,
                'quantity' => $item->quantity,
                'title' => $item->title,
            ];
        });

        $this->recent_order = $this->repository->processOrder([
            'email' => $this->customer->email,
            'items' => $items,
            'address' => $address,
        ]);

        $this->clearCart();
        $this->dispatch('order:processed');

        $this->confirmChecked = false;
        $this->personalUseChecked = false;
        $this->available = false;

        $this->refresh();
    }

    #[On('cart:refresh')]
    public function refresh()
    {
        $this->cart = CartFacade::get();
        $this->refreshCustomer();
        $this->dispatchUpdated();
    }

    #[On('cart:add')]
    public function addToCart($data)
    {
        $this->cart = CartFacade::add($data);
        $this->dispatchUpdated();
    }

    #[On('cart:remove')]
    public function removeFromCart($data)
    {
        $this->cart = CartFacade::remove($data);
        $this->dispatchUpdated();
    }

    #[On('cart:update')]
    public function updateCart($data)
    {
        $this->cart = CartFacade::change($data);
        $this->dispatchUpdated();
    }

    #[On('cart:clear')]
    public function clearCart()
    {
        $this->cart = CartFacade::clear();
        $this->dispatchUpdated();
    }

    #[On('cart:address')]
    public function setCartAddress($data)
    {
        $this->cart = CartFacade::setAddress($data);
        $this->dispatchUpdated();
    }

    private function refreshCustomer()
    {
        cache()->flush();

        $seconds = now()->addHours(24);
        $key = 'customers_' . Auth::user()->id;
        $this->customer = cache()->remember($key, $seconds, function() {
            return $this->repository->getCustomer();
        });
    }

    private function dispatchUpdated()
    {
        $this->dispatch('cart:updated');
    }
}
