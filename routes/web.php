<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Extra\LangController;
use App\Http\Controllers\Extra\ImageController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Livewire\Admin\Subscription\EditComponent;
use App\Http\Controllers\Admin\StatisticsDataController;
use App\Http\Controllers\Admin\Job\{PublishJobController, SingleJobController};
use App\Http\Controllers\Front\{JobController, PagesController, SubscriptionController};
use App\Http\Livewire\Front\Subscriber\{AccountStatus, ListApplications, ListJobs, ListSubscriptions, UpdatePassword, UpdateProfile};
use App\Http\Controllers\Admin\{ SubscribersController, SubscriptionBackController};

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
        Route::get('categories/{category:slug}/jobs', 'jobsByCategory')->name('category.jobs')->middleware('auth');
    });

    // JOBS
    Route::controller(JobController::class)->middleware('auth')->prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{job:slug}', 'show')->name('show');
        Route::post('/search', 'search')->name('search');
    });

    // SUBSCRIPTIONS
    Route::controller(SubscriptionController::class)->prefix('pricing')->name('subscriptions.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('{subscription:slug}/subscribe', 'subscribe')->name('subscribe');
        Route::middleware(['auth', 'role:6'])->group(function () {
            Route::get('/renew-subscription', 'showRenewPage')->name('renew-show');
            Route::post('/renew-subscription', 'renew')->name('renew');
        });
    });

    // SUBSCRIBER PROFILE
    Route::middleware(['auth', 'role:2,3,4,5'])->prefix('me')->name('subscriber.')->group(function () {
        Route::get('', UpdateProfile::class)->name('profile');
        Route::get('password', UpdatePassword::class)->name('password');
        Route::get('my-jobs', ListJobs::class)->name('jobs');
        Route::get('my-jobs/{job:slug}/applications', ListApplications::class)->name('job.applications');
        Route::get('my-subscriptions', ListSubscriptions::class)->name('subscriptions');
        Route::get('account-status', AccountStatus::class)->name('status');
    });
});

// ADMIN
Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
   Route::get('dashboard', [StatisticsDataController::class,'graph'] )->name('dashboard');
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
    //JOBS
    Route::view('jobs', 'admin.jobs.index')->name('jobs.index');
    Route::controller(SingleJobController::class)->prefix('jobs')->name('job.')->group(function () {
        Route::get('{job:slug}', 'show')->name('show');
        Route::get('{job:slug}/download', 'download')->name('download');
        Route::get('{job:slug}/applicants', 'listApplicants')->name('applicants');
    });

    //CONTACTS
    Route::view('contacts', 'admin.contacts.index')->name('contacts.index');
    //SUBSCRIPTION
    Route::view('subscriptions', 'admin.subscriptions.index')->name('subscription.index');
    Route::get('subscription/edit/{subscription:slug}', EditComponent::class)->name('subscription.edit');
    Route::patch('subscription/update/{id}', [SubscriptionBackController::class, 'update'])->name('subscription.update');
    Route::view('subscription/create', 'admin.subscriptions.add')->name('subscription.add');


    // Newsletter
    Route::view('newsletters', 'admin.newsletters.index')->name('newsletters.add');

    Route::prefix('subscribers')->name('subscribers.')->controller(SubscribersController::class)->group(function () {
        Route::get('/talents', 'indexTalent')->name('talent.index');
        Route::get('/companies', 'indexCompany')->name('company.index');
        // Route::get('/{user}', 'show')->name('profile');
        Route::get('/validate/{id}', 'active')->name('validate');
        Route::get('/{user}/cv', 'download')->name('download');
        Route::get('/{user}/jobs', 'listJobs')->name('jobs');
    });

    Route::get('subscribers/{user}', [SubscribersController::class, 'show'])->name('subscribers.profile');

});

// GENERAL
Route::get('lang/{locale}', LangController::class)->name('lang');
Route::get('company-logo/{filename}', ImageController::class)->name('company-logo');

require __DIR__ . '/auth.php';
