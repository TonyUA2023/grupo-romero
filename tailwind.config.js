const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Sen', ...defaultTheme.fontFamily.sans], // Updated to use Sen as the primary sans-serif font
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};