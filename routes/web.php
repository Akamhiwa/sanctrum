<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This project is API-only. All endpoints return JSON.
|
*/

// API Info at root
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to Lara Blog API',
        'version' => '1.0.0',
        'status' => 'active',
        'documentation' => 'Simple beginner-friendly REST API',
        'endpoints' => [
            'auth' => [
                'POST /register' => 'Register new user',
                'POST /login' => 'Login user',
                'POST /logout' => 'Logout user (requires auth)',
            ],
            'profile' => [
                'GET /profile' => 'Get authenticated user profile (requires auth)',
                'PUT /profile' => 'Update authenticated user profile (requires auth)',
                'GET /users/{username}' => 'Get user by username (public)',
            ],
            'system' => [
                'GET /' => 'API information (this endpoint)',
                'GET /health' => 'Health check',
            ]
        ],
        'base_url' => url('/'),
        'timestamp' => now()->toIso8601String(),
    ]);
});
