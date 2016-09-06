$(document).ready(function() {

    var timer = $('#countdown');

    $('[data-toggle=item]').click(function() {
        var $this = $(this),
            itemId = $this.data('target');

        $('[item]').addClass('hidden');
        $('[item][data-item=' + itemId + ']').removeClass('hidden');

        if (!$this.parent().hasClass('active')) {
            $this.parent().addClass('active');
        }

    })

    var target = new Date();
    target.setMinutes(target.getMinutes() + timer.data('limit'));
    timer
        .countdown(target, function(event) {
            $(this).text(
                event.strftime('%H:%M:%S')
            );
        })
        .on('finish.countdown', function() {
            $('form').submit();
        });
})