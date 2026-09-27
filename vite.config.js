import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { google } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // Las fuentes se descargan al compilar y se sirven desde el propio sitio.
            fonts: [
                google('Manrope', {
                    weights: [500, 600, 700, 800],
                    subsets: ['latin'],
                    variable: '--fuente-display',
                    fallbacks: ['Arial', 'Helvetica', 'sans-serif'],
                }),
                google('Inter', {
                    weights: [400, 500, 600, 700],
                    subsets: ['latin'],
                    variable: '--fuente-body',
                    fallbacks: ['Arial', 'Helvetica', 'sans-serif'],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
