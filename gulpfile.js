process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
var browserSync = require('laravel-elixir-browsersync-official');
var gulp = require("gulp");

var bowerDir = './public/bower_components/';
var themesFrontDir = './public/themes/front/';

elixir(function(mix) {

    //********************************** CSS **********************************//    
    // From Plugin
    mix.styles([
        'chosen/css/chosen.css',
        'air-datepicker-master/dist/css/datepicker.css',
        'hold-on/HoldOn.min.css',
        'pnotify/dist/pnotify.css',
        'sweetalert/dist/sweetalert.css',
        'toastr/toastr.css'
    ], 'public/css/plugins.css', bowerDir);

    mix.styles([
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/material-design-iconic-font.min.css',
        'css/plugins/animate.css',
        'css/plugins/animated-headlines.css',
        'css/plugins/jquery.mb.YTPlayer.min.css',
        'css/plugins/jquery-ui.min.css',
        'css/plugins/owl.theme.css',
        'css/plugins/owl.carousel.css',
        'css/plugins/owl.transitions.css',
        'css/plugins/meanmenu.min.css',
        'css/plugins/nivo-slider.css',
        'css/plugins/magnific-popup.css',
        'css/default.css',
        'css/style.css',
        'css/responsive.css',
        'css/icomoon.css',
        'css/style-customizer.css'
    ], 'public/css/core.css', themesFrontDir);

    //********************************** JS ***********************************//
    // From Plugin
    mix.scripts([
        //'chosen/js/chosen.js',
        'ckeditor/ckeditor.js',
        'air-datepicker-master/dist/js/datepicker.js',
        'hold-on/HoldOn.min.js',
        'masonry/dist/masonry.pkgd.js',
        'moment/moment.js',
        'notifyjs/dist/notify.js',
        'pacejs/pace.js',
        'pnotify/dist/pnotify.js',
        'sortable/sortable.js',
        'sweetalert/dist/sweetalert-dev.js',
        'toastr/toastr.js'
    ], 'public/js/plugins.js', bowerDir);

    mix.scripts([
        'js/jquery-1.12.0.min.js',
        'js/modernizr-2.8.3.min.js',
        'js/bootstrap.min.js',
        'js/jquery.nivo.slider.pack.js',
        'js/owl.carousel.min.js',
        'js/jquery.magnific-popup.js',
        'js/jquery.counterup.min.js',
        'js/waypoints.min.js',
        'js/style-customizer.js',
        'js/plugins.js',
        'js/jquery.leanModal.min.js',
        'js/main.js',
        'js/map.js'
    ], 'public/js/core.js', themesFrontDir);


    //****************************** Versioning *******************************//
    mix.version([
        "public/css/core.css",
        "public/css/plugins.css",
        "public/js/core.js",
        "public/js/plugins.js"
    ]);
});

