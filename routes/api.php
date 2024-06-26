<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route::post('/register', function (Request $request) {
    //     return response()->json(['message' => 'Welcome to the API']);
    // });
    Route::get('profile/{user_id}', [App\Http\Controllers\Api\ProfileController::class, 'show']);
    Route::get('news', [App\Http\Controllers\Api\NewsController::class, 'showNews']);
    Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('/search', [App\Http\Controllers\Api\SearchController::class, 'search']);

Route::post('/register',[App\Http\Controllers\Api\AuthController::class, 'register']);

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout',[App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::put('/user/update-profile/{userId}', [App\Http\Controllers\Api\UserController::class, 'update']);
    Route::get('/user/profile/{userId}', [App\Http\Controllers\Api\UserController::class, 'getUserProfile']);


    

    Route::put('profile', [App\Http\Controllers\Api\ProfileController::class, 'update']);
    Route::post('profile/upload-photo', [App\Http\Controllers\Api\ProfileController::class, 'uploadPhoto']);
    Route::get('profile', [App\Http\Controllers\Api\ProfileController::class, 'show']);


    Route::post('profile/{profile_id}/extras', [App\Http\Controllers\Api\ProfileController::class, 'addProfileExtra']);
    Route::put('profile/extras/update/{extra_id}', [App\Http\Controllers\Api\ProfileController::class, 'updateProfileExtra']);
    Route::delete('profile/extras/{extra_id}', [App\Http\Controllers\Api\ProfileController::class, 'deleteProfileExtra']);

    Route::get('/profile-business', [App\Http\Controllers\Api\BusinessController::class, 'getBusiness']);

    Route::post('business-profiles', [App\Http\Controllers\Api\BusinessController::class, 'store']);
    Route::put('/business-profiles/{id}', [App\Http\Controllers\Api\BusinessController::class, 'update']);
    Route::delete('/business-profiles/{id}', [App\Http\Controllers\Api\BusinessController::class, 'destroy']);
    Route::put('/business-profiles/{id}/toggle-status', [App\Http\Controllers\Api\BusinessController::class, 'toggleStatus']);
    Route::put('/business-profiles/{profile_id}/categories', [App\Http\Controllers\Api\BusinessController::class, 'updateCategories']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
