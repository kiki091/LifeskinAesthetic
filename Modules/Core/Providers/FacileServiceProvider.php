<?php

namespace Modules\Core\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Modules\Core\Foundation\Theme\ThemeManager;
use Modules\Core\Foundation\Asset\Manager\FacileAssetManager;
use Modules\Core\Foundation\Asset\Manager\AssetManager;
use Modules\Core\Foundation\Asset\Pipeline\FacileAssetPipeline;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Modules\Core\Console\InstallCommand;
use Modules\Core\Console\PublishModuleAssetsCommand;
use Modules\Core\Console\PublishThemeAssetsCommand;
use Modules\Core\Console\CopyThemeAssetsCommand;
use Modules\Core\Console\GeneratePrivilegeCommand;
use Modules\Core\Console\FlushRedisKey;
use Modules\Core\Console\FacileContractsMakeCommand;
use Modules\Core\Console\FacileImplementationMakeCommand;
use Modules\Core\Console\FacileRepositoryPatternMakeCommand;
use Modules\Core\Console\FacileServicesBridgeMakeCommand;
use Modules\Core\Console\FacileTransformationMakeCommand;
use Maatwebsite\Sidebar\SidebarManager;
use Modules\Core\Custom\FacileForm;


class FacileServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    protected $middleware = [
        'permissions'           => 'PermissionMiddleware',
        'auth.admin'            => 'AdminMiddleware',
        'localizationRedirect'  => 'LocalizationMiddleware',
        'facile.privilege'      => 'FacilePrivilege',
        'guest'                 => 'RedirectIfAuthenticated',
        'can' => 'Authorization',
    ];

    private $request;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
    public function boot(SidebarManager $manager, Request $request)
    {
        $this->request = $request;
        if ($this->onBackend() === true ) {
            //$manager->register(AdminSidebar::class);
            $manager->register('Modules\Core\AdminSidebar');
        }
        
        $this->compose();
        $this->registerMiddleware($this->app['router']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function () {
            $this->registerAllThemes();
            $this->setActiveTheme();
            $this->bindAssetClasses();
            $this->bindClasses();
            $this->bindComponentViews();
            $this->registerCommands();
        });
        //dd($this);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function compose()
    {
        //create the view
        view()->creator('partials.sidebar', \Modules\Core\Composers\SidebarViewCreator::class);
        view()->composer('layouts.master', \Modules\Core\Composers\MasterViewComposer::class);
        view()->composer('*', \Modules\Core\Composers\LocaleComposer::class);
    }


    private function registerServices()
    {
        $this->app->bindShared(ThemeManager::class, function ($app) {
            $path = $app['config']->get('facile.core.core');
            return new ThemeManager($app, $path);
        });

        


    }

    public function registerMiddleware(Router $router)
    {
        foreach ($this->middleware as $name => $middleware) {
            $class = "Modules\\Core\\Http\\Middleware\\{$middleware}";
            $router->aliasMiddleware($name, $class);
        }
    }

    private function setActiveTheme()
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $themeName = $this->app['config']->get('facile.core.core.admin-theme');
        return $this->app['stylist']->activate($themeName, true);
    }

    private function registerAllThemes()
    {
        $directories = $this->app['files']->directories(config('stylist.themes.paths', [base_path('/Themes')])[0]);
        foreach ($directories as $directory) {
            $this->app['stylist']->registerPath($directory);
        }
    }

    private function registerCommands()
    {
        $this->commands([
            InstallCommand::class,
            PublishThemeAssetsCommand::class,
            PublishModuleAssetsCommand::class,
            FlushRedisKey::class,
            CopyThemeAssetsCommand::class,
            GeneratePrivilegeCommand::class,
            FacileContractsMakeCommand::class,
            FacileImplementationMakeCommand::class,
            FacileRepositoryPatternMakeCommand::class,
            FacileServicesBridgeMakeCommand::class,
            FacileTransformationMakeCommand::class,
        ]);
    }

    private function bindAssetClasses()
    {
        $this->app->singleton(AssetManager::class, function () {
            return new FacileAssetManager();
        });

        $this->app->singleton(AssetPipeline::class, function ($app) {
            return new FacileAssetPipeline($app[AssetManager::class]);
        });
    }


    private function bindClasses()
    {
        try {
            app()->getBindings()['Modules\Core\Contracts\Authentication'];
        } catch( \Exception $e)
        {
            $this->app->bind(
                'Modules\Core\Contracts\Authentication',
                'Modules\Core\Repositories\FacileAuthentication'
            );
        }
        

        $this->app->bind(
            'Maatwebsite\Sidebar\Item',
            'Modules\Core\Custom\Sidebar\Domain\DefaultItem'
        );
    }


    private function bindComponentViews()
    {
        // $fileViewFinder = new FileViewFinder($this->app['files'], config('view.paths'), null);

        // $this->app->singleton('view.finder', function($app)
        // {
        //     $paths = config('view.paths');
        //     $fileViewFinder = new FileViewFinder($app['files'], $paths, null);
        //     $vendorPath = '/vendor/sidebar';

        //     $hints = $this->hints['sidebar'];

        //     if (!Arr::has($hints, $vendorPath)) {
        //         $this->hints['sidebar'] = Arr::prepend($hints, $vendorPath);
        //     }
        //     return $fileViewFinder;
        // });

        // dd($this->app['view']);
        $theme_dir = $this->app['config']->get('facile.core.core.themes_path')
                    .'/'.$this->app['config']->get('facile.core.core.admin-theme')
                    .'/resources/views/components';

        $theme_dir = is_dir($theme_dir)? array($theme_dir): array();

        $this->app->bind('FacileForm', function () use ($theme_dir) {
            return new FacileForm($this->app['view'], $this->app['url']
                , array());
        });
    }



    private function onBackend()
    {
        $url = $this->request->url();
        if (str_contains($url, config('facile.core.core.admin-prefix'))) {
            return true;
        }
        return false;
    }
}
