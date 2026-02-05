<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;

class ServerCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the server environment for security and performance requirements.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting XenoPHP Server Robustness Check...');
        $this->newLine();

        $requirements = [
            'PHP Version >= 8.2' => version_compare(PHP_VERSION, '8.2.0', '>='),
            'Extension: intl' => extension_loaded('intl'),
            'Extension: mbstring' => extension_loaded('mbstring'),
            'Extension: openssl' => extension_loaded('openssl'),
            'Extension: ctype' => extension_loaded('ctype'),
            'Extension: xml' => extension_loaded('xml'),
        ];

        $security = [
            'Expose PHP (should be Off)' => ini_get('expose_php') == '',
            'Allow URL Fopen (should be Off)' => ini_get('allow_url_fopen') == '',
            'Display Errors (should be Off)' => ini_get('display_errors') == '',
        ];

        $this->section('System Requirements');
        foreach ($requirements as $label => $pass) {
            if ($pass) {
                $this->line("  <info>✔</info> $label");
            } else {
                $this->line("  <error>✘</error> $label");
            }
        }

        $this->newLine();
        $this->section('Security Checks');
        foreach ($security as $label => $pass) {
             if ($pass) {
                $this->line("  <info>✔</info> $label");
            } else {
                $this->line("  <comment>⚠</comment> $label (Recommended for Production)");
            }
        }

        $this->newLine();
        $this->info('Check Complete.');
    }

    protected function section($title)
    {
        $this->line("<comment>$title</comment>");
        $this->line(str_repeat('-', 20));
    }
}
