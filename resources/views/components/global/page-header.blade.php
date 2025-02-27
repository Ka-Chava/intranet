<div class="page-header">
    @isset($title)
    <h1>{{$title}}</h1>
    <div class="page-header__caption">
        {{ $caption }}
    </div>
    @endisset
    {{ $html }}
</div>
