export default class HandbookSection {
    constructor() {
        this.height = 300;
        this.expanded = false;
        this.animated = false;
        this.showExpand = false;
        this.observer = null;
    }

    init() {
        this.calc();
        this.observer = new ResizeObserver(() => {
            this.calc();
        });

        this.observer.observe(this.$refs.content);
    };

    calc() {
        this.height = this.$refs.content?.scrollHeight || 0;
        this.showExpand = this.height > 300;
    };

    animate() {
        this.expanded = !this.expanded;
        this.animated = true;

        setTimeout(() => {
            this.animated = false;
        }, 200);
    };
};
