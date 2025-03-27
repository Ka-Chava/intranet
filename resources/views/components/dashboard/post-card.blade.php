@if(isset($post))
    <div {{ $attributes->only('class')->merge(['class' => 'card post-card group/card'.($size === 'small' ? ' post-card--small' : '')]) }} {{$attributes}}>
        <div class="post-card__content group-hover/card:after:opacity-0">
            @if(isset($post->image))
                <img src="{{ $post->image }}" alt="" class="post-card__image group-hover/card:scale-105" />
            @endif
        </div>

        <div class="post-card__footer">
            <h3 class="post-card__heading">
                {{ $post->title }}
            </h3>

            @if($size !== 'small')
                <span class="post-card__icon">
                    <x-heroicon-o-plus />
                </span>
            @endif
        </div>

        <a href="{{ $post->url }}" class="post-card__link" aria-label="{{ $post->title }}" wire:navigate></a>
    </div>
@endif
