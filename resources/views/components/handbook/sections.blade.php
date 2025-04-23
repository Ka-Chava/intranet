<ol class="handbook-sections">
    @foreach($sections as $section)
        <li class="handbook-sections__item">
            <h2 class="handbook-sections__title">
                {{ $section->title }}
            </h2>

            <p class="handbook-sections__description">
                {{ $section->description }}
            </p>

            @if(!empty($section->articles))
                <div :key="@handleize($section->title)" class="handbook-sections__group" x-data="new HandbookSection()">
                    <div
                        class="handbook-sections__grid-wrapper"
                        :class="{ 'flowing-all': animated }"
                        x-bind:style="showExpand && (!expanded ? 'height: 300px' : 'height:' + height + 'px')"
                    >
                        <ol class="handbook-grid" x-ref="content">
                            @foreach($section->articles as $article)
                                <li>
                                    <x-handbook.card
                                        :key="$article->id"
                                        :bookmarkable="$article"
                                        :bookmarked="isset($article->currentBookmark->id)"
                                        :title="$article->title"
                                        @click="$dispatch('open-handbook-drawer', { target: '{{ $article->slug }}' })"
                                        @keypress.enter="$dispatch('open-handbook-drawer', { target: '{{ $article->slug }}' })"
                                    >
                                        <x-slot:heading>
                                            {{ $loop->parent->iteration }}.{{ $loop->iteration }} {{ $article->title }}
                                        </x-slot:heading>
                                    </x-handbook.card>
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
