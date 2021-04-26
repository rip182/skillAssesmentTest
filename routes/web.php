<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\ProductController;
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




//Socilialite
Route::get('/auth/github',[AuthenticationController::class,'loginGithub']);
Route::get('/auth/github/callback',[AuthenticationController::class,'githubCallback']);

//Chat Routes
Route::get('/chat', [ChatsController::class,'index']);
Route::get('/chat/messages', [ChatsController::class, 'fetchMessages']);
Route::post('/chat/messages', [ChatsController::class, 'sendMessage']);

//Email routes

Route::get('/email/verify', [EmailVerifyController::class,'notice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class,'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/email/verification-notification', [EmailVerifyController::class,'verifySend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

 // Only verified users may access this route...

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');;
    

 Auth::routes(['verify'=> true]);


Route::resource('products', ProductController::class);