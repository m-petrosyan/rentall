module.exports = {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        "./node_modules/flowbite/**/*.js"

    ],
    theme: {
        extend: {
            height: {
                // 100: '580px',
            },
            minHeight: {
                96: '384px',
            },
            spacing: {},
            colors: {
                primary: {
                    "50": "#eff6ff",
                    "100": "#dbeafe",
                    "200": "#bfdbfe",
                    "300": "#93c5fd",
                    "400": "#60a5fa",
                    "500": "#3b82f6",
                    "600": "#2563eb",
                    "700": "#1d4ed8",
                    "800": "#1e40af",
                    "900": "#1e3a8a",
                    "950": "#172554"
                }
            }
        },
        fontSize: {},
        colors: {
            'white': '#fff',
            'orange-dark': '#ff5722',
            'dark': '#111828',
            'dark-grey': '#202938',
            'dark-input': '#384152',
            'blue': '#2196f3',
            'grey-blue': '#607d8b',
            'grey': '#dcdcdc',
            // 'dark': 'rgba(0, 0, 0, 0.11)',
            // 'dark-grey': 'rgba(61, 61, 61, 0.11)',
        },
        screens: {
            's': '0px',
            'sm': '580px',
            'md': '860px',
            'lg': '1200px',
            // => @media (min-width: 1280px) { ... }
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
