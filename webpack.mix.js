const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.styles([
    'resources/plantilla/css/font-awesome.min.css',
    'resources/plantilla/css/simple-line-icons.min.css',
    'resources/plantilla/css/style.css'
], 'public/css1/plantilla.css')

.scripts([
    'resources/plantilla/js/jquery.min.js',
    'resources/plantilla/js/popper.min.js',
    'resources/plantilla/js/bootstrap.min.js',
    'resources/plantilla/js/chart.min.js',      
    'resources/plantilla/js/pace.min.js',      
    'resources/plantilla/js/template.js'
], 'public/js1/plantilla.js')

.js(['resources/js/app.js'], 'public/js1/app.js');