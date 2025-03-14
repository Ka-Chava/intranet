<button
    type="button"
    class="button header-pill"
    x-data="{ theme: Theme.get() }"
    @click="theme = theme === 'light' ? 'dark' : 'light'; Theme.set(theme);"
>
    <span class="header-pill__desktop">
        <span class="header-pill__dot">&bull;</span>
        <span>Theme:</span>
        <span x-text="theme === 'dark' ? 'Dark' : 'Light'"></span>
    </span>
    <x:feather-moon class="w-5 h-5" x-show="theme === 'dark'" />
    <x:feather-sun class="w-5 h-5" x-show="theme !== 'dark'" />
</button>
