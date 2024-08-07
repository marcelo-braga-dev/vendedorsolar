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

mix.js('resources/js/app.js', 'public_html/js')
    .vue()
    .sass('resources/sass/app.scss', 'public_html/css')
    .copy('node_modules/bootstrap-icons/font/fonts', 'public/fonts')
    .copy('node_modules/bootstrap-icons/font/bootstrap-icons.css', 'public/css');
