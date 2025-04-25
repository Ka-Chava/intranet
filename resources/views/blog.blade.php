<x-app-layout>
    <div class="heading gap-6">
        <h2 class="heading__title">
            {{ $blog->title }}
        </h2>

        @if($blog->description)
            <p class="heading__subtitle font-regular">
                {{ $blog->description }}
            </p>
        @endif
    </div>

    @if(count($blog->articles) > 0)
        <div class="cards-grid">
            @foreach($blog->articles as $article)
                <x-global.post-card :post="$article" :key="$loop->index" />
            @endforeach
        </div>
    @endif
</x-app-layout>
