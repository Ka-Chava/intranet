export default class QuantitySelect {
    constructor({value = 0, min = 0, max = 2} = {}) {
        this.value = value;
        this.min = min;
        this.max = max;
    }

    get isMin() {
        return this.value <= this.min;
    }

    get isMax() {
        return this.value >= this.max;
    }

    init() {
        this.$watch('limit', newMax => {
            this.max = newMax;
        });

        Array.from(this.$el.attributes)
            .filter(({name}) => name.startsWith('x-bind'))
            .map(attribute => {
                this[attribute.name.replace('x-bind:', '')] = attribute.value;
            });
    }

    increment() {
        if (!this.isMax) {
            this.value++;
            this.emitChange();
        }
    }

    decrement() {
        if (!this.isMin) {
            this.value--;
            this.emitChange();
        }
    }

    emitChange() {
        if (this.$refs.input) {
            this.$refs.input.value = this.value;
            this.$refs.input.dispatchEvent(new Event('input', {bubbles: true}));
        }
    }
}
