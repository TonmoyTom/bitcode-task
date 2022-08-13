<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('apiRules')->prefix('v1')
    ->group(function () {
        Route::post('registration', [\App\Http\Controllers\Api\V1\AuthController::class, 'registration']);
        Route::post('login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);

        Route::middleware('auth:sanctum')
            ->group(function () {
                // Auth User
                Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
                Route::get('profile', [\App\Http\Controllers\Api\V1\AuthController::class, 'profile']);
                // ShortLink
                Route::resource('shorten-link-generate', \App\Http\Controllers\Api\V1\ShortLinkController::class);
                Route::get('{code}', [\App\Http\Controllers\Api\V1\ShortLinkController::class , 'link'])->name('shorten.link');
            });
    });

