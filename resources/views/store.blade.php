<x-app-layout>
    <x-global.page-header>
        <x-slot:html>
            <x-store.header />
        </x-slot:html>
    </x-global.page-header>
    <div class="employee-store" id="EmployeeStore">
        <form class="employee-store__products" name="store" method="post">
            <h2>Shakes</h2>
            <p>You may select up to 2 bags</p>
            <ul class="employee-store__products-list">
                @foreach($products as $product)
                    <li>
                        <div class="product-card" data-inventory="{{ $product->inventory }}">
                            <div class="product-card__header">
                                <h2>{{ $product->title }}</h2>
                            </div>
                            <img src="{{ $product->image_url }}" alt="{{ $product->image_alt }}"/>
                            <div class="product-card__body">
                                <select name="quantity">
                                    @for($i=0; $i<=2; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <button id="AddToCart" class="w-full">Add to cart</button>
        </form>
        <div class="employee-store__shipping">
            <h2>Shipping</h2>
            <p>Select or create a shipping address.</p>
        </div>
        <div class="employee-store__confirm">
            <h2>Confirm and Submit</h2>
            <p>Is your order and information correct?</p>
        </div>
    </div>
</x-app-layout>
