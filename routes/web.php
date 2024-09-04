<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\User\PostController as AdminUserPostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['prefix' => '/user', 'as' => 'user.', 'middleware' => ['auth', 'verified']], function() {
    Route::get('/dashboard', function () {
        return Inertia::render('User/Dashboard');
    })->name('dashboard');
    Route::resource('posts', PostController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {

    //users routes
    Route::group(['prefix' => '/users', 'as' => 'users.'], function() {

        //user posts routes
        Route::group(['prefix' => '/posts', 'as' => 'posts.'], function() {
            Route::get('/', [AdminUserPostController::class, 'index'])->name('index');
            Route::post('/update-status/{post}', [AdminUserPostController::class, 'updateStatus'])->name('update-status');
            Route::get('/{post}', [AdminUserPostController::class, 'show'])->name('show');
        });
    });

    //Notifications
    Route::post('/notifications/{id}/read', [NotificationsController::class, 'markAsRead'])->name('notifications.read');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
});

require __DIR__.'/auth.php';
