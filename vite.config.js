import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: true, // Enable source maps for easier debugging
        outDir: 'dist', // Specify the output directory for built files
    }
});
