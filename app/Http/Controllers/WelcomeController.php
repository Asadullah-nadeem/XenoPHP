<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;
use Cake\Core\Configure as CakeConfigure;

class WelcomeController extends Controller
{
    public function index()
    {
        $cakeVersion = class_exists(CakeConfigure::class) ? CakeConfigure::version() : 'N/A';
        $symfonyVersion = class_exists(SymfonyKernel::class) ? SymfonyKernel::VERSION : 'N/A';
        $ciVersion = defined('CI_VERSION') ? CI_VERSION : 'N/A';

        return response()->json([
            'message' => 'Welcome to XenoPHP',
            'description' => 'Combining the strengths of Laravel, CakePHP, Symfony, and CodeIgniter into a single, powerful backend framework.',
            'versions' => [
                'laravel' => app()->version(),
                'php' => PHP_VERSION,
                'cakephp' => $cakeVersion,
                'symfony' => $symfonyVersion,
                'codeigniter' => $ciVersion,
            ]
        ]);
    }
}
