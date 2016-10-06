$(document).ready(function () {
    var modal = $('#manage');
    modal.on('show.bs.modal', function (e) {
        var src = $(e.relatedTarget),
            $this = $(this);
        if (src.data('mode') === 'create') {
            $this.find('input:not([type=hidden])').val('');
            $this.find('#form').attr('action', src.data('store-url')).find('[name=_method]').val('POST');
            $this.find('.modal-title').text('Request new teachers');


        } else {

            var row = src.closest('tr'),
                url = row.data('update-url'),
                info = {
                    id: src.text(),
                    morning: row.find('[data-morning]').data('morning'),
                    afternoon: row.find('[data-afternoon]').data('afternoon'),
                    evening: row.find('[data-evening]').data('evening'),
                    midnight: row.find('[data-midnight]').data('midnight')
                };

            $this.find('#form').attr('action', url).find('[name=_method]').val('PATCH');
            $this.find('.modal-title').text('Update request id # ' + info.id);

            for (var field in info) {
                console.log(info[field])
                $this.find('input[name=' + field + ']').val(info[field]);
            }
        }

    })

    $('#confirm-remove').on('show.bs.modal', function (e) {
        var src = $(e.relatedTarget),
            $this = $(this);

        $this.find('#xform').attr('action', src.closest('tr').data('delete-url'));
    })


    $('.view-logs').click(function (e) {
        e.preventDefault();
        var data = $(this).closest('tr').data('fulfillments');
        var rows = [];
        $(data).each(function (i, v) {
            rows.push('<tr><td>' + v.date_fulfilled + '</td><td>' + (v.fulfilled_by.firstname + ' ' + v.fulfilled_by.lastname) + '</td><td>' + v.morning + '</td><td>' + v.afternoon + '</td><td>' + v.evening + '</td><td>' + v.midnight + '</td></tr>');
        })
        $('#logs').find('table tbody').html(rows.join(''));
        $('#logs').modal('show')
    });
});