<div x-data="{ expanded: false }" {{ $attributes->only('class')->merge(['class' => 'helpdesk-category']) }} {{ $attributes }}>
    <button type="button" class="helpdesk-category__accordion" x-on:click="expanded = ! expanded" x-bind:aria-expanded="expanded ? 'true' : 'false'">
        <div class="heading">
            <h3 class="heading__title helpdesk-category__title">
                {{ $category->name }}
            </h3>

            <p class="heading__subtitle helpdesk-category__subtitle">
                {{ $category->description }}
            </p>
        </div>

        <x-heroicon-o-chevron-down class="flowing-all min-w-6 min-h-6" x-bind:class="{ '-rotate-180': expanded }" />
    </button>

    <div x-cloak x-collapse x-show="expanded">
        <div class="helpdesk-category__content">
            @foreach($category->requests as $request)
                <x-helpdesk.request-card
                    :$request
                    @click="Livewire.dispatch('setup-request-form', { request: {{ json_encode($request) }} })"
                />
            @endforeach
        </div>
    </div>
</div>
