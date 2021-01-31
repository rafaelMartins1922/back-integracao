<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\PassportController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});





Route::put('login',[PassportController::class,'login']);
Route::post('register',[PassportController::class,'register']);
Route::get('users',[UserController::class,'index']);
Route::get('users/{id}',[UserController::class,'show']);

Route::get('books',[BookController::class,'index']);
Route::get('books/{id}',[BookController::class,'show']);

Route::get('comments',[CommentController::class,'index']);
Route::get('comments/{id}',[CommentController::class,'show']);  

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('getDetails',[PassportController::class,'getDetails']);

    Route::post('comments',[CommentController::class,'create']);

    Route::put('comments/{id}',[CommentController::class,'update']);
    Route::delete('comments',[CommentController::class,'destroy']);

    Route::post('books',[BookController::class,'create']);

    Route::put('books/{id}',[BookController::class,'update']);
    Route::delete('books',[BookController::class,'destroy']);

    Route::put('users/{id}',[UserController::class,'update']);
    Route::delete('users/{id}',[UserController::class,'destroy']);

    Route::put('sellBook/{id}',[BookController::class,'sell']);
    Route::put('rateBook/{id}',[BookController::class,'rate']);
    
    Route::get('mostSoldBooks',[BookController::class,'mostSold']);
    Route::get('mostWellRatedBooks',[BookController::class,'mostWellRated']);
});
