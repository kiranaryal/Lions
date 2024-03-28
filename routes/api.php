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



Route::post('/register',[App\Http\Controllers\Api\AuthController::class, 'register']);

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout',[App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::put('/user/update-profile', [App\Http\Controllers\Api\UserController::class, 'update']);

    Route::put('profile/{user_id}', [App\Http\Controllers\Api\ProfileController::class, 'update']);
    Route::post('profile/{user_id}/upload-photo', [App\Http\Controllers\Api\ProfileController::class, 'uploadPhoto']);

    Route::post('profile/{profile_id}/extras', [App\Http\Controllers\Api\ProfileController::class, 'addProfileExtra']);
    Route::put('profile/extras/update/{extra_id}', [App\Http\Controllers\Api\ProfileController::class, 'updateProfileExtra']);

    Route::delete('profile/extras/{extra_id}', [App\Http\Controllers\Api\ProfileController::class, 'deleteProfileExtra']);


});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
