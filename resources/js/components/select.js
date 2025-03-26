export default class Select {
    constructor(options = [], selected = null) {
        this.open = false;
        this.options = options;
        this.selected = selected;
        this.selectedOption = null;
    }

    init() {
        this.selectedOption = this.options.find(option => String(option.value) === String(this.selected));
    };

    openMenu() {
        this.open = true;
    };

    closeMenu() {
        this.open = false;
    };

    setSelected({value, label}) {
        this.selected = value;
        this.selectedOption = {value, label};
        this.closeMenu();
    };

    isSelected(value) {
        return String(value) === String(this.selected);
    };
}
