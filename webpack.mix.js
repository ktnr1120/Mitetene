const mix = require('laravel-mix');

mix.react('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       //
   ]);

// webpack.mix.js
mix.postCss('resources/css/tailwind.css', 'public/css', [
    require('tailwindcss'),
]);

