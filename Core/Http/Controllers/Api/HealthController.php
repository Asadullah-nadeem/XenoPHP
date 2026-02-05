<?php

namespace Core\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HealthController extends Controller
{
    use ApiResponse;

    public function index()
    {
        // 1. Database Check
        $dbStatus = 'Connected';
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbStatus = 'Disconnected: ' . $e->getMessage();
            Log::error('Health Check DB Error: ' . $e->getMessage());
        }

        // 2. Disk Space (Root)
        $diskFree = disk_free_space('/');
        $diskTotal = disk_total_space('/');
        $diskUsage = $diskFree !== false ? round(($diskFree / $diskTotal) * 100, 2) . '%' : 'Unknown';

        // 3. Memory Usage
        $memoryUsage = round(memory_get_usage() / 1024 / 1024, 2) . ' MB';

        // 4. Time
        $uptime = defined('LARAVEL_START') ? round(microtime(true) - LARAVEL_START, 4) . 's' : 'N/A';

        return $this->success([
            'system' => 'XenoPHP Backend',
            'status' => 'Healthy',
            'database' => $dbStatus,
            'server' => [
                'php_version' => PHP_VERSION,
                'disk_free_percentage' => $diskUsage,
                'memory_usage' => $memoryUsage,
            ],
            'request_duration' => $uptime,
            'timestamp' => now()->toIso8601String(),
        ], 'System vital signs checked.');
    }
}
