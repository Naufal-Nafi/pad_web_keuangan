import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/css/app.css"],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        emptyOutDir: true,
        outDir: "public/build", // Specify the output directory for built files
    },
    publicDir: false, // penting agar tidak bentrok dengan public Laravel
});
