var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix
        .sass('app.scss')
        .styles([
            'bootstrap-fileinput/css/fileinput.css'
        ], 'public/css/fileinput.css', 'bower_components')
        .scripts([
            'jquery/dist/jquery.min.js',
            'bootstrap/dist/js/bootstrap.min.js'
        ], 'public/js/app.js', 'node_modules')
        .scripts([
            'bootstrap-fileinput/js/fileinput.js',
        ], 'public/js/fileinput.js', 'bower_components')
        .scripts('common.js')
        .copy('bower_components/bootstrap-fileinput/img', 'public/img')

    .copy('node_modules/font-awesome/fonts', 'public/fonts')
        .copy('node_modules/font-awesome/css', 'public/css')
        .copy('node_modules/toastr/package/build/toastr.min.css', 'public/css')
        .copy('node_modules/toastr/package/build/toastr.min.js', 'public/js')
        .copy('node_modules/toastr/package/build/toastr.js.map', 'public/js')
        .copy('node_modules/jquery-countdown/dist/jquery.countdown.min.js', 'public/js/timer.js')
        .copy('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/js/bstimepicker.min.js')
        .copy('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/css/bstimepicker.min.css')
        .copy('node_modules/eonasdan-bootstrap-datetimepicker/node_modules/moment/moment.js', 'public/js/moment.js')
        .copy('bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css', 'public/css/x-editable.css')
        .copy('bower_components/x-editable/dist/bootstrap3-editable/img/*.*', 'public/img')
        .copy('bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js', 'public/js/x-editable.min.js')
        .copy('bower_components/chart.js/dist/Chart.min.js', 'public/js/chart.min.js')
});