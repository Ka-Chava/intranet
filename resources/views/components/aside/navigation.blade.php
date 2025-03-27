<nav {{ $attributes->merge(['class' => 'card navigation']) }}>
    <h2 class="navigation__heading">
        <span class="navigation__logo">
            <x-heroicon-o-home />
        </span>

        <span class="navigation__title">Organization</span>
    </h2>

    <ul class="navigation__list">
        @foreach ($links as $link)
            @php
                $is_active = Route::current()->getName() === $link['url'];
                $is_external = false;
                if (str_starts_with($link['url'], 'http')) {
                    $url = $link['url'];
                    $is_external = true;
                }
                else {
                    $url = route($link['url']);
                }
            @endphp
            <li {{ $is_active ? "class=active" : null }}>
                <a
                    href="{{ $url }}"
                    class="card card--clickable navigation__link"
                    {{ $is_external ? "target=_blank" : "wire:navigate" }}
                    {{ $is_active ? "aria-current=page" : null }}
                >
                    @if($link['icon'])
                        {{ svg($link['icon']) }}
                    @endif

                    {{ $link['title'] }}

                    @if($is_external)
                        <x-heroicon-o-chevron-right class="ml-auto" />
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</nav>
