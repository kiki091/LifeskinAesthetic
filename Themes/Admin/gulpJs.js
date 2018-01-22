process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');
require('laravel-elixir-browserify-official');
require('laravel-elixir-vueify');
var gulp = require("gulp");


var themeInfo = require('./theme.json');

elixir(function (mix) {
    mix.browserify('app-vue.js', "./assets/js");
    mix.browserify('app-header.js', "./assets/js");
    mix.browserify('menu.js', './assets/js');
});

