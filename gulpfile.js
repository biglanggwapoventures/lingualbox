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

elixir(function(mix) {
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
});