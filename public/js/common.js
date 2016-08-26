$(document).ready(function() {

    $('#first-registration').submit(function(e) {

        e.preventDefault();
        var $this = $(this);

        $this.find('[name=birthdate]').val(function() {
            return $this.find('[name=birthyear]').val() + '-' + $this.find('[name=birthmonth]').val() + '-' + $this.find('[name=birthday]').val();
        })

        $this.find('.has-error').removeClass('has-error').find('.help-block').remove();

        $.post($this.attr('action'), $this.serialize())
            .done(function(response) {
                if (response.result) {
                    window.location.href = $this.data('next');
                } else {
                    for (var x in response.errors) {
                        var input = $this.find('[name=' + x + ']');
                        input.closest('.form-group').addClass('has-error');
                        input.after($('<span />', {
                            'class': 'help-block',
                            text: response.errors[x][0]
                        }));
                    }
                }
            })

    });

    $('form.common').submit(function(e) {

        e.preventDefault();
        var $this = $(this);

        $this.find('.has-error').removeClass('has-error').find('.help-block').remove();

        $.post($this.attr('action'), $this.serialize())
            .done(function(response) {
                if (response.result) {
                    window.location.href = $this.data('next');
                } else {
                    for (var x in response.errors) {
                        var input = $this.find('[name=' + x + ']');
                        input.closest('.form-group').addClass('has-error');
                        input.after($('<span />', {
                            'class': 'help-block',
                            text: response.errors[x][0]
                        }));
                    }
                }
            })

    });

    $('.new-line').click(function() {
        var table = $(this).closest('table'),
            rows = table.find('tbody tr'),
            clone = $(rows[0]).clone(),
            ctr = table.data('idx');

        ctr++;

        clone.find('input').attr('name', function() {
            return $(this).data('name').replace('idx', ctr);
        }).val('');


        clone.appendTo(table.find('tbody'));

        table.data('idx', ctr);
    })

    $('table').on('click', '.remove-line', function() {
        var entries = $(this).closest('table').find('tbody tr');
        if (entries.length > 1) {
            $(this).closest('tr').remove();
        }
    });
})