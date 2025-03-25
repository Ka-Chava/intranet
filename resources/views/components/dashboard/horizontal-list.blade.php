<div
    class="horizontal-list"
    x-data="carousel()"
    @mouseup="stopDrag()"
    @mouseleave="stopDrag()"
    @mousemove="onDrag($event)"
>
    @if($heading)
        <div class="horizontal-list__header">
            <h2 class="horizontal-list__title">
                {{ $heading }}
            </h2>

            <x-dropdown>
                <div class="menu">
                    <a href="#" class="button menu__item">Action 1</a>
                    <a href="#" class="button menu__item">Action 2</a>
                    <a href="#" class="button menu__item">Action 3</a>
                    <a href="#" class="button menu__item">Action 4</a>
                </div>
            </x-dropdown>
        </div>
    @endif

    <div
        x-ref="scrollContainer"
        class="horizontal-list__items"
        :inert="isDragActive"
        @mousedown="startDrag($event)"
    >
        @foreach($items as $item)
            <x-dashboard.post-card :post="$item" :key="$loop->index" class="horizontal-list__item" />
        @endforeach
    </div>
</div>

<script>
    function carousel() {
        return {
            isDragging: false,
            isDragActive: false,
            startX: 0,
            scrollLeft: 0,
            velocity: 0,
            lastX: 0,
            lastTime: 0,
            momentumActive: false,

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
            },

            onDrag(event) {
                if (!this.isDragging) return;
                let now = Date.now();
                let deltaX = event.pageX - this.startX;
                let deltaTime = now - this.lastTime;

                this.$refs.scrollContainer.scrollLeft = this.scrollLeft - deltaX;

                this.velocity = (event.pageX - this.lastX) / (deltaTime || 1);

                this.lastX = event.pageX;
                this.lastTime = now;
            },

            stopDrag() {
                this.isDragActive = false;
                this.isDragging = false;
                this.applyMomentum();
            },

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
            },
        };
    }
</script>

