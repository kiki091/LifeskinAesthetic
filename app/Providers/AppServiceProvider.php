<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        //
        //
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
            $this->app->register(\Orangehill\Iseed\IseedServiceProvider::class);
        }
        // FRONT

        $this->app->bind('App\Repositories\Contracts\Auth\Member', 'App\Repositories\Implementation\Auth\Member');
        $this->app->bind('App\Repositories\Contracts\Front\General', 'App\Repositories\Implementation\Front\General');
        $this->app->bind('App\Repositories\Contracts\Front\Seo', 'App\Repositories\Implementation\Front\Seo');
        $this->app->bind('App\Repositories\Contracts\Front\MainBanner', 'App\Repositories\Implementation\Front\MainBanner');
        $this->app->bind('App\Repositories\Contracts\Front\About', 'App\Repositories\Implementation\Front\About');
        $this->app->bind('App\Repositories\Contracts\Front\Information', 'App\Repositories\Implementation\Front\Information');
        $this->app->bind('App\Repositories\Contracts\Front\Category', 'App\Repositories\Implementation\Front\Category');
        $this->app->bind('App\Repositories\Contracts\Front\SubCategory', 'App\Repositories\Implementation\Front\SubCategory');
        $this->app->bind('App\Repositories\Contracts\Front\Product', 'App\Repositories\Implementation\Front\Product');
        $this->app->bind('App\Repositories\Contracts\Front\Gallery', 'App\Repositories\Implementation\Front\Gallery');
        $this->app->bind('App\Repositories\Contracts\Front\Package', 'App\Repositories\Implementation\Front\Package');
        $this->app->bind('App\Repositories\Contracts\Front\News', 'App\Repositories\Implementation\Front\News');
        $this->app->bind('App\Repositories\Contracts\Front\Booking', 'App\Repositories\Implementation\Front\Booking');
        $this->app->bind('App\Repositories\Contracts\Front\Treatment', 'App\Repositories\Implementation\Front\Treatment');

        // CMS

        $this->app->bind('App\Repositories\Contracts\Cms\News', 'App\Repositories\Implementation\Cms\News');
        $this->app->bind('App\Repositories\Contracts\Cms\SubCategory', 'App\Repositories\Implementation\Cms\SubCategory');
        $this->app->bind('App\Repositories\Contracts\Cms\Category', 'App\Repositories\Implementation\Cms\Category');
        $this->app->bind('App\Repositories\Contracts\Cms\Product', 'App\Repositories\Implementation\Cms\Product');
        $this->app->bind('App\Repositories\Contracts\Cms\Package', 'App\Repositories\Implementation\Cms\Package');
        $this->app->bind('App\Repositories\Contracts\Cms\Gallery', 'App\Repositories\Implementation\Cms\Gallery');
        $this->app->bind('App\Repositories\Contracts\Cms\MainBanner', 'App\Repositories\Implementation\Cms\MainBanner');
        $this->app->bind('App\Repositories\Contracts\Cms\General', 'App\Repositories\Implementation\Cms\General');
        $this->app->bind('App\Repositories\Contracts\Cms\About', 'App\Repositories\Implementation\Cms\About');
        $this->app->bind('App\Repositories\Contracts\Cms\Transaction', 'App\Repositories\Implementation\Cms\Transaction');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(

            // FRONT
            
            'App\Repositories\Contracts\Front\General',
            'App\Repositories\Contracts\Front\Seo',
            'App\Repositories\Contracts\Front\MainBanner',
            'App\Repositories\Contracts\Front\About',
            'App\Repositories\Contracts\Front\Information',
            'App\Repositories\Contracts\Front\Category',
            'App\Repositories\Contracts\Front\SubCategory',
            'App\Repositories\Contracts\Front\Product',
            'App\Repositories\Contracts\Front\Gallery',
            'App\Repositories\Contracts\Front\Package',
            'App\Repositories\Contracts\Front\Booking',
            'App\Repositories\Contracts\Front\News',
            'App\Repositories\Contracts\Front\Treatment',

            // CMS

            'App\Repositories\Contracts\Cms\News',
            'App\Repositories\Contracts\Cms\SubCategory',
            'App\Repositories\Contracts\Cms\Category',
            'App\Repositories\Contracts\Cms\Product',
            'App\Repositories\Contracts\Cms\Package',
            'App\Repositories\Contracts\Cms\Gallery',
            'App\Repositories\Contracts\Cms\MainBanner',
            'App\Repositories\Contracts\Cms\General',
            'App\Repositories\Contracts\Cms\About',
            'App\Repositories\Contracts\Cms\Transaction',
        );
    }
}
