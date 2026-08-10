<?php

use App\Models\Invitation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $invitation = Invitation::query()->first();

    $bride = $invitation?->brideGrooms()->where('type', 'bride')->first();
    $groom = $invitation?->brideGrooms()->where('type', 'groom')->first();
    $mainEvent = $invitation?->events()
        ->orderByDesc('is_main_event')
        ->orderBy('event_date')
        ->first();

    $loveStories = $invitation?->loveStories()->orderBy('sort_order')->get();
    $events = $invitation?->events()->orderByDesc('is_main_event')->orderBy('event_date')->orderBy('start_time')->get();
    $galleries = $invitation?->galleries()->orderBy('sort_order')->get();
    $gifts = $invitation?->gifts()->get();

    $theme = request()->query('template') ?? $invitation->theme ?? 'template-1';

    return view('landing-page.'.$theme.'.index', [
        'invitation' => $invitation,
        'bride' => $bride,
        'groom' => $groom,
        'mainEvent' => $mainEvent,
        'loveStories' => $loveStories,
        'events' => $events,
        'galleries' => $galleries,
        'gifts' => $gifts,
        'to' => request()->query('to'),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::view('/', 'admin.dashboard.index')->name('dashboard');

        Route::name('admin.')->group(function () {
            Route::livewire('invitation', 'pages::admin.invitation')->name('invitation');
            Route::livewire('bride-groom', 'pages::admin.bride-groom')->name('bride-groom');
            Route::livewire('love-story', 'pages::admin.love-story')->name('love-story');
            Route::livewire('events', 'pages::admin.events')->name('events');
            Route::livewire('gallery', 'pages::admin.gallery')->name('gallery');
            Route::livewire('gifts', 'pages::admin.gifts')->name('gifts');
            Route::livewire('guest-lists', 'pages::admin.guest-lists')->name('guest-lists');
            Route::livewire('rsvps', 'pages::admin.rsvps')->name('rsvps');
            Route::livewire('wa-configs', 'pages::admin.wa-configs')->name('wa-configs');
        });
    });
});

require __DIR__.'/settings.php';
