process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
require('laravel-elixir-browserify-official');
require('laravel-elixir-vueify');
var gulp = require("gulp");

var bowerDir = './public/vendor/';

elixir(function(mix) {
    mix.browserify('cms/menu.js','public/cms/js/menu.js');
});

