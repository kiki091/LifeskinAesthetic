<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;

class FacileRepositoryPatternMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facile:rp {name} {--dir=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Facile repository pattern';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return __DIR__.'/stubs/controller.stub';
        }

        return __DIR__.'/stubs/controller.plain.stub';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('facile:contracts', [
            'name' => $this->argument('name'),
            '--dir' => $this->option('dir'),
        ]);

        Artisan::call('facile:implementation', [
            'name' => $this->argument('name'),
            '--dir' => $this->option('dir'),
        ]);

        Artisan::call('facile:service', [
            'name' => $this->argument('name'),
            '--dir' => $this->option('dir'),
        ]);

        Artisan::call('facile:transformation', [
            'name' => $this->argument('name'),
            '--dir' => $this->option('dir'),
        ]);

        $this->info('Facile repository pattern created successfully.');
    }
}
