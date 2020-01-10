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

mix.styles(['resources/assests/plantillas/css/marialize.css',
'resources/assests/plantillas/css/marialize.min.css'],'public/css/plantilla.css')
.scripts(['resources/assests/plantillas/js/marialize.js',
'resources/assests/plantillas/css/marialize.min.js'],'public/js/plantilla.js')
