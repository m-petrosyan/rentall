module.exports = {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
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
    
        },
        fontSize: {},
        colors: {
            'white': '#fff',
            'orange': '#ff5722',
            // 'milky-white': 'rgb(239, 230, 238)',
            // 'grey-blue': '#607d8b',
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
    plugins: [],
}
