import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: 'deckfoundry.com',
        port: 5173,
        hmr: {
            host: 'deckfoundry.com',
        },
        headers: {
        	'Access-Control-Allow-Origin': 'http://deckfoundry.com:8000',
            'access-control-allow-methods': 'GET',
        },
    },
});
