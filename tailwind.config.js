/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    darkMode: 'false',
    theme: {
        extend: {},
        colors: {
            primary: "#60495A",
            sec: "#F3DFA2",
            btn_primary: {
                300: "#366366",
                400: "#7EBDC2"
            },
            btn_font_color: "#FFFFFF"
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
