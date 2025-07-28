import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '/public/', // <-- ¡Añade esta línea!
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: 'localhost'
        },
    },
    build: { // <-- Asegúrate de que esta sección esté definida
        outDir: 'public/build', // <-- Esto es lo estándar y correcto para Laravel
    },
});
