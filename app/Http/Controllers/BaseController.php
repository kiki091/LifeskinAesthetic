<?php 

namespace App\Http\Controllers;

use FloatingPoint\Stylist\Facades\ThemeFacade as Theme;
use Illuminate\Routing\Controller;
use Modules\Core\Foundation\Asset\Manager\AssetManager;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Nwidart\Modules\Facades\Module;

class BaseController extends Controller
{
    /**
     * @var AssetManager
     */
    protected $assetManager;
    /**
     * @var AssetPipeline
     */
    protected $assetPipeline;

    public function __construct()
    {

        $this->assetManager = app(AssetManager::class);
        $this->assetPipeline = app(AssetPipeline::class);

        $this->addAssets();
        $this->requireDefaultAssets();
    }

    /**
     * Add the assets from the config file on the asset manager
     */
    private function addAssets()
    {
        foreach (config('facile.core.core.admin-assets') as $assetName => $path) {
            if (key($path) == 'theme') {
                $this->assetManager->addAsset($assetName, Theme::url($path['theme']));
            } else {
                $this->assetManager->addAsset($assetName, Module::asset($path['module']));
            }
        }
    }

    /**
     * Require the default assets from config file on the asset pipeline
     */
    private function requireDefaultAssets()
    {
        $this->assetPipeline->requireCss(config('facile.core.core.admin-required-assets.css'));
        $this->assetPipeline->requireJs(config('facile.core.core.admin-required-assets.js'));
    }
}
