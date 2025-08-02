<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ClientController;
use App\Http\Controllers\backend\Auth\LoginController;
use App\Http\Controllers\backend\{ AdminController, HomeController, SkillController, ExperienceController };

// =========  Frontend  =========
Route::get('/', [ClientController::class, 'home'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [LoginController::class, 'showLoginForm']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('adminlogin', [LoginController::class, 'login'])->name('adminlogin');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth:admin', 'redirect_to_dashboard']], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');


        // ========= Start Manage Admins  =========
        Route::controller(AdminController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/adminList',  'adminList')->name('adminList');
                Route::get('/addAdmin',  'addAdmin')->name('addAdmin');
                Route::get('/editAdmin/{token}',  'editAdmin')->name('editAdmin');
                Route::post('/addUpdateAdmin/{token?}',  'addUpdateAdmin')->name('addUpdateAdmin');
                Route::put('/addUpdateAdmin/{token?}',  'addUpdateAdmin')->name('addUpdateAdmin');
                Route::delete('/deleteAdmin/{token}',  'deleteAdmin')->name('deleteAdmin');
            });
        // ========= End Manage Admins  =========

        // ========= Start Manage Skills  =========
        Route::controller(SkillController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/skillList', 'skillList')->name('skillList');
                Route::get('/addSkill', 'addSkill')->name('addSkill');
                Route::get('/editSkill/{token}', 'editSkill')->name('editSkill');
                Route::post('/addUpdateSkill/{token?}', 'addUpdateSkill')->name('addUpdateSkill');
                Route::put('/addUpdateSkill/{token?}', 'addUpdateSkill')->name('addUpdateSkill');
                Route::delete('/deleteSkill/{token}', 'deleteSkill')->name('deleteSkill');
            });
        // ========= End Manage Skills  =========

        // ========= Start Manage Experence  =========
        Route::controller(ExperienceController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/experienceList', 'experienceList')->name('experienceList');
                Route::get('/addExperience', 'addExperience')->name('addExperience');
                Route::get('/editExperience/{token}', 'editExperience')->name('editExperience');
                Route::post('/addUpdateExperience/{token?}', 'addUpdateExperience')->name('addUpdateExperience');
                Route::put('/addUpdateExperience/{token?}', 'addUpdateExperience')->name('addUpdateExperience');
                Route::delete('/deleteExperience/{token}', 'deleteExperience')->name('deleteExperience');
            });
        // ========= End Manage Experence  =========
    });
});
