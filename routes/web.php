<?php

use App\Http\Controllers\Admin\publishController;
use App\Http\Controllers\Admin\SingleJobController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Extra\LangController;
use App\Http\Controllers\Front\JobController;
use App\Http\Controllers\Front\PagesController;
use App\Http\Controllers\ProfileController;
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

// PROFILE
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// FRONT
Route::name('front.')->group(function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('/', 'home')->name('home');
    });

    Route::controller(JobController::class)->prefix('jobs')->name('jobs.')->group(function () {
        Route::get('categories', 'categories')->name('categories');
        Route::get('/', 'index')->name('index');
        Route::get('/post', 'create')->name('create');
        Route::get('/{job:slug}', 'show')->name('show');
    });
});

// ADMIN
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    // USERS
    Route::prefix('users')->name('users.')->controller(UsersController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::patch('status/{user}', 'updateStatus')->name('status');
    });
    Route::view('categories', 'admin.categories.index')->name('categories.index');
    Route::view('tags', 'admin.tags.index')->name('tags.index');
    Route::view('jobs', 'admin.jobs.index')->name('jobs.index');
    // SUBCATEGORIES
    Route::view('sub-categories', 'admin.sub-categories.index')->name('sub-categories.index');
    Route::get('jobs/{job:slug}', SingleJobController::class)->name('job.show');
    Route::get('publish/{job:slug}', publishController::class)->name('job.publish');
});

// GENERAL
Route::get('lang/{locale}', LangController::class)->name('lang');

require __DIR__.'/auth.php';
