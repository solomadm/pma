const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.options({ processCssUrls: false });

mix.webpackConfig({output: {filename: '[name].js', chunkFilename: 'chunks/[name].app.js', publicPath: '/'}});

//ADMIN PANEL
mix
    //FRONTEND
    .js('resources/assets/js/frontend/app.js', 'public/frontend/js')
    .sass('resources/assets/sass/frontend/GBF2017/base.scss', 'public/frontend/css')
    .combine([
        'resources/assets/js/frontend/GBF2017/jquery.countdown.js',
        'resources/assets/js/frontend/GBF2017/accordions.js',
        'resources/assets/js/frontend/GBF2017/block-heights.js',
        'resources/assets/js/frontend/GBF2017/mobile-menu.js',
        'resources/assets/js/frontend/GBF2017/scroll-top.js',
        'resources/assets/js/frontend/GBF2017/flexibility.js',
        'resources/assets/js/frontend/GBF2017/gmaps.js',
        'resources/assets/js/frontend/GBF2017/jquery.easypiechart.js',
        'resources/assets/js/frontend/GBF2017/scrollreveal.js'
    ], 'public/frontend/js/modules.js')
    .copyDirectory('resources/assets/fonts/frontend','public/frontend/fonts')
    .copyDirectory('resources/assets/img/frontend', 'public/frontend/img')

    //ADMIN
    .js('resources/assets/js/admin/app.js', 'public/admin/js')
    .less('node_modules/bootstrap-less/bootstrap/bootstrap.less', 'public/admin/css/bootstrap.css')
    .less('resources/assets/less/admin/adminlte-app.less','public/admin/css/adminlte-app.css')
    .less('node_modules/toastr/toastr.less','public/admin/css/toastr.css')
    .sass('resources/assets/sass/admin/app.scss', 'public/admin/css/app.css')
    .combine([
        'node_modules/admin-lte/dist/css/skins/_all-skins.css',
        'node_modules/vue2-autocomplete-js/dist/style/vue2-autocomplete.css',
        'public/admin/css/bootstrap.css',
        'node_modules/icheck/skins/square/blue.css',
        'public/admin/css/toastr.css',
        'public/admin/css/adminlte-app.css',
        'public/admin/css/app.css',
    ], 'public/admin/css/all.css')
    //APP RESOURCES
    .copy('resources/assets/img/admin/*.*','public/admin/img')
    //VENDOR RESOURCES

    .copy('node_modules/font-awesome/fonts','public/admin/fonts')
    .copy('node_modules/ionicons/dist/fonts','public/admin/fonts')
    .copy('resources/assets/less/admin/adminlte/bootstrap','public/admin')
    .copy('resources/assets/less/admin/adminlte/dist/css/skins','public/admin/css')
    .copy('resources/assets/less/admin/adminlte/dist/img','public/admin/img')
    .copy('resources/assets/less/admin/adminlte/plugins','public/admin/plugins')
    .copy('resources/assets/less/admin/adminlte/plugins/iCheck/square/blue.png','public/admin/css')
    .copy('resources/assets/less/admin/adminlte/plugins/iCheck/square/blue@2x.png','public/admin/css');

if (mix.config.inProduction) {
    mix.version();
}
