<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;

class ShieldStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shield:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the security shield status of XenoPHP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info(' Scanning XenoPHP Security Shield...');
        $this->newLine();

        $headers = ['Feature', 'Status', 'Configuration'];
        $rows = [];

        // 1. Honeypot Check
        $honeypotEnabled = xeno_config('security.honeypot.enabled', false);
        $rows[] = [
            'Honeypot',
            $honeypotEnabled ? '<info>ACTIVE</info>' : '<error>INACTIVE</error>',
            'Field: ' . xeno_config('security.honeypot.field_name', 'N/A')
        ];

        // 2. CSP Check
        $csp = xeno_config('security.headers.csp');
        $rows[] = [
            'Content Security Policy',
            $csp ? '<info>ACTIVE</info>' : '<comment>DEFAULT</comment>',
            'Configured in xeno.yaml'
        ];

        // 3. HSTS Check
        $hsts = xeno_config('security.headers.hsts');
        $rows[] = [
            'HSTS',
            $hsts ? '<info>ACTIVE</info>' : '<comment>DEFAULT</comment>',
            'Force HTTPS'
        ];

        // 4. Debug Mode
        $debug = config('app.debug');
        $rows[] = [
            'App Debug Mode',
            !$debug ? '<info>SECURE (OFF)</info>' : '<error>INSECURE (ON)</error>',
            'Should be OFF in production'
        ];

        $this->table($headers, $rows);

        $this->newLine();
        if ($honeypotEnabled && !$debug) {
            $this->info('System is secure and ready for production.');
        } else {
            $this->warn('Security optimizations recommended.');
        }
    }
}
