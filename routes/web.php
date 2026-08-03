<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::view('/', 'admin.dashboard.index')->name('dashboard');
        
        Route::name('admin.')->group(function () {
            Route::view('invitation', 'admin.invitation.index')->name('invitation');
            Route::view('bride-groom', 'admin.bride-groom.index')->name('bride-groom');
            Route::view('love-story', 'admin.love-story.index')->name('love-story');
            Route::view('events', 'admin.event.index')->name('events');
            Route::view('gallery', 'admin.gallery.index')->name('gallery');
            Route::view('gifts', 'admin.gift.index')->name('gifts');
            Route::view('guest-lists', 'admin.guest-list.index')->name('guest-lists');
            Route::view('rsvps', 'admin.rsvp.index')->name('rsvps');
            Route::view('wa-configs', 'admin.wa-config.index')->name('wa-configs');
        });
    });
});

require __DIR__.'/settings.php';
