<div
    x-data="{open: false, smooth: false}"
    x-show="open"
    id="HandbookDrawer"
    role="document"
    tabindex="-1"
    class="drawer handbook-drawer"
    :class="{'active': open}"
    x-transition:enter-start="active translate-x-full"
    x-transition:enter="active transition-all ease-linear duration-200"
    x-transition:enter-end="active translate-x-0"
    x-transition:leave="active transition-all ease-linear duration-200"
    x-transition:leave-start="active translate-x-0"
    x-transition:leave-end="active translate-x-full"
    @keydown.esc.prevent="open = false; smooth = false;"
    @open-handbook-drawer.window="
        setTimeout(() => {
            $refs.content.scrollTo({
                behavior: smooth ? 'smooth' : 'auto',
                top: ($refs.content.querySelector('#' + $event.detail?.target)?.offsetTop || 0) - 15,
            });

            smooth = true;
        }, open ? 0 : 200);
        open = true;
    "
>
    <div class="drawer__header">
        <button
            type="button"
            class="button button--secondary drawer__button"
            @click="open = false; smooth = false;"
        >
            <x-heroicon-o-chevron-right />
        </button>
    </div>

    <div class="drawer__body handbook-drawer__content" x-ref="content">
        <h1>Welcome</h1>

        @foreach($sections as $section)
            <div class="handbook-drawer__section" id="@handleize($section->title)">
                <div class="handbook-drawer__headline">
                    <h2>
                        {{ $section->title }}
                    </h2>

                    <div class="handbook-drawer__actions">
                        <button class="button button--primary button--small">
                            <x-heroicon-o-bookmark />
                        </button>

                        <button class="button button--primary button--small">
                            <x-heroicon-o-arrow-down-tray />
                        </button>
                    </div>
                </div>

                <p>
                    {{ $section->description }}
                </p>

                @if(!empty($section->posts))
                    <div class="handbook-drawer__group">
                        @foreach($section->posts as $post)
                            <div class="handbook-drawer__block" id="@handleize($section->title . $post->title)">
                                <h3>
                                    {{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ $post->title }}
                                </h3>

                                <p>
                                    {{ $post->content }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
