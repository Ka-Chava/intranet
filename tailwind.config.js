import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        container: {
            padding: {
                DEFAULT: '1rem',
                lg: '2.5rem',
            },
        },
        extend: {
            listStyleType: {
                roman: 'lower-roman',
                alpha: 'lower-alpha',
                circle: 'circle',
                square: 'square',
            },
            fontSize: {
                'page-header': ['24px', '32px'],
                'display-lg': ['60px', {
                    lineHeight: '72px',
                    fontWeight: '600',
                }],
                'headline-lg': ['32px', {
                    lineHeight: '40px',
                    fontWeight: '600',
                }],
                'headline-md': ['24px', {
                    lineHeight: '32px',
                    fontWeight: '600',
                }],
                'headline-sm': ['18px', {
                    lineHeight: '24px',
                    fontWeight: '600',
                }],
                'headline-xs': ['16px', {
                    lineHeight: '24px',
                    fontWeight: '600',
                }],
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'web-border': '#262626',
                'web-border-light': '#E5E5E5',
                constant: '#3C3C3C',

                /* Surface colors */
                canvas: 'var(--ui-color-canvas)',
                surface: 'var(--ui-color-surface)',
                footer: 'var(--ui-color-footer)',
                scrim: 'var(--ui-color-scrim)',

                /* Foreground colors */
                'on-surface': 'var(--ui-color-on-surface)',
                'on-surface-default': 'var(--ui-color-on-surface-default)',
                'on-surface-emphasis': 'var(--ui-color-on-surface-emphasis)',
                'on-surface-de-emphasis': 'var(--ui-color-on-surface-de-emphasis)',
                'on-surface-scrim': 'var(--ui-color-on-scrim)',
                disclosure: 'var(--ui-color-disclosure)',
                link: 'var(--ui-color-link)',
                negative: 'var(--ui-color-negative)',
                neutral: 'var(--ui-color-neutral)',
                success: 'var(--ui-color-success)',

                /* Borders colors */
                outline: 'var(--ui-color-outline-default)',
                'outline-selected': 'var(--ui-color-outline-selected)',
                'outline-alternative': 'var(--ui-color-outline-alternative)',

                /* Additional colors */
                divider: 'var(--ui-color-divider)',

                /* Buttons */
                'btn-outline': 'var(--ui-button-outline)',
                'btn-border': 'var(--ui-button-border)',

                'btn-primary': 'var(--ui-button-primary-color)',
                'btn-primary-hover': 'var(--ui-button-primary-hover)',
                'btn-primary-active': 'var(--ui-button-primary-active)',
                'btn-primary-text': 'var(--ui-button-primary-text-color)',

                'btn-secondary': 'var(--ui-button-secondary-color)',
                'btn-secondary-hover': 'var(--ui-button-secondary-hover)',
                'btn-secondary-active': 'var(--ui-button-secondary-active)',
                'btn-secondary-text': 'var(--ui-button-secondary-text-color)',

                'btn-tertiary': 'var(--ui-button-tertiary-color)',
                'btn-tertiary-hover': 'var(--ui-button-tertiary-hover)',
                'btn-tertiary-active': 'var(--ui-button-tertiary-active)',
                'btn-tertiary-text': 'var(--ui-button-tertiary-text-color)',

                'btn-special-active': 'var(--ui-button-special-active)',
                'btn-special-text': 'var(--ui-button-special-text-color)',

                'link-hover': 'var(--ui-link-hover-color)',
                'link-active': 'var(--ui-link-active-color)',
                'link-active-text': 'var(--ui-link-active-text-color)',

                'notification': 'var(--ui-notification-background)',
                'notification-foreground': 'var(--ui-notification-foreground)',
                'notification-foreground-alt': 'var(--ui-notification-foreground-alternative)',

                'off-canvas': 'var(--ui-off-canvas-color)',
                'off-canvas-text': 'var(--ui-off-canvas-text-color)',
            },
            backgroundImage: {
                before: 'linear-gradient(96deg, #FBD7FF 0%, #FFDEC1 100%)',
                after: 'linear-gradient(96deg, #845BDC -30%, #FFDEC1 100%)',
            },
            transitionDuration: {
                primary: 'var(--ui-primary-transition-duration)',
            },
            transitionTimingFunction: {
                primary: 'var(--ui-primary-transition-function)',
            },
        },
    },

    plugins: [forms],
};
