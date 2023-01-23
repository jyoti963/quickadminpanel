<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\CkImageUploadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Setting
    Route::post('settings/media', [SettingController::class, 'storeMedia'])->name('settings.storeMedia');
    Route::resource('settings', SettingController::class, ['except' => ['store', 'update', 'destroy', 'create', 'show']]);

    // Gallery
    Route::post('galleries/media', [GalleryController::class, 'storeMedia'])->name('galleries.storeMedia');
    Route::resource('galleries', GalleryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']]);

    // Country
    Route::post('countries/media', [CountryController::class, 'storeMedia'])->name('countries.storeMedia');
    Route::resource('countries', CountryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Department
    Route::resource('departments', DepartmentController::class, ['except' => ['store', 'update', 'destroy']]);

    // Employee
    Route::post('employees/media', [EmployeeController::class, 'storeMedia'])->name('employees.storeMedia');
    Route::resource('employees', EmployeeController::class, ['except' => ['store', 'update', 'destroy']]);

    // Blog
    Route::resource('blogs', BlogController::class, ['except' => ['store', 'update', 'destroy']]);

    //CK-Editor
    Route::post('image-upload', [CkImageUploadController::class, 'storeImage'])->name('ckImage');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
