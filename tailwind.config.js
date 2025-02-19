import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                "castom_white": "#f5f5f5",
                "castom_blue": "#1357D2",
                "black": "#060606"
            },
            
            fontFamily: {
                "montserrat": ["Montserrat", "sans-serif"]
            },
        },
    },
    plugins: [],
};
