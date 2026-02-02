import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
  server: {
    host: 'localhost',
    cors: true,
    watch: {
      usePolling: true,
    },
  },
  plugins: [
    laravel({
      input: 'resources/js/app.jsx',
      refresh: [
        'resources/routes/**',
        'routes/**',
        'app/Routes/**',
        'resources/views/**',
        'resources/js/**',
      ],
    }),
    react(),
  ],
});
