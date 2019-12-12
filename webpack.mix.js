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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/sponsorship.js', 'public/js')
    .js('resources/js/countdownInstance.js', 'public/js')
    .js('resources/js/simpleCountdountInstance.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/app.profile.scss','public/css')
   .sass('resources/sass/app.style.verification.scss','public/css')
   .sass('resources/sass/app.showprofile.scss','public/css')
   .sass('resources/sass/app.succes.register.scss','public/css')
   .sass('resources/sass/app.404error.scss','public/css')
   .sass('resources/sass/app.countdown.process.scss','public/css')
   .sass('resources/sass/app.sponsorship.scss','public/css')
   .less('resources/less/main.less','public/css');
