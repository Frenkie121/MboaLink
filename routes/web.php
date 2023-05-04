<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Front\Subscriptions;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\JobController;
use App\Http\Controllers\Extra\LangController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Front\PagesController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Front\SubscriptionController;
use App\Http\Controllers\Admin\Job\SingleJobController;
use App\Http\Livewire\Admin\Subscription\EditComponent;
use App\Http\Controllers\Admin\Job\PublishJobController;
use App\Http\Controllers\Admin\SubscriptionBackController;

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

    // JOBS
    Route::controller(JobController::class)->prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create')->middleware('auth');
        Route::get('/{job:slug}', 'show')->name('show');
        Route::post('/search', 'search')->name('search');
    });

    // SUBSCRIPTIONS
    Route::controller(SubscriptionController::class)->prefix('pricing')->name('subscriptions.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{subscription:slug}/subscribe', 'subscribe')->name('subscribe');
    });
});

// ADMIN
Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', StatisticsController::class)->name('dashboard');
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
    Route::view('contacts', 'admin.contacts.index')->name('contacts.index');
    //SUBSCRIPTION
    Route::view('subscriptions', 'admin.subscriptions.index')->name('subscription.index');
    Route::get('subscription/edit/{subscription:slug}', EditComponent::class)->name('subscription.edit');
    Route::patch('subscription/update/{id}', [SubscriptionBackController::class, 'update'])->name('subscription.update');
    Route::view('subscription/create', 'admin.subscriptions.add')->name('subscription.add');

    // Newsletter
    Route::view('newsletters', 'admin.newsletters.index')->name('newsletters.add');


    Route::get('subscribers/talents', [SubscribersController::class, 'indexTalent'])->name('subscribers.talent.index');
    Route::get('subscribers/companies', [SubscribersController::class, 'indexCompany'])->name('subscribers.company.index');
    Route::get('subscriber/{user}', [SubscribersController::class, 'show'])->name('subscribers.profile');
    Route::get('subscriber/validate/{subscriber}', [SubscribersController::class, 'Active'])->name('subscribers.validate');
});

// GENERAL
Route::get('lang/{locale}', LangController::class)->name('lang');

require __DIR__ . '/auth.php';
