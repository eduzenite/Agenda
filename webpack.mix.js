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

mix
    .js('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/vendor/bootstrap')
    .postCss('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/vendor/bootstrap')

    .js('node_modules/jquery/dist/jquery.min.js', 'public/vendor/jquery')

    .postCss('node_modules/@fortawesome/fontawesome-free/css/all.css', 'public/vendor/fontawesome')

    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
