<?php 

namespace Modules\Core\Providers;

use Modules\Core\Providers\FacileRoutingServiceProvider as FacileRoutingServiceProvider;

class RouteServiceProvider extends FacileRoutingServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     * @var string
     */
    protected $namespace = 'Modules\Core\Http\Controllers';

    /**
     * @return string
     */
    protected function getFrontendRoute()
    {
        return __DIR__ . '/../Http/frontendRoutes.php';
    }

    /**
     * @return string
     */
    protected function getBackendRoute()
    {
        //dd(__DIR__ . '/../Http/routes.php');
        return __DIR__ . '/../Http/backendRoutes.php';
    }

    /**
     * @return string
     */
    protected function getApiRoute()
    {
        return false;
    }
}
