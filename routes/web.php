<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MediaItemController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\MediaProgressController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\Admin\DashboardController;

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
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/catalog', [DashboardController::class, 'catalog'])->name('admin.catalog');

        Route::get('/media-items/{id}/edit', [MediaItemController::class, 'edit'])->name('media_items.edit');
        Route::delete('/media-items/{id}', [MediaItemController::class, 'destroy'])->name('media_items.destroy');
        Route::post('/media-items/update/featured', [MediaItemController::class, 'updateFeatured'])->name('media_items.featured');

        Route::resource('users', UserController::class);
        Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
        Route::delete('/users/{user}/roles/{role}', [UserController::class, 'revokeRole'])->name('users.roles.revoke');

        Route::resource('roles', RoleController::class);
        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

        // Route::resource('permissions', PermissionController::class);
        // Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
        // Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'revokeRole'])->name('permissions.roles.revoke');
    });

    Route::prefix('admin')->middleware(['role:admin|manager'])->group(function () {
        Route::get('/media-items', [MediaItemController::class, 'index'])->name('admin.media_items.index');
        Route::get('/media-items/create', [MediaItemController::class, 'create'])->name('media_items.create');

        // create serie
        Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
        Route::get('/series/create', [SeriesController::class, 'create'])->name('series.create');
        Route::post('/series', [SeriesController::class, 'store'])->name('series.store');

        Route::post('/media-items', [MediaItemController::class, 'store'])->name('media_items.store');
        Route::post('/media-items-upload', [MediaItemController::class, 'uploadMedia'])->name('media_items.files.upload');
        Route::post('/media-items/sort', [MediaItemController::class, 'sort'])->name('media_items.sort');
        Route::resource('categories', CategoryController::class);
    });

    // Route accessible to both admins and users
    Route::middleware(['role:admin|manager|user'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/{slug}', [HomeController::class, 'category'])->name('category');
        Route::get('/media/continue-watching', [HomeController::class, 'continueWatching'])->name('continue-watching');
        Route::post('/media/update-views', [MediaItemController::class, 'updateViews'])->name('media.update-views');
        Route::get('/file/{id}/{filename}', [MediaItemController::class, 'show'])->name('file.show');
        Route::get('/media/{id}/download', [MediaItemController::class, 'download'])->name('media.download');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Media progress
        Route::post('/media-progress', [MediaProgressController::class, 'save'])->name('media.progress');
    });

});


