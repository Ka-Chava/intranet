<x-app-layout>
    <x-global.page-header>
        <x-slot:title>
            Employee Store
        </x-slot:title>
        <x-slot:caption>
            <p>Welcome back <strong> {{ $user->name }}</strong>.</p>
            @if($customer->canOrderThisMonth())
            @else
            <p>Select up to 2 flavors, choose your address and submit your order for the month of.</p>
            @endif
        </x-slot:caption>
    </x-global.page-header>
    <div class="employee-store" id="EmployeeStore">
        <div class="employee-store__products">
            <ul class="employee-store__products-list">
                @foreach($products as $product)
                    <li>
                        <div class="product-card" data-inventory="{{ $product->inventory }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->image_alt }}"/>
                            <div class="product-card__body">
                                <h2>{{ $product->title }}</h2>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="employee-store__info">
            <p>By using this website, you agree with the Employee Personal Order Policy.</p>
            <ul>
                <li>Select up to 2 bags, 100% Free</li>
                <li>No changes or modifications are allowed.</li>
                <li>Your order is for personal or family use ONLY and not for resale.</li>
            </ul>
        </div>
    </div>
</x-app-layout>
