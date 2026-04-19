import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0', // allows access from other devices
        cors: true,
        hmr: {
            host: 'vite.insights.dev.local.test', // your laptop's IP145
            clientPort: 80
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
