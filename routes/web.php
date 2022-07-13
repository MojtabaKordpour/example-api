<?php

use App\Http\Controllers\Front\User\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/** 
 * The url of email's verification
 * 
 */

Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)->name('verification.verify');
