$(document).ready(function() {

    var timer = $('#timer');

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
})