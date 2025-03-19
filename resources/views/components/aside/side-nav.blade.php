<aside class="side-nav" x-data="{ collapsed: false }" :class="collapsed && 'collapsed'">
    <div @class(['side-nav__header', 'side-nav__header--right' => $position === 'right'])>
        @if(isset($header) && trim($header) !== '')
            <div x-show="!collapsed">
                {{ $header }}
            </div>
        @endif

        <button
            id="CollapseNavigation"
            aria-label="Collapse Navigation"
            @class(['button', 'side-nav__button', 'side-nav__button--right' => $position === 'right'])
            @click="collapsed = !collapsed"
        >
            <span {{ $position === 'right' ? 'x-show=!collapsed' : 'x-show=collapsed' }}>
                <x-heroicon-o-chevron-right />
            </span>

            <span {{ $position === 'right' ? 'x-show=collapsed' : 'x-show=!collapsed' }}>
                <x-heroicon-o-chevron-left />
            </span>
        </button>
    </div>

    {{ $slot }}
</aside>

