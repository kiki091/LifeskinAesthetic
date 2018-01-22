<?php

namespace Modules\Core\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class FacileTransformationMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facile:transformation {name} {--dir=} {--resource=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new transformation';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Transformation';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return __DIR__.'/stubs/transformation.stub';
        }

        return __DIR__.'/stubs/transformation.plain.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($folder = $this->option('dir')){
            $folder = '\\'. $this->option('dir');
        }
        return $rootNamespace.'\Services\Transformation' . $folder;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', null, InputOption::VALUE_NONE, 'Generate a resource transformation class.'],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $namespace = $this->getNamespace($name);

        return str_replace("use {$namespace}\Services;\n", '', parent::buildClass($name));
    }
}
