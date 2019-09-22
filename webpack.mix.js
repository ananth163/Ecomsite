const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js/all.js')
   .sass('resources/assets/sass/app.scss', 'public/css/all.css')
   .setPublicPath('public');