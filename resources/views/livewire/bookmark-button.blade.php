<button
    x-data="{ active: $wire.entangle('bookmarked'), hideNonBookmarked: $wire.entangle('hideNonBookmarked') }"
    class="button p-0 {{ $class }}"
    :class="{ 'hidden': hideNonBookmarked && !active }"
    @click.prevent="$event.stopPropagation(); active = !active;"
    wire:click="toggle"
>
    <x-heroicon-c-bookmark x-show="active" />
    <x-heroicon-o-bookmark x-show="!active" />
</button>
