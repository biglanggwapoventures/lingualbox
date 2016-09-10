$(document).ready(function() {

    var timer = $('#countdown');

    $('[data-toggle=item]').click(function(e) {
        e.preventDefault();
        var $this = $(this),
            itemId = $this.data('target');

        $('[item]').addClass('hidden');
        $('[item][data-item=' + itemId + ']').removeClass('hidden');

        if (!$this.parent().hasClass('active')) {
            $this.parent().addClass('active');
        }

        var form = $('#save');
        $.post(form.attr('action'), form.serialize());

    })

    var target = new Date();
    target.setSeconds(target.getSeconds() + timer.data('limit'));
    timer
        .countdown(target, function(event) {
            $(this).text(
                event.strftime('%H:%M:%S')
            );
        })
        .on('finish.countdown', function() {
            $(this).text('TIME IS UP!');
            $('form').submit();
        });

    $('#save').submit(function(e) {
        e.preventDefault();

        var $this = $(this);

        $this.append($('<input />', {
            type: 'hidden',
            name: 'finish',
            value: 1
        }));

        $.post($this.attr('action'), $this.serialize())
            .done(function(response) {
                if (response.result) {
                    if (response.hasOwnProperty('next_url')) {
                        window.location.href = response.next_url;

                    }
                }
            })
    })
})