<x-blog-layout>
    <x-global.hero :title="$article->title" :image="$article->image">
        @if(isset($article->tags) && count($article->tags) > 0)
            <x-slot:tagline>
                @foreach($article->tags as $tag)
                    <span>{{ $tag->name }}</span>
                @endforeach
            </x-slot:tagline>
        @endif
    </x-global.hero>

    <x-blog.blog-post-meta :article="$article" />

    <section class="blog-post-content">
        <div class="blog-post-content__container rte">
            {!! $article->content !!}
        </div>
    </section>
</x-blog-layout>
