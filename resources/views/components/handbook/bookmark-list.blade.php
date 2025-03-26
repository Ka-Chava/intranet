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
        @foreach(range(1, 3) as $index)
            <button type="button" class="card card--transparent card--clickable bookmark-card-empty">
                Add a bookmark

                <x-icon-plus-square class="bookmark-card-empty__icon" />
            </button>
        @endforeach
    </div>
</div>
