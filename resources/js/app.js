import './bootstrap';
import Theme from './theme.js';

import Select from './components/select.js';
import Calendar from './components/calendar.js';
import Carousel from './components/carousel.js';
import HandbookSection from './components/handbook-sections.js';

window.Select = Select;
window.Calendar = Calendar;
window.Carousel = Carousel;
window.HandbookSection = HandbookSection;

window.Theme = Theme;
Theme.set();

document.addEventListener('livewire:navigated', () => {
    window.Theme.set(window.Theme.get());
});
