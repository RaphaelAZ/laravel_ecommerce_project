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
            primary: "#723b0b",
            sec: "#5c7fe6"
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
