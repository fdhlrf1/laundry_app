/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/tw-elements/js/**/*.js",
        './node_modules/tw-elements/dist/js/**/*.js',
    ],
    theme: {
        extend: {},
    },
    safelist: [
        {
            pattern: /data-te-.*/, // <== untuk menyelamatkan semua class data-te
        },
    ],
    plugins: [[require("tw-elements/plugin.cjs")]],
}
