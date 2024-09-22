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

// Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('post.upload-image');
Route::prefix('')->group(function (): void {
    // Route::get('/', fn () => view('client.pages.index'))->name('todo.home');
    Route::get('/', [ShopController::class, 'home'])->name('todo.home');
    Route::get('/danh-sach-san-pham', [ShopController::class, 'index'])->name('todo.collection');
    Route::get('/san-pham/{slug}', [ShopController::class, 'show'])->name('client.product.details');
    Route::get('/product/{id}/quickview', [ShopController::class, 'quickView'])->name('product.quickview');
    Route::get('/bai-viet', [ShopController::class, 'blog'])->name('client.blog');
    Route::get('/bai-viet/{slug}', [ShopController::class, 'detailBlog'])->name('client.blog.detail');
    Route::get('contact', fn () => view('client.pages.contact'))->name('todo.contact');

    Route::prefix('/dat-hang')->group(function (): void {
        Route::get('/', [CheckoutController::class, 'index'])->name('todo.checkout');
        Route::get('/dat-hang-thanh-cong/{slug}', [CheckoutController::class, 'success'])->name('todo.checkout.success');
    });

    Route::get('kiem-tra-don-hang/{phone?}', [CheckOrderController::class,'index'])->name('todo.checkorder');
    Route::get('chi-tiet-don-hang/{slug}', [CheckOrderController::class,'orderDetail'])->name('todo.orderdetail');
});


// Route::get('/product', fn () => view('client.pages.product'))->name('todo.product');

Route::get('gio-hang', fn () => view('client.pages.cart'))->name('todo.cart');
//Route::get('article', fn () => view('client.pages.article'))->name('todo.article');

Route::get('link-storage', function (): void {
    $targetFolder = storage_path('app/public');
    $link = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $link);
});

Route::get('/linkstorage', function (): void {
    Artisan::call('storage:link');
});

// Clear application cache:
Route::get('/op-cache', function () {
    Artisan::call('optimize:clear');

    return 'Application op cache has been cleared';
});

// Clear application cache:
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');

    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function () {
    Artisan::call('route:cache');

    return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('/config-cache', function () {
    Artisan::call('config:cache');

    return 'Config cache has been cleared';
});

// Clear view cache:
Route::get('/view-clear', function () {
    Artisan::call('view:clear');

    return 'View cache has been cleared';
});

Route::prefix('login')->group(function (): void {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/post', [AuthController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordShow'])->name('reset-password');
});


Route::prefix('admin')->middleware('auth')->group(function (): void {
    Route::get('/', [DashbroadController::class, 'index'])->name('admin.dashboard');
    Route::prefix('/product')->group(function (): void {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('admin.products.update');
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
    Route::prefix('/order')->group(function (): void {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/pending', [OrderController::class, 'indexPending'])->name('admin.orders.pending.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    });

    Route::prefix('/user')->group(function (): void {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('admin.users.profile');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::get('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');
    });

    Route::prefix('/system-email')->group(function (): void {
        Route::get('/', [SystemEmailController::class, 'index'])->name('admin.system-email.index');
        Route::get('/create', [SystemEmailController::class, 'create'])->name('admin.system-email.create');
        Route::get('/edit/{id}', [SystemEmailController::class, 'edit'])->name('admin.system-email.edit');
    });
});

Route::get('/product', fn () => view('client.pages.product_template'))->name('todo.product');
