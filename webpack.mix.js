const mix = require('laravel-mix');

// Compilar el archivo CSS
mix.css('resources/css/home.css', 'dist').setPublicPath('/css/home.css');
