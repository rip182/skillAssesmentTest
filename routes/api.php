<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
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
// Public Routes
Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{id}',[PostController::class,'show']);
Route::post('/register',[AuthenticationController::class,'register']);
Route::post('/login',[AuthenticationController::class,'login']);


//Protected routes 
Route::middleware(['auth:sanctum'])->group(function () {

    
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::group(['middleware' => ['role:admin|writer']], function () {
        Route::post('/posts',[PostController::class,'store']);
        Route::put('/posts/{id}',[PostController::class,'update']);
    });
        
    Route::group(['middleware' => ['role:admin']], function () {
        Route::delete('/posts/{id}', [PostController::class,'destroy']);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});