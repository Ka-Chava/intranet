<div class="store-shipping">
    <div class="heading">
        <h2 class="heading__title">Shipping</h2>
        <p class="heading__subtitle heading__subtitle--normal heading__subtitle--secondary">Select or create a shipping address.</p>
    </div>

    <div class="store-shipping__container">
        <div class="store-shipping__option">
            <span class="employee-store__label store-shipping__label">Available addresses</span>

            <div class="form">
                <label for="address" class="form__field">
                    <span class="form__label">
                        <span>Ship to</span>
                    </span>

                    @php
                        $options = $addresses->map(function ($address) {
                            $formatted = implode(', ', $address->formatted);
                            $value = Blade::render(
                                "<span class='truncate' title='$formatted'>$formatted</span>"
                            );

                            return (object) [
                                'label' => $value,
                                'value' => $address->id,
                            ];
                        })->toArray();
                    @endphp

                    <livewire:select
                        :options="$options"
                        :selected="$address"
                        :placeholder="'Select an address'"
                        id="address"
                        name="address"
                        class="form__control"
                        appearance="outline"
                        wire:model.live="address"
                    />
                </label>
            </div>
        </div>

        <span class="store-shipping__or">OR</span>

        <div class="store-shipping__option">
            <span class="employee-store__label store-shipping__label">Add a new address</span>

            <button
                class="button button--primary button--full"
                type="button"
                @click="Livewire.dispatch('setup-address-form')"
                wire:loading.attr="disabled"
            >
                Enter address manually
            </button>
        </div>
    </div>

    <livewire:address-form :customer="$customer" />
</div>
