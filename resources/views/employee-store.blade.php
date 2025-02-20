<x-app-layout>
    <div class="employee-store" id="EmployeeStore">
        <div class="employee-store__products">
            <ul class="employee-store__products-list">
                @foreach($products as $product)
                    <li>
                        <div class="product-card" data-inventory="{{ $product->inventory }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->image_alt }}" />
                            <div class="product-card__body">
                                <h2>{{ $product->title }}</h2>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="employee-store__info">
2222
        </div>
    </div>
</x-app-layout>
