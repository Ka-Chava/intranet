<div class="holiday-list {{ $class }}">
    @php
        $options = [
            ['label' => 'Next 7 days', 'value' => 7],
            ['label' => 'Next 30 days', 'value' => 30],
            ['label' => 'Next 60 days', 'value' => 60],
            ['label' => 'Next 90 days', 'value' => 90],
        ];
    @endphp
    <x-select
        :options="$options"
        :selected="$holidaysRange"
        id="holidays-range"
        name="range"
        class="holiday-list__select"
        @change="$wire.changeRange($event.detail)"
    />

    <div class="holiday-list__notification">
        <x-heroicon-o-bell class="!w-6 !h-6 text-on-surface-de-emphasis" />

        @if($holidaysCount)
            <span class="holiday-list__counter">
                {{ $holidaysCount }}
            </span>
        @endif
    </div>

    @forelse($holidays as $holiday)
        <div
            class="holiday-card"
            :key="$holiday->id"
            x-data="{ dismissed: false }"
            x-show="!dismissed"
            x-transition:leave="transition transform duration-300 ease-in-out"
            x-transition:leave-start="translate-x-10 opacity-0"
            x-transition:leave-end="translate-x-full opacity-0"
        >
            <div class="holiday-card__header">
                <span class="holiday-card__countdown">
                    @if($holiday->until > 1)
                        In {{ $holiday->until }} days
                    @elseif($holiday->until == 1)
                        Tomorrow
                    @else
                        Today
                    @endif
                </span>

                <span>
                    {{ $holiday->title }}
                </span>
            </div>

            <div class="holiday-card__footer">
                <div class="holiday-card__country">
                    <div class="holiday-card__image-wrapper">
                        @if($holiday->image)
                            <img src="{{ $holiday->image }}" alt="" class="holiday-card__image" />
                        @else
                            <x-heroicon-o-globe-alt class="holiday-card__image" />
                        @endif
                    </div>

                    <span class="holiday-card__name">
                        Holiday in {{ $holiday->country }}
                    </span>
                </div>

                <button
                    type="button"
                    class="button button--primary holiday-card__button"
                    @click="dismissed = true"
                    @click="dismissed = true; $wire.dismiss({{ $holiday->id }})"
                >
                    Dismiss
                </button>
            </div>
        </div>
    @empty
        <div class="holiday-card holiday-card--empty">
            <span class="text-center">
                There are no upcoming holidays
            </span>
        </div>
    @endforelse
</div>
