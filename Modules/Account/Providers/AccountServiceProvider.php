<?php

namespace Modules\Account\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerClasses();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('account.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'account'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/account');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/account';
        }, \Config::get('view.paths')), [$sourcePath]), 'account');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/account');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'account');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'account');
        }
    }


    public function registerClasses()
    {

        $this->app->bind('Modules\Account\Repositories\Contracts\User'
            , 'Modules\Account\Repositories\Implementation\User');
        $this->app->bind('Modules\Account\Repositories\Contracts\Role'
            , 'Modules\Account\Repositories\Implementation\Role');
        $this->app->bind('Modules\Account\Repositories\Contracts\Folder'
            , 'Modules\Account\Repositories\Implementation\Folder');
        $this->app->bind('Modules\Account\Repositories\Contracts\System', 'Modules\Account\Repositories\Implementation\System');
        $this->app->bind('Modules\Account\Repositories\Contracts\Menu'
            , 'Modules\Account\Repositories\Implementation\Menu');
        $this->app->bind('Modules\Account\Repositories\Contracts\Group'
            , 'Modules\Account\Repositories\Implementation\Group');
        $this->app->bind('Modules\Account\Repositories\Contracts\Admin'
            , 'Modules\Account\Repositories\Implementation\Admin');
        $this->app->bind('Modules\Account\Repositories\Contracts\SystemFunction'
            , 'Modules\Account\Repositories\Implementation\SystemFunction');
        $this->app->bind('Modules\Account\Repositories\Contracts\SystemController'
            , 'Modules\Account\Repositories\Implementation\SystemController');
        $this->app->bind('Modules\Account\Repositories\Contracts\Privilege'
            , 'Modules\Account\Repositories\Implementation\Privilege');
        
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'Modules\Account\Repositories\Contracts\User',
            'Modules\Account\Repositories\Contracts\Role',
            'Modules\Account\Repositories\Contracts\Folder',
            'Modules\Account\Repositories\Contracts\System',
            'Modules\Account\Repositories\Contracts\Menu',
            'Modules\Account\Repositories\Contracts\Group',
            'Modules\Account\Repositories\Contracts\Admin',
            'Modules\Account\Repositories\Contracts\SystemFunction',
            'Modules\Account\Repositories\Contracts\SystemController',
            'Modules\Account\Repositories\Contracts\Privilege',
        );
    }
}
