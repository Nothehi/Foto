const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    100: "#7c7d85",
                    200: "#34363d",
                    300: "#292d32",
                    400: "#202427",
                    500: "#1a1c20",
                    600: "#131517",
                    700: "#101213",
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
