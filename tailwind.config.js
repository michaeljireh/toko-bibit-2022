const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require('tailwindcss/plugin')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            boxShadow: {
                innerBottom: 'inset 200px 0 200px 0 rgba(0, 0, 0, 1)'
            }
        },
    },

    variants: {
        extend: {
            // opacity: ['disabled'],
            width: ["responsive", "hover", "focus"]
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        plugin(function ({ addUtilities }) {
            addUtilities({
                '.text-shadow': {
                    'text-shadow': '0 2px 5px rgba(0, 0, 0, 0.5)'
                }
            }, ['responsive', 'hover'])
        })
    ],

    darkMode: 'class',
};
