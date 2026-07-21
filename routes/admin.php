<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\ChangelogController;
use App\Http\Controllers\Admin\CommunicationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LegalController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function (): void {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/communications', [CommunicationController::class, 'index'])->name('communications');
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
        Route::get('/services', [ServiceController::class, 'index'])->name('services');
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
        Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies');
        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/legal', [LegalController::class, 'index'])->name('legal');
        Route::get('/changelog', [ChangelogController::class, 'index'])->name('changelog');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    });
});
