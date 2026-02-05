<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;
use Cake\Core\Configure as CakeConfigure;

use Core\Traits\ApiResponse;

class WelcomeController extends Controller
{
    use ApiResponse;

    /**
     * Display the welcome response with framework version details.
     *
     * This method gathers version information from various underlying frameworks
     * (Laravel, CakePHP, Symfony, CodeIgniter) and calculates the execution time
     * to demonstrate the performance of XenoPHP.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cakeVersion = class_exists(CakeConfigure::class) ? CakeConfigure::version() : 'N/A';
        $symfonyVersion = class_exists(SymfonyKernel::class) ? SymfonyKernel::VERSION : 'N/A';
        $ciVersion = defined('CI_VERSION') ? CI_VERSION : 'N/A';

        $startTime = defined('XENOPHP_START') ? XENOPHP_START : (defined('LARAVEL_START') ? LARAVEL_START : microtime(true));
        $executionTime = microtime(true) - $startTime;

        return $this->success([
            'description' => 'Combining the strengths of Laravel, CakePHP, Symfony, and CodeIgniter into a single, powerful backend framework.',
            'versions' => [
                'laravel' => app()->version(),
                'php' => PHP_VERSION,
                'cakephp' => $cakeVersion,
                'symfony' => $symfonyVersion,
                'codeigniter' => $ciVersion,
            ],
            'performance' => [
                'load_time_ms' => round($executionTime * 1000, 2) . ' ms',
                'load_time_sec' => number_format($executionTime, 4) . ' s',
            ],
        ], 'Welcome to XenoPHP');
    }
}
