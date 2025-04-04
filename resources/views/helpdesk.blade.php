<x-app-layout>
    <div class="flex flex-col gap-6">
        <div class="heading">
            <h2 class="heading__title">
                <x-icon-laptop width="32" height="32" /> Help Desk
            </h2>

            <p class="heading__subtitle font-regular">
                Welcome! You can raise a request for IT Help Desk using the options provided.
            </p>
        </div>
    </div>

    <x-helpdesk.category-list />

    <livewire:forms.helpdesk-request-form />
</x-app-layout>
