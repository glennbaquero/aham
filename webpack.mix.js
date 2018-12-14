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

mix.js(['resources/frontend/js/app.js'], 'public/assets/app-frontend.js').sourceMaps();

mix.js([
	'resources/backend/js/app.js',
], 'public/assets/app-backend.js')
	.extract(['vue', 'vuex', 'axios', 'datatables.net-bs', '@fortawesome/fontawesome-free'])
    .version()
    .sourceMaps();

mix.sass('resources/backend/sass/app.scss', 'public/assets/app-backend.css').version().sourceMaps();
mix.sass('resources/backend/sass/vendor.scss', 'public/assets/vendor-backend.css').version().sourceMaps();
mix.sass('resources/frontend/sass/app.scss', 'public/assets/app-frontend.css').version().sourceMaps();