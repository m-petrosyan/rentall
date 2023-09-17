module.exports = {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            spacing: {},
        },
        fontSize: {},
        colors: {
            'orange': '#ff5722',
            'milky-white': 'rgb(239, 230, 238)',
            'grey-blue': '#607d8b',
            'grey': '#7d7c83',
            'dark': 'rgba(0, 0, 0, 0.11)',
            'dark-grey': 'rgba(61, 61, 61, 0.11)',
        },
        screens: {
            's': '0px',
            'sm': '580px',
            'md': '860px',
            'xl': '1200px',
            // => @media (min-width: 1280px) { ... }
        },
    },
    plugins: [],
}
