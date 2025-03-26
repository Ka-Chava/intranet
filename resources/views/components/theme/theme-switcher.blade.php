<button
    type="button"
    class="button card card--clickable header-pill"
    x-data="{ theme: Theme.get() }"
    @click="theme = theme === 'light' ? 'dark' : 'light'; Theme.set(theme);"
>
    <span class="header-pill__desktop">
        <span class="header-pill__dot">&bull;</span>
        <span>Theme:</span>
        <span x-text="theme === 'dark' ? 'Dark' : 'Light'"></span>
    </span>
    <x-heroicon-o-moon x-show="theme === 'dark'" />
    <x-heroicon-o-sun x-show="theme !== 'dark'" />
</button>
