import axios from 'axios';
import focus from '@alpinejs/focus'

Alpine.plugin(focus);
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
