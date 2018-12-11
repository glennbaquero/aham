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

mix.js([
	'resources/backend/js/app.js',
], 'public/assets/js/app.js')
	.js(['resources/frontend/js/app.js'], 'public/assets/frontend/js/app.js')
	.extract(['vue', 'vuex', 'axios', 'datatables.net-bs', '@fortawesome/fontawesome-free'])
    .version();

mix.sass('resources/backend/sass/app.scss', 'public/assets/css/app.css').version();
mix.sass('resources/backend/sass/vendor.scss', 'public/assets/css/vendor.css').version();
mix.sass('resources/frontend/sass/app.scss', 'public/assets/frontend/css/app.css').version();