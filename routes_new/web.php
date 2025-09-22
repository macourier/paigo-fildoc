<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->get('/_set_session', function () {
    // Force session write
    session(['fildoc_session_test' => now()->toDateTimeString()]);

    return response()->json([
        'ok' => true,
        'session_value' => session('fildoc_session_test'),
    ])->header('X-Session-Set', '1');
});
