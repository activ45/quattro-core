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
const mix = require('laravel-mix');
const path = require("path");
mix.disableSuccessNotifications();

mix.alias({
    '@': path.join(__dirname, 'resources/js')
});

// console.log(process.env); // a large object without my var
mix.js('resources/js/app.js', '/js')
    .sass('resources/scss/app.scss','/css')
    .vue();

if (mix.inProduction()) {
    mix.version();
}
