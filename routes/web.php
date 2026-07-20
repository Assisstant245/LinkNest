<?php

use App\Http\Controllers\LinkClickController;
use App\Http\Controllers\PublicPageController;
use App\Livewire\Analytics\Dashboard as AnalyticsDashboard;
use App\Livewire\Billing\Plans as BillingPlans;
use App\Livewire\Builder\Editor;
use App\Livewire\Pages\Index as PagesIndex;
use App\Livewire\Templates\Gallery;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('builder');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/builder', Editor::class)->name('builder');
    Route::get('/analytics', AnalyticsDashboard::class)->name('analytics');

    Route::get('/billing', BillingPlans::class)->name('billing');
    Route::get('/billing/success', function () {
        return redirect()->route('billing')->with('status', "You're now on the Pro plan!");
    })->name('billing.success');
    Route::get('/billing/cancel', function () {
        return redirect()->route('billing')->with('status', 'Checkout cancelled — you were not charged.');
    })->name('billing.cancel');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', PagesIndex::class)->name('dashboard');
    Route::get('/pages', PagesIndex::class)->name('pages');
});

Route::view('/profile', 'profile')->middleware(['auth'])->name('profile');

Route::post('/logout', function () {
    app(\App\Livewire\Actions\Logout::class)();

    return redirect('/');
})->middleware(['auth'])->name('logout');

Route::get('/templates', Gallery::class)->name('templates');

Route::get('/go/{uuid}', [LinkClickController::class, 'redirect'])
    ->name('link.redirect')
    ->where('uuid', '[0-9a-fA-F-]{36}');

require __DIR__.'/auth.php';

// Catch-all public page route — must stay last.
Route::get('/{slug}', [PublicPageController::class, 'show'])
    ->name('public.page')
    ->where('slug', '[a-z0-9\-]+');
