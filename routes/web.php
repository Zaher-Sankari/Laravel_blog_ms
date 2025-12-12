<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\FrontUserController;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [FrontUserController::class, 'index'])
    ->name('home');

Route::get('/blog/{id}', [FrontUserController::class, 'show'])
    ->name('blogs.show');

Route::get('/category/{id}', [FrontUserController::class, 'filterByCategory'])
    ->name('blogs.category');

Route::get('/dashboard', [UserController::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('admin/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [FavoriteController::class, 'index'])->name('dashboard');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{blog}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{blog}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::get('blog/trashed', [BlogController::class, 'trashed'])->name('blog.trashed');
    Route::get('blog/{id}/restore', [BlogController::class, 'restore'])->name('blog.restore');
    Route::delete('blog/{id}/force-delete', [BlogController::class, 'forceDelete'])->name('blog.forceDelete');
    Route::resource('blog', BlogController::class);
});
require __DIR__ . '/auth.php';