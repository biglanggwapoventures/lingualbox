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

    $('#third-registration').submit(function(e) {

        e.preventDefault();

        var $this = $(this),
            formData = new FormData($this[0]);

        $.ajax({
            url: $this.attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function(response) {
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
            }
        });

    });

    $('form.common').submit(function(e) {

        e.preventDefault();
        var $this = $(this);

        $this.find('[type=submit]').addClass('disabled');

        $this.find('.has-error').removeClass('has-error').find('.help-block').remove();

        $.post($this.attr('action'), $this.serialize())
            .done(function(response) {
                if (response.result) {
                    if (response.hasOwnProperty('next_url')) {
                        window.location.href = response.next_url;
                        return;
                    }
                    var nextPage = $this.data('next');
                    if (nextPage) {
                        window.location.href = nextPage;
                    } else {
                        toastr.success('Done!')
                    }

                } else {
                    var input = '';
                    for (var x in response.errors) {
                        if (x.indexOf('.') !== -1) {
                            var pieces = x.split('.');
                            if (pieces.length === 2) {
                                input = $this.find('[name="' + pieces[0] + '[]"]:eq(' + pieces[1] + ')');
                            } else {
                                input = $('[name="' + pieces[0] + '[' + pieces[1] + ']' + pieces[2] + '"')
                            }

                        } else {
                            input = $this.find('[name=' + x + ']');
                        }
                        var formGroup = input.closest('.form-group');
                        if (formGroup) {
                            formGroup.addClass('has-error');
                        }
                        input.after($('<span />', {
                            'class': 'help-block',
                            text: response.errors[x][0]
                        }));
                    }
                }
            })
            .always(function() {
                $this.find('[type=submit]').removeClass('disabled');
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
        });
        clone.find('input:not(.constant)').val('');
        clone.find('input.optional').remove();


        clone.appendTo(table.find('tbody'));
        table.data('idx', ctr);
    })

    $('table').on('click', '.remove-line', function() {
        var entries = $(this).closest('table').find('tbody tr');
        if (entries.length > 1) {
            $(this).closest('tr').remove();
        } else {
            $(this).closest('tr').find('input:not(.constant)').val('');
            $(this).closest('tr').find('input.optional').remove();
        }
    });

    $('.mod-question').click(function(e) {
        e.preventDefault();
        var mode = $(this).data('mode');
        var clone = $($('.form-group.' + mode).clone()[0]);
        clone.find('label').text('')
        clone.find('input').val('')
        clone.find('.remove').removeClass('invisible');
        clone.find('.help-block').remove();
        clone.removeClass('has-error');
        $(this).closest('.form-group').before(clone);
    })

    $('.common').on('click', '.remove', function(e) {
        e.preventDefault();
        $(this).closest('.form-group').remove();
    })

})