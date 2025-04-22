<x-app-layout>
    <livewire:announcement />

    @foreach($resources as $resource)
        <x-dashboard.horizontal-list
            :items="$resource->articles"
            :heading="$resource->title"
            :size="$resource->size ?? null"
        />
    @endforeach
</x-app-layout>
