<tempalte
    x-data
    @setup-address-form.window="$dispatch('open-modal', { modal: 'address-form' });"
    @address-saved.window="$dispatch('close-modal', { modal: 'address-form' });"
>
    <x-modal id="address-form">
        <form wire:submit.prevent="submit" class="form address-form">
            <div class="heading">
                <h3 class="heading__title">Delivery Address</h3>
            </div>

            <p class="my-1">
                Where would you like your order shipped?
            </p>

            <label for="firstName" class="form__field">
                <span class="form__label">
                    <span>First name*</span>

                    @if ($errors->has('firstName'))
                        <span class="form__error">{{ $errors->first('firstName') }}</span>
                    @endif
                </span>

                <input
                    type="text"
                    name="firstName"
                    id="firstName"
                    class="form__control"
                    placeholder="First name"
                    wire:model.live="firstName"
                />
            </label>

            <label for="lastName" class="form__field">
                <span class="form__label">
                    <span>Last name*</span>

                    @if ($errors->has('lastName'))
                        <span class="form__error">{{ $errors->first('lastName') }}</span>
                    @endif
                </span>

                <input
                    type="text"
                    name="lastName"
                    id="lastName"
                    class="form__control"
                    placeholder="Last name"
                    wire:model.live="lastName"
                />
            </label>

            <label for="address1" class="form__field">
                <span class="form__label">
                    <span>Address*</span>

                    @if ($errors->has('address1'))
                        <span class="form__error">{{ $errors->first('address1') }}</span>
                    @endif
                </span>

                <input
                    type="text"
                    name="address1"
                    id="address1"
                    class="form__control"
                    placeholder="Address line 1"
                    wire:model.live="address1"
                />
            </label>

            <label for="address2" class="form__field">
                <span class="form__label">
                    <span>Address line 2</span>

                    @if ($errors->has('address2'))
                        <span class="form__error">{{ $errors->first('address2') }}</span>
                    @endif
                </span>

                <input
                    type="text"
                    name="address2"
                    id="address2"
                    class="form__control"
                    placeholder="Address line 2"
                    wire:model.live="address2"
                />
            </label>

            <div class="form__group">
                <label for="city" class="form__field">
                    <span class="form__label">
                        <span>City*</span>

                        @if ($errors->has('city'))
                            <span class="form__error">{{ $errors->first('city') }}</span>
                        @endif
                    </span>

                    <input
                        type="text"
                        name="city"
                        id="city"
                        class="form__control"
                        placeholder="City"
                        wire:model.live="city"
                    />
                </label>

                <label for="state" class="form__field">
                    <span class="form__label">
                        <span>State/Province*</span>

                        @if ($errors->has('provinceCode'))
                            <span class="form__error">{{ $errors->first('provinceCode') }}</span>
                        @endif
                    </span>

                    <x-select
                        :options="$states"
                        name="provinceCode"
                        id="state"
                        class="form__control"
                        appearance="outline"
                        placeholder="Select state"
                        @change="$wire.changeProvince($event.detail)"
                    />
                </label>
            </div>

            <label for="zip" class="form__field">
                <span class="form__label">
                    <span>Postal code*</span>

                    @if ($errors->has('zip'))
                        <span class="form__error">{{ $errors->first('zip') }}</span>
                    @endif
                </span>

                <input
                    type="number"
                    name="zip"
                    id="zip"
                    class="form__control"
                    placeholder="Postal code"
                    wire:model.live="zip"
                />
            </label>

            <label for="country" class="form__field">
                <span class="form__label">
                    <span>Country*</span>

                    @if ($errors->has('countryCode'))
                        <span class="form__error">{{ $errors->first('countryCode') }}</span>
                    @endif
                </span>

                <x-select
                    :options="[['value' => 'US', 'label' => 'United States']]"
                    :selected="$countryCode"
                    name="countryCode"
                    id="country"
                    class="form__control"
                    appearance="outline"
                    wire:model.live="countryCode"
                />
            </label>

            <label for="set_as_default" class="form__field form__field--checkbox">
                <input
                    type="checkbox"
                    name="setAsDefault"
                    id="set_as_default"
                    class="checkbox"
                    wire:model.live="setAsDefault"
                />

                Set as primary address
            </label>

            @if ($errors->any())
                <ul class="error-list">
                    <span class="error-list__label">Form errors</span>

                    @foreach ($errors->all() as $error)
                        <li class="error-list__item">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="address-form__footer">
                <button
                    type="button"
                    class="button button--secondary"
                    @click="$dispatch('close-modal', { modal: 'address-form' })"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="button button--primary"
                    wire:target="submit"
                    wire:loading.attr="disabled"
                >
                    Save address

                    <span wire:loading wire:target="submit">
                        <x-heroicon-o-arrow-path class="animate-spin" />
                    </span>
                </button>
            </div>
        </form>
    </x-modal>
</tempalte>
