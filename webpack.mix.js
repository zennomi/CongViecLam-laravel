const mix = require('laravel-mix');
require('laravel-mix-purgecss');

// ## Backend Mixing
// CSS
mix.combine([
    'public/backend/dist/css/adminlte-variable.min.css',
    'public/backend/plugins/toastr/toastr.min.css',
    'public/backend/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css',
    'public/backend/css/google-font.css',
    'public/backend/css/zakirsoft.css'
], 'public/backend/css/vendor.min.css'
).purgeCss({ enabled: true, }).version();

// JS
mix.combine([
    'public/backend/plugins/jquery/jquery.min.js',
    'public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'public/backend/plugins/toastr/toastr.min.js',
    'public/backend/dist/js/ckeditor.js',
    'public/backend/dist/js/adminlte.min.js',
], 'public/backend/js/vendor.min.js').version();

// ## Frontend Mixing
// CSS
mix.combine([
    'public/frontend/assets/css/content.min.css',
    'public/frontend/assets/css/OverlayScrollbars.min.css',
    'public/frontend/assets/css/select2.min.css',
    'public/frontend/assets/css/slick-theme.css',
    'public/frontend/assets/css/slick.css',
    'public/frontend/assets/css/bootstrap.min.css',
    'public/frontend/assets/css/bootstrap-select-country.min.css',
    'public/frontend/plugins/cookieconsent/cookieconsent.css',
    'public/backend/plugins/toastr/toastr.min.css',
    'public/backend/plugins/sweetalert2/sweetalert2.min.css',
], 'public/frontend/vendor.min.css').purgeCss({
    enabled: true
}).version();

mix.combine([
    'public/frontend/assets/css/app.css',
    'public/frontend/zakirsoft.css',
], 'public/frontend/app.min.css').purgeCss({
    enabled: true
}).version();

// JS
mix.combine([
    'public/frontend/assets/js/jquery-3.6.0.min.js',
    'public/frontend/assets/js/bootstrap.bundle.js',
    'public/frontend/assets/js/jquery.counterup.min.js',
    // 'public/frontend/assets/js/jquery.easing.1.3.js',`
    'public/frontend/assets/js/jquery.scrollUp.min.js',
    'public/frontend/assets/js/OverlayScrollbars.js',
    'public/frontend/assets/js/scrollax.min.js',
    'public/frontend/assets/js/select2.min.js',
    'public/frontend/assets/js/waypoints.min.js',
    'public/frontend/assets/js/jquery-ui.min.js',
    'public/backend/plugins/toastr/toastr.min.js',
    'public/backend/plugins/sweetalert2/sweetalert2.all.min.js',
], 'public/frontend/vendor.min.js').version();

mix.combine([
    'public/frontend/assets/js/app.js',
], 'public/frontend/app.min.js').version();

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
