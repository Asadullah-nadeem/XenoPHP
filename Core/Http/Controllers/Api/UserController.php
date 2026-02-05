<?php

namespace Core\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get the authenticated user.
     */
    public function show(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user(),
        ]);
    }
}
