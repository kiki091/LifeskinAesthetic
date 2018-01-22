<?php namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class CopyThemeAssetsCommand extends Command
{
    protected $name = 'facile:copy:theme';
    protected $description = 'Copy theme assets';

    public function fire()
    {
        $theme = $this->argument('theme', null);

        if (!empty($theme)) {
            $dirPathFrom = "Themes/".$this->argument('theme')."/resources/assets/sass/themes/_facile.scss";
            $dirPathTo = resource_path("assets/sass/");
            
            if(file_exists($dirPathFrom))
            {
                system("cp ".escapeshellarg($dirPathFrom)." ".escapeshellarg($dirPathTo));
                $this->info('Success copying assets\' variable');
            }
            else 
            {
                $this->info('Failed to find '.$dirPathFrom);    
            }
            
        } 
    }

    protected function getArguments()
    {
        return [
            ['theme', InputArgument::OPTIONAL, 'Name of the theme you wish to publish']
        ];
    }
}
