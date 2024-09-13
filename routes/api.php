<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// ================== Handle Blog API ================= //
Route::get('/blog',[BlogController::class,'index']);
Route::get('/blog/{id}',[BlogController::class,'showBlogDetail']);
Route::get('/ratings',[RatingController::class,'index']);
Route::put('/ratings/id',[RatingController::class,'updateRating']);
// ======== Tách endpoint ra lâu hơn -.- ========== //
// Route::get('/blog/{id}/comments',[CommentController::class,'index']);

// ================== Handle Authentication =================== //
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);


Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/account',[AccountController::class,'index']);
    Route::put('/account',[AccountController::class,'update']);
    Route::post('/blog-detail/{id}',[CommentController::class,'createComment']);
    Route::put('/comment/update/{id}',[CommentController::class,'updateComment']);
    Route::delete('/comment/delete/{id}',[CommentController::class,'destroy']);
    Route::delete('ratings/delete/{id}',[RatingController::class,'destroy']);
});


