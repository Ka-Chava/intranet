import './bootstrap';
import Theme from './theme.js';

import Select from './components/select.js';
import Calendar from './components/calendar.js';
import Carousel from './components/carousel.js';
import HandbookSection from './components/handbook-sections.js';
import RichTextEditor from './components/rich-text-editor.js';
import QuantitySelect from './components/quantity-select.js';
import ProductsForm from './components/products-form.js';

window.Select = Select;
window.Calendar = Calendar;
window.Carousel = Carousel;
window.HandbookSection = HandbookSection;
window.RichTextEditor = RichTextEditor;
window.QuantitySelect = QuantitySelect;
window.ProductsForm = ProductsForm;

window.Theme = Theme;
Theme.set();

document.addEventListener('livewire:navigated', () => {
    window.Theme.set(window.Theme.get());
});
