const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/scss/dsv.scss','public/css')
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'resources/css/su.css',
        'resources/css/app.css',
        'node_modules/select2/dist/css/select2.min.css',
        'node_modules/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css',
        'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        'node_modules/@fortawesome/fontawesome-free/css/all.css',
        'node_modules/daterangepicker/daterangepicker.css'
    ], 'public/css/all.css')
    .combine(['public/css/dsv.css', 'public/css/all.css'], 'public/css/dsvworkflow.css')

mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts/*', 'public/webfonts/');
mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    'resources/js/su.js',
    'node_modules/corejs-typeahead/dist/typeahead.bundle.js',
    'node_modules/select2/dist/js/select2.full.js',
    'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'node_modules/daterangepicker/daterangepicker.js'
], 'public/js/dsvworkflow.js');
