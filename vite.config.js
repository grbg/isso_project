import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/pages/auth.css', 
                'resources/js/app.js', 
                'resources/js/home_load_anim.js', 
                'resources/js/header_menu.js', 
                'resources/js/nav_load_anim.js', 

                'resources/js/project_page.js',
                'resources/js/project/swiper.js',
                'resources/js/project/ymap.js',
                'resources/js/project/plan_section.js',
                'resources/js/project/add_to_favorite.js',
                'resources/js/project/apartments_filter.js',
                'resources/js/project/apartment_review.js',
                'resources/js/project/fullscreen_apartment.js',

                'resources/js/all_projects/drop_down_city.js',
                'resources/js/all_projects/apartment_review.js',
                'resources/js/all_projects/project_filtration.js',

                'resources/js/auth/validation.js',
                'resources/js/auth/toggle_btn.js',

                'resources/js/account/add_compare.js',
                'resources/js/account/remove_compare.js',
                 
                'resources/js/project/ymap.js',
                'resources/js/filters.js',

                'resources/css/pages/home.css',
                'resources/css/pages/account.css',
                'resources/css/pages/project.css',
                'resources/css/pages/project_list.css',
                'resources/css/pages/compare.css',
                'resources/css/fonts.css',
                'resources/css/colors.css',
                'resources/css/components/cards.css',
                'resources/css/components/popup.css',
                'resources/css/header.css',
                'resources/css/dark_header.css',
                'resources/css/footer.css',
                'resources/css/buttons.css'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    optimizeDeps: {
        exclude: ['lightningcss'],  // Исключаем lightningcss из предзагрузки зависимостей
    },
    ssr: {
        noExternal: ['lightningcss'], // Для SSR - не бандлить lightningcss
    },
});
