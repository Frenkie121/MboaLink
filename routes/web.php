<?php

use App\Http\Controllers\Admin\Job\PublishJobController;
use App\Http\Controllers\Admin\Job\SingleJobController;
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
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// FRONT
Route::name('front.')->group(function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::view('about', 'front.pages.about')->name('about');
        Route::view('contact', 'front.pages.contact')->name('contact');
        Route::get('categories', 'categories')->name('categories');
        Route::get('categories/{category:slug}/jobs', 'jobsByCategory')->name('category.jobs');
    });

    Route::controller(JobController::class)->prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{job:slug}', 'show')->name('show');
        Route::post('/search', 'search')->name('search');
    });
});

// ADMIN
Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    // USERS
    Route::prefix('users')->name('users.')->controller(UsersController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::patch('status/{user}', 'updateStatus')->name('status');
    });
    //CATEGORIES
    Route::view('categories', 'admin.categories.index')->name('categories.index');
    //TAGS
    Route::view('tags', 'admin.tags.index')->name('tags.index');
    // SUBCATEGORIES
    Route::view('sub-categories', 'admin.sub-categories.index')->name('sub-categories.index');
    //JOB
    Route::view('jobs', 'admin.jobs.index')->name('jobs.index');
    Route::get('jobs/{job:slug}', SingleJobController::class)->name('job.show');
    Route::patch('publish/{job}', PublishJobController::class)->name('job.publish');
    //CONTACTS
    Route::view('/messages', 'admin.messages.index')->name('messages.index');
});

// GENERAL
Route::get('lang/{locale}', LangController::class)->name('lang');

require __DIR__.'/auth.php';
