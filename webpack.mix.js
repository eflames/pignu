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
    'resources/css/pignu/bootstrap.min.css',
    'resources/css/pignu/main.css',
    'resources/css/pignu/color_library.css',
    'resources/css/pignu/custom-typography.css',
    'resources/css/pignu/perfect-scrollbar.css',
    'resources/css/pignu/structure.css',
    'resources/css/pignu/custom.css',
    'resources/css/pignu/fa.min.css',
    'resources/css/pignu/alert.css',
    'resources/css/pignu/table-basic.css',
    'resources/css/pignu/sweetalert2.min.css',
    'resources/css/pignu/tooltip.css',
    'resources/css/pignu/theme-checkbox-radio.css',
    'resources/css/pignu/custom-modal.css',
    'resources/css/pignu/custom-tabs.css',
    'resources/css/pignu/ldbtn.min.css',
    'resources/css/pignu/custom-loader.css'
],'public/css/pignu/pignu-styles.min.css');

mix.scripts([
    'resources/js/pignu/jquery-3.1.1.min.js',
    'resources/js/pignu/jquery.blockUI.min.js',
    'resources/js/pignu/popper.min.js',
    'resources/js/pignu/bootstrap.min.js',
    'resources/js/pignu/perfect-scrollbar.min.js',
    'resources/js/pignu/app.js',
    'resources/js/pignu/sweetalert2.all.min.js',
    'resources/js/pignu/custom.js'
],'public/js/pignu/pignu-scripts.min.js');

mix.styles([
    'resources/css/pignu/bootstrap.min.css',
    'resources/css/pignu/fa.min.css',
    'resources/css/pignu/plugins.css',
    'resources/css/pignu/form-1.css',
    'resources/css/pignu/theme-checkbox-radio.css',
    'resources/css/pignu/ldbtn.min.css',
    'resources/css/pignu/switches.css',
],'public/css/pignu/pignu-login-styles.min.css');

mix.scripts([
    'resources/js/pignu/jquery-3.1.1.min.js',
    'resources/js/pignu/popper.min.js',
    'resources/js/pignu/bootstrap.min.js',
    'resources/js/pignu/form-1.js'
],'public/js/pignu/pignu-login-scripts.min.js');