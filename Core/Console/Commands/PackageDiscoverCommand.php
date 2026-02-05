<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\PackageManifest;

class PackageDiscoverCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:discover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild the cached package manifest (Filtered for Backend).';

    /**
     * Execute the console command.
     *
     * @param  \Illuminate\Foundation\PackageManifest  $manifest
     * @return void
     */
    public function handle(PackageManifest $manifest)
    {
        // 1. Run the actual discovery logic
        $manifest->build();

        // 2. Custom Output: Filter out frontend/view-related packages
        $this->components->info('Discovering XenoPHP Backend Packages...');

        $hidden = [
            'inertiajs/inertia-laravel',
            'laravel/breeze',
            'tightenco/ziggy',
            'nunomaduro/termwind', // Often noisy in backend logs
        ];

        $packages = array_keys($manifest->manifest);

        foreach ($packages as $package) {
            // Only show if NOT in the hidden list
            if (!in_array($package, $hidden)) {
                $this->components->task($package);
            }
        }

        $this->newLine();
        $this->components->info('✔ Package manifest generated successfully.');
    }
}
