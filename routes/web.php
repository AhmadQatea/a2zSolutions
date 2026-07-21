<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\ChangelogController;
use App\Http\Controllers\Admin\CommunicationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LegalController as AdminLegalController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\KnowledgeController;
use App\Http\Controllers\Web\LegalController;
use App\Http\Controllers\Web\ProjectsController;
use App\Http\Controllers\Web\QuoteController;
use App\Http\Controllers\Web\ServicesController;
use App\Http\Controllers\Web\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::post('/projects/quote', [QuoteController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('projects.quote.store');
Route::get('/knowledge', [KnowledgeController::class, 'index'])->name('knowledge');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
Route::post('/contact/booking', [ContactController::class, 'storeBooking'])
    ->middleware('throttle:5,1')
    ->name('contact.booking.store');
Route::get('/legal/{slug}', [LegalController::class, 'show'])->name('legal.show');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

require __DIR__.'/admin.php';
