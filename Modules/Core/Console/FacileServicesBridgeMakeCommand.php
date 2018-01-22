<?php

namespace Modules\Core\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class FacileServicesBridgeMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facile:service {name} {--dir=} {--resource=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return __DIR__.'/stubs/service.stub';
        }

        return __DIR__.'/stubs/service.plain.stub';
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
        return $rootNamespace.'\Services\Bridge' . $folder;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', null, InputOption::VALUE_NONE, 'Generate a resource service class.'],
        ];
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );

        $stub = str_replace(
            'DummyRootNamespace', $this->laravel->getNamespace(), $stub
        );

        $contracts = str_replace(['Services', 'Bridge'],  ['Repositories', 'Contracts'], $this->getNamespace($name));

        $stub = str_replace(
            'DummyUseInterface', $contracts . '\\' . $this->argument('name'), $stub
        );

        return $this;
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
