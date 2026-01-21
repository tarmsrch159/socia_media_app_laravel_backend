<?php

use Inertia\Inertia;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [AuthController::class, 'login'])->name('admin.login');
Route::post('admin/auth', [AuthController::class, 'auth'])->name('admin.auth');

// Admin Protected Routes (ต้อง Login ก่อนถึงเข้าได้)
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::resource('posts', PostController::class, [
        "names" => [
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'store' => 'admin.posts.store',
            'edit' => 'admin.posts.edit',
            'update' => 'admin.posts.update',
            'destroy' => 'admin.posts.destroy',
        ]
    ]);

    Route::resource('users', UserController::class, [
        "names" => [
            'index' => 'admin.users.index',
            'destroy' => 'admin.users.destroy',
        ]
    ]);
});



require __DIR__ . '/settings.php';
