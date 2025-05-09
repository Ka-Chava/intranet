<div
    id="EmployeeStore"
    class="employee-store"
    x-data="{ count: $wire.entangle('cart.totalQuantity') }"
    @products:updated.window="$event.detail.count && document.getElementById('OrderShipping').scrollIntoView();"
    @order:processed.window="$dispatch('open-modal', { modal: 'order-success' });"
>
    <x-global.page-header>
        <x-slot:html>
            <div class="flex justify-between">
                <x-store.header :available="$available" :order="$recent_order" />

                <div class="cart">
                    <x-icon-cart class="w-6 h-6" />

                    <span class="cart__indicator" x-show="count > 0" x-text="count"></span>
                </div>
            </div>
        </x-slot:html>
    </x-global.page-header>

    <div class="employee-store__content">
        <div id="OrderProducts">
            <livewire:products-form :products="$products" />
        </div>

        <div id="OrderShipping">
            <livewire:shipping-form :addresses="$addresses" :customer="$customer" />
        </div>

        <div id="OrderConfirmation">
            <div class="heading">
                <h2 class="heading__title">Confirm and Submit</h2>
                <p class="heading__subtitle heading__subtitle--normal heading__subtitle--secondary">Is your order and information correct?</p>
            </div>

            <div class="store-confirmation">
                <div class="store-confirmation__grid">
                    <div class="store-confirmation__column">
                        <div class="store-confirmation__row">
                            <div>
                                <span class="employee-store__label store-confirmation__label">Order</span>

                                @if(!empty($cart->items))
                                    <ul class="store-confirmation__list">
                                        @foreach($cart->items as $item)
                                            <li class="store-confirmation__item">
                                                <span class="store-confirmation__item-quantity">{{ $item->quantity }}x</span>
                                                <span class="store-confirmation__item-name">{{ $item->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <a class="link link--medium link--secondary" href="#OrderProducts">
                                Edit <x-heroicon-o-pencil class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </div>

                    <div class="store-confirmation__column">
                        <div class="store-confirmation__row">
                            <div>
                                <span class="employee-store__label">Shipping</span>

                                @if(isset($order_address))
                                    <ul class="store-confirmation__list">
                                        <li class="store-confirmation__item">
                                            {{ $order_address->firstName }} {{ $order_address->lastName }}
                                        </li>

                                        @if($order_address->address1)
                                            <li class="store-confirmation__item">
                                                {{ $order_address->address1 }}
                                            </li>
                                        @endif

                                        @if($order_address->address2)
                                            <li class="store-confirmation__item">
                                                {{ $order_address->address2 }}
                                            </li>
                                        @endif

                                        <li class="store-confirmation__item">
                                            {{ $order_address->city }}, {{ $order_address->provinceCode }}, {{ $order_address->zip }}, {{ $order_address->country }}
                                        </li>
                                    </ul>
                                @endif
                            </div>

                            <a class="link link--medium link--secondary" href="#OrderShipping">
                                Edit <x-heroicon-o-pencil class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </div>
                </div>

                <div x-data="{
                    cart: @entangle("cart"),
                    confirmChecked: @entangle("confirmChecked"),
                    personalUseChecked: @entangle("personalUseChecked"),
                    available: @entangle("available")
                }">
                    <form class="form store-confirmation__form" wire:submit.prevent="process">
                        <div class="store-confirmation__grid">
                            <div>
                                <label for="accept_submit" class="form__field form__field--checkbox">
                                    <input
                                        type="checkbox"
                                        name="order_final_confirmation"
                                        id="accept_submit"
                                        class="checkbox"
                                        wire:model="confirmChecked"
                                    />
                                    I understand that no changes or modification are allowed after submitting an order
                                </label>

                                <label for="personal_use_agreement" class="form__field form__field--checkbox">
                                    <input
                                        type="checkbox"
                                        name="personal_use_agreement"
                                        id="personal_use_agreement"
                                        class="checkbox"
                                        wire:model="personalUseChecked"
                                    />
                                    I understand that my order is for personal or family use ONLY and not for resale
                                </label>
                            </div>
                        </div>

                        <button
                            id="ProcessOrder"
                            class="button button--primary button--full store-confirmation__submit"
                            :disabled="!(confirmChecked && personalUseChecked) || !cart.address || !cart.totalQuantity || !available"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove wire:target="process">Submit order</span>
                            <span wire:loading wire:target="process">
                                <x-heroicon-o-arrow-path class="animate-spin" />
                            </span>
                        </button>

                        <span class="store-confirmation__legal">
                            By using this website, you agree with the
                            <a class="link" href="#">Employee Personal Order Policy</a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-modal id="order-success">
        <div class="heading">
            <h3 class="heading__title">Success</h3>
        </div>

        <p class="my-1">
            Your order has been successfully completed
        </p>

        <button class="button button--secondary employee-store__modal-button" @click="$dispatch('close-modal', { modal: 'order-success' });">
            Close
        </button>
    </x-modal>
</div>
