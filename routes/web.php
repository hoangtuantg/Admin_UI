<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashbroadController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SystemEmailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CheckOrderController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ShopController;
use Illuminate\Support\Facades\Artisan;
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



Route::get('/', [DashbroadController::class, 'index'])->name('admin.dashboard');
Route::prefix('/product')->group(function (): void {
    Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/update', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/{id}/delete', [ProductController::class, 'delete'])->name('admin.products.delete');
    Route::get('/{id}', [ProductController::class, 'show'])->name('admin.products.show');
});

Route::prefix('/category')->group(function (): void {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
});

Route::prefix('/post')->group(function (): void {
    Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
    Route::get('/create', [PostController::class, 'create'])->name('admin.post.create');
    Route::post('/store', [PostController::class, 'store'])->name('admin.post.store');
    Route::get('edit', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::put('update', [PostController::class, 'update'])->name('admin.post.update');
    Route::delete('{id}/delete', [PostController::class, 'delete'])->name('admin.post.delete');
    Route::get('/{id}', [PostController::class, 'show'])->name('admin.post.show');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('admin.post.upload-image');
});




Route::prefix('/user')->group(function (): void {
    Route::get('/show', [UserController::class, 'show'])->name('admin.users.profile');
});



