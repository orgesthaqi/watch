<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Models\User;

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


Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {

    // Route accessible only to admins
    Route::middleware([CheckRole::class . ':' . User::ROLE_ADMIN])->group(function () {
        Route::get('/media-items', [App\Http\Controllers\MediaItemController::class, 'index'])->name('media_items.index');
        Route::get('/media-items/create', [App\Http\Controllers\MediaItemController::class, 'create'])->name('media_items.create');
        Route::post('/media-items', [App\Http\Controllers\MediaItemController::class, 'store'])->name('media_items.store');
        Route::post('/media-items-upload', [App\Http\Controllers\MediaItemController::class, 'uploadMedia'])->name('media_items.files.upload');
        Route::delete('/media-items/{id}', [App\Http\Controllers\MediaItemController::class, 'destroy'])->name('media_items.destroy');

        Route::resource('users', App\Http\Controllers\UserController::class);
    });

    // Route accessible to both admins and users
    Route::middleware([CheckRole::class . ':' . User::ROLE_ADMIN . ',' . User::ROLE_USER])->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/file/{id}/{filename}', [App\Http\Controllers\MediaItemController::class, 'show'])->name('file.show');

        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    });

});
