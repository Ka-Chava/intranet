<div class="flex flex-col gap-6">
    <div class="heading">
        <h2 class="heading__title">
            Bookmarks
        </h2>

        <p class="heading__subtitle">
            Your saved reading
        </p>
    </div>

    <div class="handbook-grid">
        @if(!empty($bookmarks))
            @foreach($bookmarks as $bookmark)
                <x-handbook.card
                    wire:key="{{ $bookmark->id }}"
                    :bookmarkable="$bookmark->bookmarkable"
                    :bookmarked="true"
                    :title="$bookmark->bookmarkable->title"
                    @click="$dispatch('open-handbook-drawer', { target: '{{ $bookmark->bookmarkable->slug }}' })"
                    @keypress.enter="$dispatch('open-handbook-drawer', { target: '{{ $bookmark->bookmarkable->slug }}' })"
                >
                    <x-slot:heading>
                        {{ $bookmark->bookmarkable->title }}
                    </x-slot:heading>
                </x-handbook.card>
            @endforeach
        @endif

        @foreach(range(1, max(4 - count($bookmarks), 1)) as $index)
            <button type="button" class="card card--transparent card--clickable bookmark-card-empty">
                Add a bookmark

                <x-icon-plus-square class="bookmark-card-empty__icon" />
            </button>
        @endforeach
    </div>
</div>
