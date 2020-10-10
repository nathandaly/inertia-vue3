const mix = require('laravel-mix');

require('laravel-mix-vue3');

mix.vue3("resources/js/app.js", "public/js", {
    typescript: false,
})
.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
]);

// mix.browserSync({
//     proxy: 'tenant.test',
//     notify: false,
// })
