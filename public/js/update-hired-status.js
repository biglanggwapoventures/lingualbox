$(document).ready(function () {

    var url = $('table#hired').data('url');
    $('.shift').editable({
        name: 'shift',
        url: url,
        pk: function () {
            return $(this).closest('tr').data('pk')
        },
        source: [{
            value: 'MORNING',
            text: 'Morning Shift'
        }, {
            value: 'AFTERNOON',
            text: 'Afternoon Shift'
        }, {
            value: 'EVENING',
            text: 'Evening Shift'
        }, {
            value: 'MIDNIGHT',
            text: 'Midnight Shift'
        }],
        type: 'select'
    });

    $('.workdays').editable({
        name: 'work_days',
        url: url,
        pk: function () {
            return $(this).closest('tr').data('pk')
        },
        source: [{
            value: 'MON',
            text: 'Monday'
        }, {
            value: 'TUE',
            text: 'Tuesday'
        }, {
            value: 'WED',
            text: 'Wednesday'
        }, {
            value: 'THU',
            text: 'Thursday'
        }, {
            value: 'FRI',
            text: 'Friday'
        }, {
            value: 'SAT',
            text: 'Saturday'
        }, {
            value: 'SUN',
            text: 'Sunday'
        }],
        type: 'checklist'
    });

    $('.status').editable({
        name: 'status',
        url: url,
        pk: function () {
            return $(this).closest('tr').data('pk')
        },
        type: 'select',
        source: [{
            value: 'ACTIVE',
            text: 'Active'
        }, {
            value: 'FIRED',
            text: 'Fired'
        }, {
            value: 'RESIGNED',
            text: 'Resigned'
        }]
    });

    $('.rate').editable({
        name: 'rate',
        url: url,
        pk: function () {
            return $(this).closest('tr').data('pk')
        },
        type: 'text'
    });

    $('.time').editable({
        name: 'time_schedule',
        url: url,
        pk: function () {
            return $(this).closest('tr').data('pk')
        },
        type: 'text'
    });


})