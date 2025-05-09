export default class ProductsForm {
    constructor() {}

    handleSubmit($event) {
        const data = Array.from(new FormData($event.target));
        const formatted = data
            .map(([key, value]) => ({
                'id': key,
                quantity: parseInt(value),
            }));

        if (this.$dispatch && typeof this.$dispatch === 'function') {
            this.$dispatch('cart:update', [formatted]);
        }
    }
}
