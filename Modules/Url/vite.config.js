import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: '../../public/build-url',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-url',
            input: [
                __dirname + '/resources/assets/sass/app.scss',
                __dirname + '/resources/assets/js/app.js',
                __dirname + '/resources/assets/css/app.css'
            ],
            refresh: true,
        }),
    ],
});

export const paths = [
   'Modules/$STUDLY_NAME$/resources/assets/sass/app.scss',
    'Modules/$STUDLY_NAME$/resources/assets/js/app.js',
    'Modules/$STUDLY_NAME$/resources/assets/css/app.css',
];
