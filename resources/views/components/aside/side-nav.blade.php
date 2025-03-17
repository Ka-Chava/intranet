@php
    $links = [
        ['url' =>'dashboard', 'title' => 'Dashboard', 'icon' => 'grid'],
        ['url' =>'dashboard', 'title' => 'Handbook', 'icon' => 'file'],
        ['url' =>'dashboard', 'title' => 'Company News', 'icon' => 'apartment'],
        ['url' =>'dashboard', 'title' => 'Help Desk', 'icon' => 'laptop'],
        ['url' =>'dashboard', 'title' => 'I.T. News', 'icon' => 'database'],
        ['url' =>'https://www.adp.com', 'title' => 'ADP', 'icon' => 'adp'],
        ['url' =>'http://kachava.dash.app', 'title' => '401k', 'icon' => 'wallet'],
        ['url' =>'http://kachava.dash.app', 'title' => 'Dash', 'icon' => 'dash'],
        ['url' =>'store', 'title' => 'Employee Store', 'icon' => 'cart'],
    ]
@endphp
<aside class="side-nav" x-data="{ collapsed: false }" :class="collapsed && 'collapsed'">
    <div class="side-nav__header">
        <div x-show="!collapsed">
            <x-aside.user-info />
        </div>

        <button
            id="CollapseNavigation"
            aria-label="Collapse Navigation"
            class="button side-nav__button"
            @click="collapsed = !collapsed; $dispatch('user-info-collapse-navigation', {collapsed: collapsed})"
        >
            <span x-show="collapsed">
                {{ svg('heroicon-o-chevron-right') }}
            </span>

            <span x-show="!collapsed">
                {{ svg('heroicon-o-chevron-left') }}
            </span>
        </button>
    </div>

    <div class="side-nav__nav">
        <h2 class="side-nav__heading">
            <span class="flex justify-center" x-show="collapsed">
                {{ svg('heroicon-o-home') }}
            </span>

            <span x-show="!collapsed">Organization</span>
        </h2>

        <ul class="side-nav__list">
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
                        class="side-nav__link"
                        {{ $is_external ? "target=_blank" : null }}
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
    </div>
</aside>

