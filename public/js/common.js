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

    $('.new-line').click(function() {
        var toClone = $(this).data('target');
        var row = $(toClone + ':first-of-type').clone();
        row.find('.newline')
            // row.prepend($('<hr />'));
        row.find('input,select').val();
        $(this).before(row);
    })
})