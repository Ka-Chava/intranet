export default new class Theme {
    set(theme) {
        theme = theme || this.get();
        localStorage.theme = theme;
        document.documentElement.classList.toggle('dark', theme !== 'light');
    }
    get() {
        if(localStorage.theme) return localStorage.theme;
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }
}
