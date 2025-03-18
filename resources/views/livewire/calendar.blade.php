<div x-data="calendar()" x-init="[initDate(), updateDates()]" class="calendar {{ $class }}" aria-label="Choose date">
    <input type="hidden" :value="datepickerValue" wire:model="selectedDate" />

    <div class="calendar__preview">
        <x-heroicon-o-calendar class="!w-6 !h-6 text-on-surface-de-emphasis" />

        <div class="calendar__cell calendar__cell--body active" x-text="new Date(selectedDate).getDate()"></div>
    </div>

    <div class="calendar__header">
        <div class="calendar__title">
            <span x-text="MONTHS[month]" />
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
            <template x-for="day in DAYS" :key="day">
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

            <template x-for="date in noOfDays" :key="'current-' + date">
                <div
                    tabindex="0"
                    role="option"
                    class="calendar__cell calendar__cell--body"
                    :class="{'active': isSelectedDate(date)}"
                    :aria-selected="isSelectedDate(date)"
                    @click="updateDateValue(date)"
                    x-text="String(date).padStart(2, '0')"
                />
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

<script>
    const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const DAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    function calendar() {
        return {
            datepickerValue: '',
            selectedDate: '{{ now()->format('Y-m-d') }}',
            month: '',
            year: '',
            noOfDays: [],
            blankdays: [],
            prevMonthDays: [],
            nextMonthDays: [],
            initDate() {
                const today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();

                this.datepickerValue = today.toISOString().split('T')[0];
            },
            updateDates() {
                const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                const firstDay = new Date(this.year, this.month, 1).getDay();
                const adjustedFirstDay = (firstDay === 0) ? 6 : firstDay - 1;

                this.blankdays = Array.from({ length: adjustedFirstDay }, (_, i) => i);
                this.noOfDays = Array.from({ length: daysInMonth }, (_, i) => i + 1);

                const prevMonthDaysCount = adjustedFirstDay;
                const prevMonthLastDate = new Date(this.year, this.month, 0).getDate();
                this.prevMonthDays = Array.from({ length: prevMonthDaysCount }, (_, i) => prevMonthLastDate - prevMonthDaysCount + 1 + i);

                const totalCells = this.blankdays.length + this.noOfDays.length;
                const nextMonthDaysCount = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
                this.nextMonthDays = Array.from({ length: nextMonthDaysCount }, (_, i) => i + 1);
            },
            updateDateValue(date) {
                const selected = new Date(this.year, this.month, date);
                const yyyy = selected.getFullYear();
                const mm = String(selected.getMonth() + 1).padStart(2, '0');
                const dd = String(selected.getDate()).padStart(2, '0');

                this.selectedDate = `${yyyy}-${mm}-${dd}`;
                this.datepickerValue = this.selectedDate;

                @this.set('selectedDate', this.selectedDate);
            },
            prevMonth() {
                this.month--;
                if (this.month < 0) {
                    this.month = 11;
                    this.year--;
                }

                this.updateDateValue(new Date(this.selectedDate).getDate());
                this.updateDates();
            },
            nextMonth() {
                this.month++;
                if (this.month > 11) {
                    this.month = 0;
                    this.year++;
                }

                this.updateDateValue(new Date(this.selectedDate).getDate());
                this.updateDates();
            },
            selectPrevMonthDate(day) {
                this.prevMonth();
                this.updateDateValue(day);
            },
            selectNextMonthDate(day) {
                this.nextMonth();
                this.updateDateValue(day);
            },
            isSelectedDate(date) {
                const selected = new Date(this.selectedDate);
                selected.setHours(0, 0, 0, 0);

                const current = new Date(this.year, this.month, date);
                current.setHours(0, 0, 0, 0);

                return current.getTime() === selected.getTime();
            },
        };
    }
</script>
