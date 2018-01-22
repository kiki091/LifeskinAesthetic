<?php namespace Modules\Core\Console\Installers\Scripts;

use Illuminate\Console\Command;
use Modules\Core\Console\Installers\SetupScript;

class ModuleSeeders implements SetupScript
{
    /**
     * @var array
     */
    protected $modules = [
        'Account',
    ];

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        if ($command->option('verbose')) {
            $command->blockMessage('Seeds', 'Running the module seeds ...', 'comment');
        }

        foreach ($this->modules as $module) {
            if ($command->option('verbose')) {
                $command->call('module:seed', ['module' => $module, '--database' => 'facile']);
                continue;
            }
            $command->callSilent('module:seed', ['module' => $module, '--database' => 'facile']);
        }
    }
}
