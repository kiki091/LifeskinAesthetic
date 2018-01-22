<?php

namespace Modules\Core\Providers;
use Maatwebsite\Sidebar\SidebarServiceProvider;

class FacileSidebarServiceProvider extends SidebarServiceProvider{


	protected function registerViews()
    {
        $viewBasePath = base_path('resources/views/vendor/');

        $paths = $this->app['config']->get('stylist.themes.paths');
        $theme = $this->app['config']->get('facile.core.core.admin-theme');

        $themePath = $paths[0].'/'.$theme.'/views/vendor';
        $vendorsIncluded = $this->app['config']->get('facile.core.core.admin-theme-include-vendor');

        foreach($vendorsIncluded as $vendorName)
        {
            $sourcePath = $themePath.'/'.$vendorName;
            $viewPath = $viewBasePath.$vendorName;
            $this->publishes([
                $sourcePath => $viewPath
            ]);

            $this->loadViewsFrom($sourcePath, $vendorName);
        }

        //dd($this->app['view']);
    }

}