<?php

namespace Core\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Traits\ApiResponse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success([
            'service' => 'XenoPHP API',
            'status' => 'Operational',
            'timestamp' => now()->toIso8601String(),
            'secure' => true
        ], 'System status retrieved successfully.');
    }
}
