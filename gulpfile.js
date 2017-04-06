var elixir = require('laravel-elixir');
// require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

    // var npmDir = 'node_modules/',
    // jsDir = 'resources/assets/js/';
    //
    // mix.copy(npmDir + 'vue/dist/vue.min.js', jsDir);
    // mix.copy(npmDir + 'vue-resource/dist/vue-resource.min.js', jsDir);
    //
    // mix.scripts([
    //     'vue.min.js',
    //     'vue-resource.min.js',
    // ],'public/js/vendor.js');

    mix.copy('node_modules/icheck/**', 'public/themes/news-theme/assets/js/icheck');
    mix.copy('node_modules/admin-lte/**', 'public/themes/news-theme/assets/AdminLTE');
});





// elixir(function(mix) {
//     var npmDir = 'node_modules/',
//     jsDir = 'resources/assets/js/';
//
//     mix.copy(npmDir + 'vue/dist/vue.min.js', jsDir);
//     mix.copy(npmDir + 'vue-resource/dist/vue-resource.min.js', jsDir);
// });


// elixir(function(mix) {
//     // var npmDir = 'node_modules/',
//     // jsDir = 'resources/assets/js/';
//     //
//     // mix.copy(npmDir + 'vue/dist/vue.min.js', jsDir);
//     // mix.copy(npmDir + 'vue-resource/dist/vue-resource.min.js', jsDir);
// });