<?php

use App\Http\Controllers\Api\V1\User\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * this the first version of API
 * 
 */
Route::prefix('v1')->group(function () {

    /**
     * The route of registration new user
     */
    Route::post('user', RegisterController::class);
});
