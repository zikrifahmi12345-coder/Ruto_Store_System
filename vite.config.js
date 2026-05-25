import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/ruto-auth.css',
                'resources/css/ruto-admin.css',
                'resources/js/app.js',
                'resources/js/ruto-admin.js',
            ],
            refresh: true,
        }),
    ],
});
