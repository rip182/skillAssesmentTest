<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\AuthenticationController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Socilialite
Route::get('/auth/github',[AuthenticationController::class,'loginGihub']);
Route::get('/auth/github/callback',[AuthenticationController::class,'githubCallback']);

//Chat Routes
Route::get('/chat', [ChatsController::class,'index']);
Route::get('/chat/messages', [ChatsController::class, 'fetchMessages']);
Route::post('/chat/messages', [ChatsController::class, 'sendMessage']);