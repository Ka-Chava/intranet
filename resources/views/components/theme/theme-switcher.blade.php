<button
    type="button"
    class="button button--small theme-toggler"
    x-data="{ theme: Theme.get() }"
    @click="theme = theme === 'light' ? 'dark' : 'light'; Theme.set(theme);"
>
    <span class="pr-5">Theme:</span>
    <span x-text="theme === 'dark' ? 'Dark' : 'Light'"></span>
    <x:feather-moon class="w-5 h-5" x-show="theme === 'dark'" />
    <x:feather-sun class="w-5 h-5" x-show="theme !== 'dark'" />
</button>
