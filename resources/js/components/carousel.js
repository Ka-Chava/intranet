export default class Carousel {
    constructor() {
        this.isDragging = false;
        this.isDragActive = false;
        this.startX = 0;
        this.scrollLeft = 0;
        this.velocity = 0;
        this.lastX = 0;
        this.lastTime = 0;
        this.momentumActive = false;
    };

    startDrag(event) {
        this.isDragging = true;
        this.momentumActive = false;
        this.startX = event.pageX;
        this.scrollLeft = this.$refs.scrollContainer.scrollLeft;
        this.lastX = event.pageX;
        this.lastTime = Date.now();
        this.velocity = 0;

        setTimeout(() => {
            this.isDragActive = true;
        }, 100);
    };

    onDrag(event) {
        if (!this.isDragging) return;
        let now = Date.now();
        let deltaX = event.pageX - this.startX;
        let deltaTime = now - this.lastTime;

        this.$refs.scrollContainer.scrollLeft = this.scrollLeft - deltaX;

        this.velocity = (event.pageX - this.lastX) / (deltaTime || 1);

        this.lastX = event.pageX;
        this.lastTime = now;
    };

    stopDrag() {
        this.isDragActive = false;
        this.isDragging = false;
        this.applyMomentum();
    };

    applyMomentum() {
        if (this.momentumActive) return;
        this.momentumActive = true;

        let container = this.$refs.scrollContainer;
        let friction = 0.95;

        const momentumLoop = () => {
            if (Math.abs(this.velocity) < 0.1) {
                this.momentumActive = false;
                return;
            }

            container.scrollLeft -= this.velocity * 10;
            this.velocity *= friction;
            requestAnimationFrame(momentumLoop);
        };

        momentumLoop();
    };
};
