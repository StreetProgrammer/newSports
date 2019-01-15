let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/noti.js', 'public/js/noti.js')
    .js('resources/assets/js/clubRegister.js', 'public/club/js/clubRegister.js')
    .js('resources/assets/js/clubEdit.js', 'public/club/js/clubEdit.js')
   //.sass('resources/assets/sass/app.scss', 'public/css')
   //.styles('resources/assets/sass/tabs.css', 'public/css/taps.css');
