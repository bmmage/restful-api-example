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

Route::name('jwt.')->group(function () {
    Route::name('authorize')->post('/authorize', '\App\Http\Controllers\JwtController@createAuthorizationToken');
    Route::middleware('auth')->group(function () {
        Route::resource(
            '/products',
            '\App\Http\Controllers\ProductController')
            ->only(['show', 'index', 'destroy', 'store', 'update']);
        Route::resource(
            '/user/{userId}/products',
            '\App\Http\Controllers\UserProductController')
            ->only(['show', 'index', 'destroy', 'store']);
    });
});