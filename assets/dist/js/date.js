/**
 * Created by Allan Wiz on 10/22/15.
 */
$(document).ready(function () {
    $("#startDate").datepicker({
        format: "mm/dd/yyyy",
        autoClose: true,
        yearRange: "c-100:c+0",
        daysOfWeekDisabled: [0,6]
    });
    $("#endDate").datepicker({
        format: "mm/dd/yyyy",
        autoClose: true,
        yearRange: "c-100:c+0",
        daysOfWeekDisabled: [0,6]
    });
    $("#dob").datepicker({
        format: "mm/dd/yyyy",
        endDate: '+0d',
        calendarWeeks: true,
        autoClose: true,
        toggleActive: true,
        ChangeYear: true,
        yearRange: "c-100:c+0"
    });
    $("#d_employed").datepicker({
        format: "mm/dd/yyyy",
        endDate: '+0d',
        calendarWeeks: true,
        autoClose: true,
        toggleActive: true,
        ChangeYear: true,
        yearRange: "c-100:c+0",
        daysOfWeekDisabled: [0,6]
    });
});