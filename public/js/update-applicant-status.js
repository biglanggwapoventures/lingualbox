$(document).ready(function() {
    $('select[data-update]').change(function() {

        var phase = $(this).data('update'),
            status = $(this).val();

        $.ajax({
            url: $(this).closest('tr').data('update-url'),
            method: 'PATCH',
            data: {
                phase: phase,
                status: status
            },
            success: function(response) {
                if (response.result) {
                    window.location.reload();
                }
            },
            error: function() {
                alert('An internal server error has occured!');
            }
        })

    })
});