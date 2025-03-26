export default class Calendar {
    static MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    static DAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    constructor(selectedDate, {onDateChange = () => {}}) {
        this.datepickerValue = '';
        this.selectedDate = selectedDate;
        this.month = '';
        this.year = '';
        this.noOfDays = [];
        this.blankdays = [];
        this.prevMonthDays = [];
        this.nextMonthDays = [];
        this.onDateChange = onDateChange;
    };

    init() {
        const today = new Date();
        this.month = today.getMonth();
        this.year = today.getFullYear();
        this.datepickerValue = today.toISOString().split('T')[0];

        this.updateDates();
    };

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
    };

    updateDateValue(date) {
        this.selectedDate = this.dayToDate(date);
        this.datepickerValue = this.selectedDate;
        this.onDateChange(this.selectedDate);
    };

    prevMonth() {
        this.month--;
        if (this.month < 0) {
            this.month = 11;
            this.year--;
        }

        this.updateDateValue(new Date(this.selectedDate).getDate());
        this.updateDates();
    };

    nextMonth() {
        this.month++;
        if (this.month > 11) {
            this.month = 0;
            this.year++;
        }

        this.updateDateValue(new Date(this.selectedDate).getDate());
        this.updateDates();
    };

    selectPrevMonthDate(day) {
        this.prevMonth();
        this.updateDateValue(day);
    };

    selectNextMonthDate(day) {
        this.nextMonth();
        this.updateDateValue(day);
    };

    dayToDate(date) {
        const selected = new Date(this.year, this.month, date);
        const yyyy = selected.getFullYear();
        const mm = String(selected.getMonth() + 1).padStart(2, '0');
        const dd = String(selected.getDate()).padStart(2, '0');

        return `${yyyy}-${mm}-${dd}`;
    };

    isSelectedDate(date) {
        const selected = new Date(this.selectedDate);
        selected.setHours(0, 0, 0, 0);

        const current = new Date(this.year, this.month, date);
        current.setHours(0, 0, 0, 0);

        return current.getTime() === selected.getTime();
    };

    isHoliday(date, holidays = []) {
        return holidays.some(holiday => (
            new Date(holiday.date).toISOString().split('T')[0] === this.dayToDate(date)
        ));
    };
};
