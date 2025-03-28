<div
    x-data="new Select({{ json_encode($options) }}, '{{ $selected }}')"
    {{ $attributes->only('class')->merge(['class' => 'select']) }} {{$attributes}}
>
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        class="select__control"
        aria-hidden="true"
        tabindex="-1"
        x-model="selected"
    >
        <option x-bind:selected="selected === null ? 'selected' : null"></option>

        <template x-for="option in options" :key="option.value">
            <option
                :value="option.value"
                x-bind:selected="isSelected(option.value) ? 'selected' : null"
                x-text="option.label"
            ></option>
        </template>
    </select>

    <div class="select__wrapper">
        @if($label)
            <label for="{{ $id }}-button" class="select__label">
                {{ $label }}
            </label>
        @endif

        <button
            x-on:click="openMenu()"
            x-bind:aria-expanded="open"
            id="{{ $id }}-button"
            type="button"
            class="button button--primary button--small select__input"
            aria-haspopup="listbox"
            aria-controls="{{ $id }}-menu-list"
        >
            <span x-text="selectedOption ? selectedOption.label : '{{ $placeholder }}'" class="grow truncate"></span>

            <x-heroicon-o-chevron-down />
        </button>
    </div>

    <ul
        x-cloak
        x-ref="selectMenu"
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 -translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-3"
        x-on:click.outside="closeMenu()"
        x-on:keydown.esc.prevent.stop="closeMenu()"
        class="menu select__list"
        id="{{ $id }}-menu-list"
        aria-labelledby="{{ $id }}-button"
        aria-orientation="vertical"
        role="listbox"
        tabindex="0"
    >
        <template x-for="option in options" :key="option.value">
            <li
                x-on:click="setSelected(option); $dispatch('change', option.value)"
                :aria-selected="isSelected(option.value)"
                :title="option.label"
                class="button button--small menu__item select__option"
                role="option"
                tabindex="0"
            >
                <div class="grow truncate" x-text="option.label"></div>

                <x-heroicon-o-check-circle x-show="isSelected(option.value)" />
            </li>
        </template>
    </ul>
</div>
