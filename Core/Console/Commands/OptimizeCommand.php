<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class OptimizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache everything to make the application "Fast" and "Powerful".';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Making XenoPHP Fast & Powerful...');
        $this->newLine();

        // 1. Config Cache
        $this->call('config:cache');
        $this->info('✔ Config Cached');

        // 2. Route Cache
        $this->call('route:cache');
        $this->info('✔ Routes Cached');

        // 3. Views Skipped (MC Architecture)
        // $this->call('view:cache');

        // 4. Optimize Autoloader
        $this->info('Processing Composer Optimization...');
        // We run this via shell exec as it's a composer command
        $output = shell_exec('composer dump-autoload -o');

        $this->newLine();
        $this->comment('XenoPHP is now running at maximum power! ⚡');
    }
}
