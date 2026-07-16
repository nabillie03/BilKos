/*
  GANTI ISI file tailwind.config.js kamu (di root project Laravel) dengan ini.
  Ini menambahkan warna & font kustom BilKos ke config bawaan Breeze.
*/

import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Public Sans', ...defaultTheme.fontFamily.sans],
                display: ['Fraunces', 'ui-serif', 'Georgia', 'serif'],
            },
            colors: {
                paper: '#F7F5EF',
                ink: '#22262B',
                'ink-soft': '#5B6470',
                navy: {
                    DEFAULT: '#1E3A5F',
                    dark: '#16293F',
                    light: '#2C5384',
                },
                gold: {
                    DEFAULT: '#C89B3C',
                    dark: '#A87F2B',
                    light: '#E7C978',
                },
                forest: {
                    DEFAULT: '#3F7D58',
                    light: '#E4F1E9',
                },
                clay: {
                    DEFAULT: '#B4453A',
                    light: '#F8E6E4',
                },
            },
            borderRadius: {
                xl: '0.875rem',
            },
        },
    },

    plugins: [forms],
};
