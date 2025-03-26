<div
    class="horizontal-list"
    x-data="new Carousel()"
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


