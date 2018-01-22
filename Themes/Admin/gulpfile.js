process.env.DISABLE_NOTIFIER = true;
//var shell = require('gulp-shell');
var elixir = require('laravel-elixir');
// require('laravel-elixir-browserify-official');
// require('laravel-elixir-vueify');
var gulp = require("gulp");


//Elixir.webpack.config.module.loaders = [];

var themeInfo = require('./theme.json');

// var task = elixir.Task;

// elixir.extend("stylistPublish", function() {
//     new task("stylistPublish", function() {
//         return gulp.src("").pipe(shell("php artisan stylist:publish " + themeInfo.name));
//     }).watch("**/*.less");
// });

// elixir.extend('sass', function (src, output, baseDir, options) {
//   new _CssTask2.default('sass', getPaths(src, baseDir, output), options);
// });

elixir(function (mix) {
    // mix.browserify('app-vue.js', "./assets/js");
    // mix.browserify('app-header.js', "./assets/js");
    // mix.browserify('menu.js', './assets/js');

    mix.scripts([
        'vendor/jquery/jquery-1.11.3.min.js',
        'vendor/jquery-ui/jquery-ui.js',
        'vendor/sortable/sortable.js',
        'vendor/air-datepicker/dist/js/datepicker.min.js',
        'vendor/air-datepicker/dist/js/i18n/datepicker.en.js',
        'vendor/collapse/collapse.js',
        'vendor/collapse/transition.js',
        'vendor/chosen/chosen.jquery.min.js',
        'vendor/malihuscroll/jquery.mCustomScrollbar.js',
        'vendor/gsap/src/minified/TweenMax.min.js',
        'vendor/pacejs/pace.min.js',
        'vendor/jquery-tokeninput/src/jquery.tokeninput.js',
        'vendor/notifyjs/dist/notify.js',
        'vendor/chartjs/dist/Chart.bundle.min.js',
        'vendor/chartjs/dist/Chart.PieceLabel.min.js',
        'vendor/malihuscroll/jquery.mCustomScrollbar.concat.min.js',
        'vendor/malihuscroll/jquery.mCustomScrollbar.js',
        'vendor/autosize/autosize.min.js',
        'vendor/momentjs/moment.min.js',
    ], 'assets/js/facile_plugins.js');

    mix.scripts('facile_main.js', 'assets/js/facile_main.js');
    mix.scripts('facile_core.js', 'assets/js/facile_core.js');
    mix.scripts('pages/login.js', 'assets/js/pages/login.js');

    // From Plugin
    mix.styles([
        '../js/vendor/air-datepicker/dist/css/datepicker.min.css',
        '../js/vendor/chosen/chosen.min.css',
        '../js/vendor/malihuscroll/jquery.mCustomScrollbar.css',
        '../js/vendor/pacejs/pace-theme-default.css',
        '../js/vendor/jquery-tokeninput/styles/token-input.css',
        '../js/vendor/malihuscroll/jquery.mCustomScrollbar.css'
    ], 'assets/css/facile_plugins.css');
    

    mix.sass([
            "facile_styles.scss"
        ], 'assets/css/facile_styles.css');

    mix.sass([
            "facile_editor.scss"
        ], 'assets/css/facile_editor.css');



    mix.version([
         "../assets/css/facile_styles.css",
         "../assets/css/facile_plugins.css",
         "../assets/js/facile_plugins.js",
         "../assets/js/facile_core.js",
         "../assets/js/facile_main.js",
         "../assets/js/pages/login.js"
    ], 'assets');


    //mix.stylistPublish();

    
    /**
     * Concat scripts
     */
    //mix.scripts([
    //    "app.js"
    //]);

    //mix.copy('resources/assets/js', 'assets/js');
});

