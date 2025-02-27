{{-- Header view component for the store page, showing the user their last order and next order date --}}
<div class="store-header">
    <p class="store-header__now">Your last order was placed on: <b>{{ $recent_order->placed_at }}</b>.</p>
    <p class="store-header__next">Your next available order date: <b><span></span>{{ $recent_order->next_order_date }}</b> ... in <b>{{ $recent_order->remaining_days_to_order }}</b>.</p>
</div>

