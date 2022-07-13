<?php

use App\Http\Controllers\Api\V1\Auth\ChangePasswordController;
use App\Http\Controllers\Api\V1\Auth\CodeCheckController;
use App\Http\Controllers\Api\V1\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\V1\Auth\GenerateTokenController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
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
     *  The route of registering a new user
     * 
     */
    Route::post('user', RegisterController::class);

    /**
     * The route of login
     * 
     */
    Route::post('user/login', LoginController::class);

    /**
     * The route Of reseting user password 
     * 
     */
    Route::post('user/password/forget', ForgetPasswordController::class);

    /**
     * The route Of checking the code which has been sent 
     * 
     */
    Route::post('user/password/check-code', CodeCheckController::class);

    /**
     * The route Of checking the code which has been sent 
     * 
     */
    Route::post('user/password/reset', ResetPasswordController::class);

    /**
     * Users with one of these abilities can have access to the group of routes
     * 
     */
    Route::middleware(['auth:sanctum', 'ability:user-unconfirmed,user-confirmed'])->group(function () {

        /**
         * The route of generating a new access token
         * 
         */
        Route::get('user/generate-token', GenerateTokenController::class);

        /**
         * The route of logout
         * 
         */
        Route::post('user/logout', LogoutController::class);

        /**
         * The route of Changing password
         * 
         */
        Route::post('user/password/change', ChangePasswordController::class);
    });
});
