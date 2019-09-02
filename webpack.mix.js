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
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.styles([
    'resources/assets/sass/libs/styles.css',
    'resources/assets/sass/libs/blog-post.css',
    'resources/assets/sass/libs/bootstrap.css',
    'resources/assets/sass/libs/font-awesome.css',
    'resources/assets/sass/libs/sb-admin-2.css',
    'resources/assets/sass/libs/metisMenu.css'

],'public/css/app.css');
mix.scripts([
    'resources/assets/js/libs/jquery.js',
    'resources/assets/js/libs/metisMenu.js',
    'resources/assets/js/libs/sb-admin-2.js',
    'resources/assets/js/libs/scripts.js',
    'resources/assets/js/libs/bootstrap.js'

],'public/js/app.js');