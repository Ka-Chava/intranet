@if($article)
    <section class="blog-post-meta">
        <div class="user-info">
            <div class="user-info__wrapper">
                <div class="user-info__avatar user-info__avatar--large">
                    @if($article->author->avatar)
                        <img src="{{ $article->author->avatar }}" alt="" class="user-info__avatar-image" />
                    @else
                        <x-heroicon-o-user class="w-7 h-7" />
                    @endif
                </div>

                <div class="user-info__details">
                    <div class="user-info__name">
                        {{ $article->author->name }}
                    </div>

                    <div class="user-info__tagline">
                        {{ $article->author->tagline }}
                    </div>
                </div>
            </div>
        </div>

        <div class="blog-post-meta__row">
            <div class="blog-post-meta__cell">
                <span class="blog-post-meta__label">Last edited:</span>
                <span>{{ date('M d, Y', strtotime($article->updated_at)) }}</span>
            </div>

            @if(isset($article->published_at))
                <div class="blog-post-meta__cell">
                    <span class="blog-post-meta__label">Published:</span>
                    <span>{{ date('M d, Y', strtotime($article->published_at)) }}</span>
                </div>
            @endif
        </div>
    </section>
@endif
