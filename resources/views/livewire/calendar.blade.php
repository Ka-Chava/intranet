<div
    x-data="new Calendar('{{ now()->format('Y-m-d') }}', {onDateChange: (date) => @this.call('updateSelectedDate', date)})"
    class="calendar card {{ $class }}"
    aria-label="Choose date"
>
    <input type="hidden" x-model="datepickerValue" wire:model="selectedDate" />

    <div class="calendar__preview">
        <x-heroicon-o-calendar class="!w-6 !h-6 text-on-surface-de-emphasis" />

        <div class="calendar__cell calendar__cell--body active" x-text="new Date(selectedDate).getDate()"></div>
    </div>

    <div class="calendar__header">
        <div class="calendar__title">
            <span x-text="Calendar.MONTHS[month]" />
        </div>

        <div class="calendar__buttons">
            <button
                type="button"
                class="button calendar__button"
                @click="prevMonth()"
            >
                <x-heroicon-o-chevron-left />
            </button>

            <button
                type="button"
                class="button calendar__button"
                @click="nextMonth()"
            >
                <x-heroicon-o-chevron-right />
            </button>
        </div>
    </div>

    <div class="calendar__body">
        <div class="calendar__grid">
            <template x-for="day in Calendar.DAYS" :key="day">
                <div class="calendar__cell calendar__cell--heading" x-text="day.charAt(0)" aria-label="day" />
            </template>
        </div>

        <div class="calendar__grid" role="listbox">
            <template x-for="day in prevMonthDays" :key="'prev-' + day">
                <div
                    class="calendar__cell calendar__cell--body calendar__cell--muted"
                    x-text="String(day).padStart(2, '0')"
                    @click="selectPrevMonthDate(day)"
                />
            </template>

            <template x-for="date in noOfDays" :key="'current-' + month + date">
                <div
                    tabindex="0"
                    role="option"
                    class="calendar__cell calendar__cell--body"
                    :class="{'active': isSelectedDate(date)}"
                    :aria-selected="isSelectedDate(date)"
                    @click="updateDateValue(date)"
                >
                    <span x-text="String(date).padStart(2, '0')"></span>

                    {{--<template x-if="isHoliday(date, {{ $holidays }}) && !isSelectedDate(date)">
                        <span class="calendar__holiday"></span>
                    </template>--}}
                </div>
            </template>

            <template x-for="day in nextMonthDays" :key="'next-' + day">
                <div
                    class="calendar__cell calendar__cell--body calendar__cell--muted"
                    x-text="String(day).padStart(2, '0')"
                    @click="selectNextMonthDate(day)"
                />
            </template>
        </div>
    </div>
</div>
