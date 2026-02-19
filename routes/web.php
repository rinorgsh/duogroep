<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Redirect root to default locale
Route::get('/', function () {
    return redirect('/nl');
});

// Localized routes
Route::prefix('{locale}')
    ->where(['locale' => 'nl|fr|en'])
    ->group(function () {
        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/diensten', [PageController::class, 'services'])->name('services');
        Route::get('/diensten/{slug}', [PageController::class, 'serviceDetail'])->name('service.detail');
        Route::get('/over-ons', [PageController::class, 'about'])->name('about');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::get('/offerte', [PageController::class, 'quote'])->name('quote');
        Route::get('/bedankt', [PageController::class, 'thanks'])->name('thanks');
        Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
        Route::get('/voorwaarden', [PageController::class, 'terms'])->name('terms');

        // Google Ads / Meta Ads landing page
        Route::get('/lp/schoonmaak', [PageController::class, 'landingAds'])->name('landing.ads');

        // Form submissions
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        Route::post('/offerte', [ContactController::class, 'storeQuote'])->name('quote.store');
    });
