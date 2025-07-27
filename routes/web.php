<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ClientController;
use App\Http\Controllers\backend\Auth\LoginController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\HomeController;

// =========  Frontend  =========
Route::get('/', [ClientController::class, 'home'])->name('home');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', [LoginController::class, 'showLoginForm']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('adminlogin', [LoginController::class, 'login'])->name('adminlogin');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth:admin', 'redirect_to_dashboard']], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

        // =========  Manage Admins  =========
        Route::get('/adminList', [AdminController::class, 'adminList'])->name('adminList');
        Route::get('/addAdmin', [AdminController::class, 'addAdmin'])->name('addAdmin');
        Route::get('/editAdmin/{token}', [AdminController::class, 'editAdmin'])->name('editAdmin');
        Route::post('/addUpdateAdmin/{token?}', [AdminController::class, 'addUpdateAdmin'])->name('addUpdateAdmin');
        Route::put('/addUpdateAdmin/{token?}', [AdminController::class, 'addUpdateAdmin'])->name('addUpdateAdmin');
        Route::delete('/deleteAdmin/{token}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');
        // =========  Manage Admins  =========
    });
});
