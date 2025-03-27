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
                <div :key="@handleize($section->title)" class="handbook-sections__group" x-data="new HandbookSection()">
                    <div
                        class="handbook-sections__grid-wrapper"
                        :class="{ 'flowing-all': animated }"
                        x-bind:style="showExpand && (!expanded ? 'height: 300px' : 'height:' + height + 'px')"
                    >
                        <ol class="handbook-grid" x-ref="content">
                            @foreach($section->posts as $post)
                                <li
                                    tabindex="0"
                                    title="{{ $post->title }}"
                                    class="card card--clickable button handbook-card"
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
                    </div>

                    <div class="handbook-sections__scrim" :class="{ 'expanded': expanded }" x-show="showExpand">
                        <button
                            class="button button--small card card--clickable handbook-sections__button"
                            :class="{ 'expanded': expanded }"
                            @click="animate()"
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
