<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class FlushRedisKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facile:flush-redis {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush redis by pattern';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $key = $this->argument('key');
            shell_exec('redis-cli keys "'.env('CACHE_PREFIX').':'.$key.':*" | xargs redis-cli del');
            $this->info('Success');
        } catch (\Exception $e) {
            $this->info($e->getMessage());
        }
    }
}
