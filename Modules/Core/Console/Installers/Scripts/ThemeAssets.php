<?php namespace Modules\Core\Console\Installers\Scripts;

use Illuminate\Console\Command;
use Modules\Core\Console\Installers\SetupScript;
use Illuminate\Contracts\Config\Repository as Config;

class ThemeAssets implements  SetupScript
{

    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        if ($command->option('verbose')) {
            $command->blockMessage('Themes', 'Publishing theme assets ...', 'comment');
        }

        
        $theme = $this->config['facile.core.core.admin-theme'];

        // exec("npm install gulp");
        // exec("npm install gulp-shell");
        // exec("npm install laravel-elixir");
        // exec("gulp --gulpfile=Themes/$theme/gulpfile.js");


        if ($command->option('verbose')) {
            $command->call('stylist:publish');

            return;
        }
        $command->callSilent('stylist:publish');
    }
}
