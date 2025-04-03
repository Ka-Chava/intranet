<div
    id="{{ $id }}"
    x-data="{ open: false, visible: false, toggle() { setTimeout(() => this.visible = this.open, 200) } }"
    @keydown.esc.prevent.stop="open = false; toggle();"
    @open-modal.window="open = $event.detail.modal === '{{ $id }}'; visible = open;"
    @close-modal.window="open = $event.detail.modal === '{{ $id }}' ? false : open; toggle();"
    {{ $attributes->only('class')->merge(['class' => 'modal']) }}
    {{ $attributes }}
>
    <div
        x-cloak
        x-show="open"
        x-trap="open"
        x-trap.inert="open"
        x-trap.noscroll="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-bind:aria-hidden="!open"
        tabindex="-1"
        role="dialog"
        class="modal__backdrop"
    >
        <div
            x-cloak
            x-show="open"
            x-on:pointerdown.outside="open = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-full"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-full"
            role="document"
            class="modal__dialog"
        >
            <template x-if="visible">
                <div class="modal__container">
                    <div class="heading modal__header">
                        @if($title)
                            <h3 class="heading__title">
                                {{ $title }}
                            </h3>
                        @endif

                        <button
                            x-on:click="open = false"
                            type="button"
                            @class(['sr-only' => !$showCloseButton])
                        >
                            <span class="sr-only">Close modal</span>
                            <x-heroicon-o-x-mark />
                        </button>
                    </div>

                    <div class="modal__body">
                        {{ $slot }}
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
