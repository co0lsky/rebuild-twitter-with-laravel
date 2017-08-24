let mix = require('laravel-mix');

// Extract the vendor, e.g. vue, from application's JS
// So that your user don't need to download the vendor libraries every time you updated application's JS
// Find more at https://laravel.com/docs/5.4/mix#vendor-extraction
mix.js('resources/assets/js/app.js', 'public/js')
   .extract(['vue']);

// Add your on page JS here
mix.js('resources/assets/js/pages/home.js', 'public/js/pages')
   .js('resources/assets/js/pages/layout_profile.js', 'public/js/pages');

// Your application's CSS
mix.sass('resources/assets/sass/app.scss', 'public/css');

mix.version();
