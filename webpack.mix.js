const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js/all.js')
   .js('resources/assets/js/404.js', 'public/js/404.js')
   .sass('resources/assets/sass/404.scss', 'public/css/404.css')
   .sass('resources/assets/sass/app.scss', 'public/css/all.css')
   .sass('resources/assets/sass/generic.sass', 'public/css/generic.css')
   .setPublicPath('public');