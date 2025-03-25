<ol class="handbook-sections">
    @foreach($sections as $section)
        <li class="handbook-sections__item">
            <h2 class="handbook-sections__title">
                {{ $section->title }}
            </h2>

            <p class="handbook-sections__description">
                {{ $section->description }}
            </p>

            @if(!empty($section->posts))
                <div
                    class="handbook-sections__group"
                    :key="@handleize($section->title)"
                    x-data="{
                        expanded: false,
                        showExpand: false,
                        observer: null,
                        calc() { this.showExpand = $refs.content.scrollHeight > 300; }
                    }"
                    x-init="
                        calc();
                        observer = new ResizeObserver(() => { calc(); });
                        observer.observe($refs.content);
                    "
                >
                    <ol
                        class="handbook-grid handbook-sections__grid"
                        :class="{ 'expanded': expanded }"
                        x-ref="content"
                    >
                        @foreach($section->posts as $post)
                            <li
                                class="handbook-card button"
                                tabindex="0"
                                title="{{ $post->title }}"
                                @click="$dispatch('open-handbook-drawer', { target: '@handleize($section->title . $post->title)' })"
                                @keypress.enter="$dispatch('open-handbook-drawer', { target: '@handleize($section->title . $post->title)' })"
                            >
                                <div class="handbook-card__content">
                                    <h3 class="handbook-card__title">
                                        {{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ $post->title }}
                                    </h3>

                                    <p class="handbook-card__preview">
                                        {{ $post->content }}
                                    </p>
                                </div>

                                <x-icon-log-out-right class="handbook-card__icon" />
                            </li>
                        @endforeach
                    </ol>

                    <div x-show="showExpand" class="handbook-sections__scrim">
                        <button
                            class="button button--small handbook-sections__button"
                            :class="{'expanded': expanded}"
                            @click="expanded = !expanded"
                        >
                            <span x-text="expanded ? 'View less' : 'View more'"></span>

                            <x-heroicon-o-chevron-right />
                        </button>
                    </div>
                </div>
            @endif
        </li>
    @endforeach
</ol>
