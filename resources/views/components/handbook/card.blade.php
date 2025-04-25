<div
    tabindex="0"
    {{ $attributes->only('class')->merge(['class' => 'card card--clickable button handbook-card']) }}
    {{ $attributes }}
>
    <div class="handbook-card__content">
        <div class="handbook-card__header">
            <h3 class="handbook-card__title">
                @if($heading)
                    {{ $heading }}
                @else
                    {{ $bookmarkable->title }}
                @endif
            </h3>

            @if(isset($bookmarkable))
                <livewire:bookmark-button
                    :key="$bookmarkable->id"
                    :bookmarkable="$bookmarkable"
                    :bookmarked="$bookmarked ?? false"
                    :hide-non-bookmarked="true"
                    class="text-inherit"
                />
            @endif
        </div>

        <p class="handbook-card__preview">
            @if($bookmarkable->description)
                {{ $bookmarkable->description }}
            @else
                {!! $bookmarkable->content !!}
            @endif
        </p>
    </div>

    <x-icon-log-out-right class="handbook-card__icon" />
</div>
