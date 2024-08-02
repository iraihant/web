import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ['class', '[data-mode="dark"]'],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#3e60d5',
                'secondary': '#6c757d',
                'success': '#47ad77',
                'info': '#16a7e9',
                'warning': '#ffc35a',
                'danger': '#f15776',
                'light': '#f2f2f7',
                'dark': '#212529',
                'gray': {
                    ...colors.gray,
                    '800': '#313a46'
                },
                'body-bg': '#ffffff',
                'body-color': '#000000',
                'menu-bg': '#f8f9fa',
                'menu-item-color': '#333333',
                'menu-item-active-color': '#007bff',
                'menu-item-hover-color': '#0056b3',
                'topbar-bg': '#343a40',
                'topbar-item-color': '#ffffff',
                'topbar-item-active-color': '#007bff',
                'topbar-item-hover-color': '#0056b3',
                'body-bg-light': '#f2f2f7',
                'body-color-light': '#6c757d',
                'body-bg-dark': '#2d333c',
                'body-color-dark': '#aab8c5',
                'menu-bg-light': '#ffffff',
                'menu-item-color-light': '#6c757d',
                'menu-item-active-color-light': '#007bff',
                'menu-item-hover-color-light': '#007bff',
                'menu-bg-dark': '#212529',
                'menu-item-color-dark': '#adb5bd',
                'menu-item-active-color-dark': '#ffffff',
                'menu-item-hover-color-dark': '#ffffff',
                'menu-bg-brand': '#6379c3',
                'menu-item-color-brand': '#e9ecef',
                'menu-item-active-color-brand': '#ffffff',
                'menu-item-hover-color-brand': '#ffffff',
                'topbar-bg-light': '#ffffff',
                'topbar-item-color-light': '#6c757d',
                'topbar-item-active-color-light': '#007bff',
                'topbar-item-hover-color-light': '#007bff',
                'topbar-bg-dark': '#343a40',
                'topbar-item-color-dark': 'rgb(131, 145, 162)',
                'topbar-item-active-color-dark': 'rgb(188, 206, 228)',
                'topbar-item-hover-color-dark': 'rgb(188, 206, 228)',
                'topbar-bg-brand': 'linear-gradient(135deg, #6379c3 0%, #3e60d5 60%)',
                'topbar-item-color-brand': '#e9ecef',
                'topbar-item-active-color-brand': '#ffffff',
                'topbar-item-hover-color-brand': '#ffffff',
            },
            spacing: {
                'sidenav-width': '240px',
                'sidenav-width-md': '160px',
                'sidenav-width-sm': '70px',
                'sidenav-sm-height': '1500px',
                'topbar-height': '70px',
                'horizontal-menu-height': '55px',
                'menu-item-padding-x': '10px',
                'menu-item-gap': '5px',
                'menu-link-padding-y': '10px',
                'menu-link-padding-x': '10px',
                'menu-link-item-gap': '10px',
                'menu-item-icon-size': '20px',
                'menu-item-font-size': '16px',
            },
            fontSize: {
                'menu-item-font-size': '16px',
            },
        },
    },

    plugins: [forms],
};
