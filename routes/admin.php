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
        Route::patch('/communications/{communication}/status', [CommunicationController::class, 'updateStatus'])->name('communications.status');
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
        Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');

        Route::get('/services', [ServiceController::class, 'index'])->name('services');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

        Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::patch('/projects/{project}/featured', [ProjectController::class, 'toggleFeatured'])->name('projects.featured');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies');
        Route::get('/case-studies/create', [CaseStudyController::class, 'create'])->name('case-studies.create');
        Route::post('/case-studies', [CaseStudyController::class, 'store'])->name('case-studies.store');
        Route::get('/case-studies/{case_study}/edit', [CaseStudyController::class, 'edit'])->name('case-studies.edit');
        Route::put('/case-studies/{case_study}', [CaseStudyController::class, 'update'])->name('case-studies.update');
        Route::delete('/case-studies/{case_study}', [CaseStudyController::class, 'destroy'])->name('case-studies.destroy');

        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{blog_post}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{blog_post}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{blog_post}', [BlogController::class, 'destroy'])->name('blog.destroy');

        Route::get('/legal', [LegalController::class, 'index'])->name('legal');
        Route::get('/legal/{legal_page:slug}/edit', [LegalController::class, 'edit'])->name('legal.edit');
        Route::put('/legal/{legal_page:slug}', [LegalController::class, 'update'])->name('legal.update');

        Route::get('/changelog', [ChangelogController::class, 'index'])->name('changelog');
        Route::get('/changelog/create', [ChangelogController::class, 'create'])->name('changelog.create');
        Route::post('/changelog', [ChangelogController::class, 'store'])->name('changelog.store');
        Route::get('/changelog/{changelog_entry}/edit', [ChangelogController::class, 'edit'])->name('changelog.edit');
        Route::put('/changelog/{changelog_entry}', [ChangelogController::class, 'update'])->name('changelog.update');
        Route::delete('/changelog/{changelog_entry}', [ChangelogController::class, 'destroy'])->name('changelog.destroy');

        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});
