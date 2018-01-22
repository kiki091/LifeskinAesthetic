<?php 

namespace Modules\Core\Providers;

use Modules\Core\Providers\FacileRoutingServiceProvider as FacileRoutingServiceProvider;

class FacileGeneralRouteServiceProvider extends FacileRoutingServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * @return string
     */
    protected function getFrontendRoute()
    {
        return false;
    }

    /**
     * @return string
     */
    protected function getBackendRoute()
    {
        return __DIR__ . '/../../../routes/modules.php';
    }

    /**
     * @return string
     */
    protected function getApiRoute()
    {
        return false;
    }
}
