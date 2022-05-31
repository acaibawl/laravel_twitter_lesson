<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

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

Route::get('/auth/twitter', [LoginController::class, 'redirectToProvider'])->name('auth.login');
Route::get('/oauth_callback', [LoginController::class, 'handleProviderCallback']);
Route::get('/auth/twitter/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('/twitter/postHelloWorld', [TweetController::class, 'tweet'])->name('tweet');
