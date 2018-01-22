<?php namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class PublishThemeAssetsCommand extends Command
{
    protected $name = 'facile:publish:theme';
    protected $description = 'Publish theme assets';

    public function fire()
    {
        $theme = $this->argument('theme', null);

        if (!empty($theme)) {
            //exec("gulp --gulpfile=Themes/$theme/gulpfile.js");
            //cleanup the folder
            $dirPath = public_path("themes/".strtolower($this->argument('theme')));
            if(is_dir($dirPath))
                system("rm -rf ".escapeshellarg($dirPath));
            $this->call('stylist:publish', ['theme' => $this->argument('theme')]);
        } else {
            $dirPath = public_path("themes");
            if(is_dir($dirPath))
                system("rm -rf ".escapeshellarg($dirPath));
            $this->call('stylist:publish');
        }
    }

    protected function getArguments()
    {
        return [
            ['theme', InputArgument::OPTIONAL, 'Name of the theme you wish to publish']
        ];
    }
}
