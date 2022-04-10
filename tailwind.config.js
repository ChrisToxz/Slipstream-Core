module.exports = {
    mode: 'jit',
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        // "./resources/**/*.vue",
    ],
    // content: [
    //     "./resources/**/*.blade.php",
    //     "./resources/**/*.js",
    //     // "./resources/**/*.vue",
    // ],
    theme: {
        extend: {
            fontFamily: {
                'brand': ['Be Vietnam Pro'],
            },
            colors: {
                // Text Colors
                'primary': '#eeeeee',
                'secondary': '#c1c1c1',
                'disabled': '#3f3f3f',
                links: {
                    'default': '#eeeeee',
                    'hover': '#c1c1c1',
                    'active': '#959596',
                },
                background: {
                    'surface': '#101011',
                    'secondary': '#18191a',
                    'tertiary': '#1f2123',
                },
                brand: {
                    // Primary colors
                    "primary-300": "#99dbff",
                    "primary-400": "#4dbfff",
                    "primary-500": "#00a4ff",
                    "primary-600": "#0073b3",
                    "primary-700": "#004266",
                    // Secondary colors
                    "secondary-300": "#bdc8cd",
                    "secondary-400": "#8c9ea8",
                    "secondary-500": "#5b7583",
                    "secondary-600": "#40525c",
                    "secondary-700": "#242f34",
                },
                status: {
                    // info status colors
                    "info-300": "#a7b8d1",
                    "info-400": "#6482af",
                    "info-500": "#224d8d",
                    "info-600": "#183663",
                    "info-700": "#0e1f38",
                    // success status colors
                    "success-300": "#c1d6b1",
                    "success-400": "#90bf6b",
                    "success-500": "#5d9b2d",
                    "success-600": "#4a7c23",
                    "success-700": "#37591b",
                    // Warning status colors
                    "warning-300": "#ffc679",
                    "warning-400": "#ffb046",
                    "warning-500": "#fa8f00",
                    "warning-600": "#ce7600",
                    "warning-700": "#a15c00",
                    // error status colors
                    "error-300": "#e97a7a",
                    "error-400": "#da4d4d",
                    "error-500": "#bf2f2f",
                    "error-600": "#aa2020",
                    "error-700": "#8f1818",
                },

            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ]
};
