<form class="product-form form" method="post" wire:submit.prevent="submit">
    <div class="product-form__heading">
        <div class="heading">
            <h2 class="heading__title">Shakes</h2>
            <p class="heading__subtitle heading__subtitle--normal heading__subtitle--secondary">You may select up to 2 bags</p>
        </div>

        @if ($errors->has('items'))
            <span class="form__error">{{ $errors->first('items') }}</span>
        @endif
    </div>

    <div x-data="{ limit: @entangle("limit") }">
        <ul
            class="product-form__list"
            x-data="new Carousel()"
            x-ref="scrollContainer"
            @mouseup="stopDrag()"
            @mouseleave="stopDrag()"
            @mousemove="onDrag($event)"
            @mousedown="startDrag($event)"
        >
            @foreach($products as $product)
                <li x-data="{value: @entangle("items.$loop->index.quantity")}">
                    <div class="product-card">
                        <div class="product-card__header">
                            <h2>{{ $product->title }}</h2>
                        </div>

                        <div class="product-card__image-wrapper">
                            <img class="product-card__image" src="{{ $product->image_url }}" alt="{{ $product->image_alt }}" />
                        </div>

                        <div class="quantity-select" x-data="new QuantitySelect({value, max: limit})">
                            <button
                                :disabled="isMin"
                                type="button"
                                class="button quantity-select__button"
                                @click="decrement"
                            >
                                <x-heroicon-c-minus />
                            </button>

                            <input
                                readonly
                                type="number"
                                :min="min"
                                :max="max"
                                x-ref="input"
                                class="quantity-select__input"
                                :class="{ 'inactive': !value }"
                                wire:model.number="items.{{ $loop->index }}.quantity"
                            />

                            <button
                                :disabled="isMax"
                                type="button"
                                class="button quantity-select__button"
                                @click="increment"
                            >
                                <x-heroicon-c-plus />
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @if ($errors->has('general'))
        <ul class="error-list product-form__errors">
            <span class="error-list__label">Store errors</span>

            @foreach ($errors->get('general') as $error)
                <li class="error-list__item">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <button
        id="AddToCart"
        class="button button--primary button--full product-form__submit"
        wire:loading.attr="disabled"
    >
        <span wire:loading.remove>Continue</span>
        <span wire:loading>
            <x-heroicon-o-arrow-path class="animate-spin" />
        </span>
    </button>
</form>
