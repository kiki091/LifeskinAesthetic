process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
var browserSync = require('laravel-elixir-browsersync-official');
var gulp = require("gulp");

var bowerDir = './public/vendor/';

elixir(function(mix) {

    //********************************** CSS **********************************//    
    // From Plugin
    mix.styles([
        'slick-carousel/slick/slick.css',
        'slick-carousel/slick/slick-theme.css',
        'swiper/dist/css/swiper.min.css',
        'chosen/chosen.css',
        'magnificpopup/magnific-popup.css',
        'jquery-virtual-tour/css/jquery.panorama.css',
        'air-datepicker/datepicker.min.css',
        'photo-sphere-viewer/dist/photo-sphere-viewer.min.css'
    ], 'public/css/pg_plugins.css', bowerDir);

    // core
    mix.sass('pg_core.scss', 'public/css/pg_core.css');

    // group core
    mix.sass('group/group_core.scss', 'public/css/group_core.css');

    // cluster core
    mix.sass('cluster/cluster_core.scss', 'public/css/cluster/cluster_core.css');

    // cluster detail
    mix.sass('cluster/voyage.scss', 'public/css/cluster/voyage.css');


    // cms
    mix.sass('pg_facile.scss', 'public/css/pg_facile.css');


    //********************************** JS ***********************************//
    // From Plugin
    mix.scripts([
        'jquery/jquery-1.11.3.min.js',
        'slimscroll/jquery.slimscroll.min.js',
        'slick-carousel/slick/slick.js',
        'swiper/dist/js/swiper.min.js',
        'chosen/chosen.jquery.js',
        'gsap/src/minified/TweenLite.min.js',
        'gsap/src/minified/TimelineLite.min.js',
        'gsap/src/minified/TweenMax.min.js',
        'gsap/src/minified/TimelineMax.min.js',
        'scrollmagic/scrollmagic/minified/ScrollMagic.min.js',
        'magnificpopup/jquery.magnific-popup.min.js',
        'responsive-img.js/responsive-img.min.js',
        'retinajs/retina.js',
        'jquery.anchorScroll-master/jquery.anchorScroll.js',
        'matchHeight/dist/jquery.matchHeight-min.js',
        'infobubble/infobubble.js',
        'air-datepicker/datepicker.min.js',
        'air-datepicker/datepicker.en.js',
        'three.js/three.min.js',
        'D.js/lib/D.js',
        'uevent/uevent.min.js',
        'doT/doT.min.js',
        'three.js/CanvasRenderer.js',
        'three.js/Projector.js',
        'photo-sphere-viewer/dist/photo-sphere-viewer.js',
        // 'dense/dense.js',
        // 'jquery-unveil/jquery.unveil.min.js'
    ], 'public/js/pg_plugins.js', bowerDir);

    // core
    mix.scripts([ 'pg_core.js' ], 'public/js/pg_core.js');
    mix.scripts([ 'group/group_core.js'], 'public/js/group_core.js');

    // pages
    mix.scripts([ 'cityplan.js' ], 'public/js/cityplan.js');
    mix.scripts([ 'thebay.js' ], 'public/js/thebay.js');
    mix.scripts([ 'unittype.js' ], 'public/js/unittype.js');
    mix.scripts([ 'township.js' ], 'public/js/township.js');
    mix.scripts([ 'fullmap.js' ], 'public/js/fullmap.js');
    mix.scripts([ 'simplemap.js' ], 'public/js/simplemap.js');

    //group
    mix.scripts([ 'group/landing.js' ], 'public/js/landing.js');    

    // cluster detail
    mix.scripts([ 'cluster/voyage.js' ], 'public/js/cluster/voyage.js');


    //****************************** Versioning *******************************//
    mix.version([
        "public/css/pg_plugins.css",
        "public/css/pg_core.css",
        "public/css/cluster/cluster_core.css",
        "public/css/group_core.css",
        "public/js/pg_plugins.js",
        "public/js/pg_core.js",
        "public/js/group_core.js",

        // pages
        "public/js/township.js",
        "public/js/cityplan.js",
        "public/js/fullmap.js",
        "public/js/thebay.js",
        "public/js/unittype.js",

        // cluster specific
        "public/css/cluster/voyage.css",
        "public/js/cluster/voyage.js",

        //cms
        "public/css/pg_facile.css"
    ]);

    mix.browserSync({
        proxy: 'locprogressgroupfacile.com'
    });
});

