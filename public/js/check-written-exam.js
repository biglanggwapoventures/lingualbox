$(document).ready(function() {
    $('.check').click(function(e) {

        if (!confirm('Are you sure?')) return;

        var $this = $(this);

        $this.addClass('disabled');

        var form = $('#check-exam'),
            data = form.serializeArray(),
            mark = $this.data('value');

        data.push({
            name: 'mark',
            value: mark
        });

        if (mark === 'PASSED') {
            data.push({
                name: 'content',
                value: $('[name=content]').val()
            });
        }

        $.post(form.attr('action'), $.param(data))
            .done(function(response) {
                if (response.result) {
                    window.location.href = response.redirect_url;
                }
            })
            .fail(function() {
                alert('An internal server error has occured. Please try again.');
            })
            .always(function() {
                $this.removeClass('disabled');
            })
    });
});