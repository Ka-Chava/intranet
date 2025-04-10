<div
    x-cloak
    x-data="{open: false, smooth: false}"
    id="HandbookDrawer"
    role="document"
    tabindex="-1"
    class="drawer handbook-drawer"
    :class="{'active': open}"
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
                    <h2>{{ $section->title }}</h2>

                    <div class="handbook-drawer__actions">
                        <button class="button button--primary button--small">
                            <x-heroicon-o-bookmark />
                        </button>

                        <button class="button button--primary button--small">
                            <x-heroicon-o-arrow-down-tray />
                        </button>
                    </div>
                </div>

                <p>{{ $section->description }}</p>

                @if(!empty($section->posts))
                    <div class="handbook-drawer__group">
                        @foreach($section->posts as $post)
                            <div class="handbook-drawer__block group/block" id="@handleize($section->title . $post->title)">
                                <h3 class="handbook-drawer__block-title">
                                    <span>
                                        {{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ $post->title }}
                                    </span>

                                    <button class="button handbook-drawer__block-button group-hover/block:opacity-100">
                                        <x-heroicon-o-bookmark />
                                    </button>
                                </h3>

                                <p>
                                    {{ $post->content }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <button class="button button--small button--secondary flex mt-8 ml-auto">
                    <x-heroicon-o-arrow-down-tray /> Download
                </button>
            </div>
        @endforeach
    </div>
</div>
