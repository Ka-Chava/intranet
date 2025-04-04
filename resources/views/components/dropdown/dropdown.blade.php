<div
    x-data="{ open: false }"
    @keydown.esc.prevent.stop="open = false"
    {{ $attributes->only('class')->merge(['class' => 'dropdown']) }}
    {{ $attributes }}
>
    <button
        type="button"
        class="button dropdown__button"
        x-bind:aria-expanded="open"
        @click="open = true"
    >
        @if($trigger)
            {{ $trigger }}
        @else
            <x-heroicon-o-ellipsis-vertical class="dropdown__icon" />
        @endif
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 -translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-3"
        class="dropdown__content"
        role="listbox"
        @click.outside="open = false;"
        @click="open = $event.target.closest('button, a') ? false : open;"
    >
        {{ $slot }}
    </div>
</div>
