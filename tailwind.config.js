import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#ea580c',
                    50: '#fff7ed',
                    100: '#ffedd5',
                    200: '#fed7aa',
                    300: '#fdba74',
                    400: '#fb923c',
                    500: '#f97316',
                    600: '#ea580c',
                    700: '#c2410c',
                    800: '#9a3412',
                    900: '#7c2d12',
                    950: '#431407'
                },
                dark: {
                    surface: '#1e293b',
                    card: '#0f172a',
                    background: '#020617'
                },
                border: {
                    light: '#cbd5e1',
                    'light-strong': '#94a3b8',
                    'light-subtle': '#e2e8f0',
                    dark: '#334155',
                    'dark-strong': '#475569',
                    'dark-subtle': '#1e293b'
                }
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'float': '0 8px 32px rgba(0, 0, 0, 0.08)',
                'float-lg': '0 16px 48px rgba(0, 0, 0, 0.1)'
            },
            backgroundImage: {
                'mesh-light': 'radial-gradient(at 40% 20%, hsla(28, 100%, 94%, 0.8) 0px, transparent 50%), radial-gradient(at 80% 0%, hsla(38, 100%, 90%, 0.6) 0px, transparent 40%), radial-gradient(at 0% 50%, hsla(355, 100%, 97%, 0.5) 0px, transparent 50%), linear-gradient(180deg, #fafafa 0%, #f5f5f5 100%)',
                'mesh': 'radial-gradient(at 40% 20%, hsla(220, 50%, 15%, 1) 0px, transparent 50%), radial-gradient(at 80% 0%, hsla(220, 40%, 10%, 1) 0px, transparent 40%), linear-gradient(180deg, #0f172a 0%, #020617 100%)'
            },
            borderRadius: {
                '4xl': '2rem'
            }
        },
    },
    plugins: [],
};
