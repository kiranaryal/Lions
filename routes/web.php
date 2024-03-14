<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])
->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/news', [App\Http\Controllers\HomeController::class, 'news'])->name('news');

    Route::get('/profile/{user:id}', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');


    Route::get('/business/{user:id}', [App\Http\Controllers\BusinessProfileController::class, 'business_profile'])->name('business_profile');
    Route::get('/businessProfile/{business:id}', [App\Http\Controllers\BusinessProfileController::class, 'business_show'])->name('business_show');

});
