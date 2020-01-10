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

mix.styles(['resources/assets/plantillas/css/marialize.css',
'resources/assets/plantillas/css/marialize.min.css'],'public/css/plantilla.css')
.scripts(['resources/assets/plantillas/js/marialize.js',
'resources/assets/plantillas/css/marialize.min.js'],'public/js/plantilla.js')
