<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('unauthorized')->get('401', function () {
    return response()->json(['error' => 'Unauthorized'],401);
});
Route::name('jwt.')->group(function () {
    Route::name('authorize')->post('/authorize', '\App\Http\Controllers\JwtController@createAuthorizationToken');
    Route::name('refresh')->post('/refresh', '\App\Http\Controllers\JwtController@createAuthorizationTokenFromRefresh');
    Route::middleware('auth')
        ->resource(
            '/products',
            '\App\Http\Controllers\ProductController')
        ->only(['show','index','destroy','store','update']);
});