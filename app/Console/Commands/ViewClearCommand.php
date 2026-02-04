<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ViewClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disabled: Views are not used in this MC architecture.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->components->warn('Views are not used in this MC (Model-Controller) architecture.');
        $this->components->info('Skipping view clearing.');
    }
}
