{{-- Header view component for the store page, showing the user their last order and next order date --}}
<div class="store-header">
    @if(isset($order))
        <p class="store-header__row">Your last order was placed on: <b>{{ $order->placed_at }}</b></p>
    @else
        <p class="store-header__row">You haven't placed any orders yet.</p>
    @endif

    <p class="store-header__row">
        Your next available order date:

        @if(!isset($order) || $available)
            <b><span class="store-header__indicator"></span>Available now</b>
        @else
            <b><span class="store-header__indicator inactive"></span>{{ $order->next_order_date }}</b>
            <span class="store-header__details">...in {{ $order->remaining_days_to_order }}</span>
        @endif
    </p>
</div>

