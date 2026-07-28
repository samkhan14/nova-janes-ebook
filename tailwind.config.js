import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/layouts/app.blade.php',
        './resources/views/layouts/guest.blade.php',
        './resources/views/layouts/admin.blade.php',
        './resources/views/layouts/navigation.blade.php',
        './resources/views/components/*.blade.php',
        './resources/views/auth/**/*.blade.php',
        './resources/views/profile/**/*.blade.php',
        './resources/views/admin/**/*.blade.php',
        './resources/views/dashboard.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
