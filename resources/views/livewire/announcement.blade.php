<div x-data="{ isDismissed: false }">
    @if($hasAnnouncements)
        <div
            class="announcement"
            x-show="!isDismissed"
            x-transition:leave="transition ease-in duration-200 transform opacity-0"
            x-transition:enter="transition ease-out duration-200 transform opacity-100"
        >
            <h2 class="announcement__heading">
                {{ $announcement->title }}
            </h2>

            <p>{{ $announcement->content }}</p>

            <div class="announcement__footer">
                <button
                    class="button button--primary"
                    x-on:click="isDismissed = true"
                    wire:click="dismiss({{ $announcement->id }})"
                >
                    Dismiss
                </button>

                <button
                    class="button button--secondary"
                    x-on:click="isDismissed = true"
                    wire:click="remind({{ $announcement->id }})"
                >
                    Remind me later
                </button>
            </div>
        </div>
    @endif
</div>

