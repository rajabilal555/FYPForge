<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug', function () {
    // Print out all debug information relative to the proxy request.
    return response()->json([
        'request_ip' => request()->ip(),
        'headers' => request()->headers->all(),
        'server' => request()->server->all(),
        'trusted_proxies' => request()->getTrustedProxies(),
        'is_trusted_proxy' => request()->isFromTrustedProxy(),
        'is_secure' => request()->secure(),
        'test url' => url('/'),
        'test asset' => asset('/'),
        'test signed Url' => URL::temporarySignedRoute(
            'test_signed_url',
            now()->addMinutes(30)
        ),
    ]);
});

Route::get('/test_signed_url', function () {
    return response()->json([
        'data' => request()->input(),
        'request_ip' => request()->ip(),
        'headers' => request()->headers->all(),
        'server' => request()->server->all(),
        'trusted_proxies' => request()->getTrustedProxies(),
        'is_trusted_proxy' => request()->isFromTrustedProxy(),
        'is_signature_valid' => request()->hasValidSignature(),
        'is_secure' => request()->secure(),
    ]);
})->name('test_signed_url');
