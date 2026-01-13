module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1.5rem',
                sm: '1rem',
                lg: '1rem',
                xl: '4rem',
                '2xl': '10em',
            },
        },
        extend: {
            colors: {
                'primary': {
                    DEFAULT: '#1C3E7E',
                    600: '#326BD6'
                },
                'secondary': {
                    DEFAULT: '#326BD6',
                },
                'gray': {
                    DEFAULT: '#6B6B6B',
                    700: '#D4D4D4',
                    600: '#F0F0F0',
                },
            },
            fontFamily: {
                "orkney": ['Orkney']
            },
        },
    },
    plugins: [
    ]
}
