<?php

use App\Livewire\Community\Bills;
use App\Livewire\Community\Home;
use App\Livewire\Community\Profile;
use App\Livewire\Community\Requests;
use App\Livewire\Community\Feedback;
use App\Livewire\Community\Visitors;
use Illuminate\Support\Facades\Route;
use App\Livewire\Community\Bills\PayAssociationDue;

Route::get('/', fn() => view('landing'));
// Route::get('/', fn() => redirect('/app/login'));


Route::get('/bills/dues/{associationDue}/pay', PayAssociationDue::class)->name('bills.dues.pay');


Route::prefix('app')->name('community.')->group(function () {
    // Guest routes (handled by CommunityPanelProvider Filament login)
    // Auth routes below
    Route::middleware(['auth'])->group(function () {
        Route::redirect('/', '/app/home');
        Route::get('/home',     Home::class)->name('home');
        Route::get('/bills',    Bills::class)->name('bills');
        Route::get('/feedback', Feedback::class)->name('feedback');
        // Route::get('/requests', Requests::class)->name('requests');
        Route::get('/visitors', Visitors::class)->name('visitors');
        Route::get('/profile',  Profile::class)->name('profile');
    });
});
