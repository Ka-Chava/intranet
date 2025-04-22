<section class="hero">
    <div class="hero__content">
        <h1 class="hero__title">
            {{ $title }}
        </h1>

        @if(isset($tagline))
            <div class="hero__tagline">
                {{ $tagline }}
            </div>
        @endif
    </div>

    <div class="hero__media">
        @if(isset($image))
            <img src="{{ $image }}" alt="{{ $title }}" class="hero__image" />
        @endif
    </div>
</section>
