import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'node_modules/bootstrap/dist/css/bootstrap.min.css',
                'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
                'node_modules/owl.carousel/dist/assets/owl.theme.default.min.css',
                'node_modules/jquery.fancybox/source/jquery.fancybox.css',
                'resources/fonts/flaticon_mycollection.css',
                'resources/css/fontawesome.min.css',
                'resources/css/landing.css',
                'resources/css/landing-responsive.css',
                'resources/css/style.css',
                'resources/css/responsive.css',

                'resources/js/custom.js',
                'resources/js/contact.js'
            ],
            refresh: true,
        }),
    ],
});
