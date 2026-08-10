@extends('landing-page.template-4.layouts.app')

@section('title', 'Undangan Pernikahan')

@section('meta')
    @include('landing-page.partials.og-meta')
@endsection

@section('content')
    @include('landing-page.template-4.partials.cover')

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-[#D4AF37]/20 to-transparent -mt-px"></div>

    @include('landing-page.template-4.partials.opening')

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-[#D4AF37]/20 to-transparent -mt-px"></div>

    @include('landing-page.template-4.partials.bride-groom')

    @if ($loveStories && $loveStories->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-[#D4AF37]/20 to-transparent -mt-px"></div>
        @include('landing-page.template-4.partials.love-story')
    @endif

    @if ($events && $events->count() > 0)
        <div class="relative z-10 flex w-full flex-col items-center justify-center py-10 opacity-90">
        <svg width="280" height="30" viewBox="0 0 280 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Center Diamond -->
            <path d="M140 2L146 15L140 28L134 15L140 2Z" fill="#D4AF37" class="animate-pulse"/>
            <!-- Elegant Loops Left -->
            <path d="M120 15 C90 -5, 70 35, 40 15 C25 5, 10 15, 0 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Elegant Loops Right -->
            <path d="M160 15 C190 -5, 210 35, 240 15 C255 5, 270 15, 280 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Accent Diamonds -->
            <path d="M40 13L43 15L40 17L37 15L40 13Z" fill="#D4AF37"/>
            <path d="M240 13L243 15L240 17L237 15L240 13Z" fill="#D4AF37"/>
            <!-- Accent Dots -->
            <circle cx="75" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="205" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="10" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
            <circle cx="270" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
        </svg>
    </div>
        @include('landing-page.template-4.partials.event')
        @include('landing-page.template-4.partials.maps')
    @endif

    @if ($galleries && $galleries->count() > 0)
        <div class="relative z-10 flex w-full flex-col items-center justify-center py-10 opacity-90">
        <svg width="280" height="30" viewBox="0 0 280 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Center Diamond -->
            <path d="M140 2L146 15L140 28L134 15L140 2Z" fill="#D4AF37" class="animate-pulse"/>
            <!-- Elegant Loops Left -->
            <path d="M120 15 C90 -5, 70 35, 40 15 C25 5, 10 15, 0 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Elegant Loops Right -->
            <path d="M160 15 C190 -5, 210 35, 240 15 C255 5, 270 15, 280 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Accent Diamonds -->
            <path d="M40 13L43 15L40 17L37 15L40 13Z" fill="#D4AF37"/>
            <path d="M240 13L243 15L240 17L237 15L240 13Z" fill="#D4AF37"/>
            <!-- Accent Dots -->
            <circle cx="75" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="205" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="10" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
            <circle cx="270" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
        </svg>
    </div>
        @include('landing-page.template-4.partials.gallery')
    @endif

    @if ($gifts && $gifts->count() > 0)
        <div class="relative z-10 flex w-full flex-col items-center justify-center py-10 opacity-90">
        <svg width="280" height="30" viewBox="0 0 280 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Center Diamond -->
            <path d="M140 2L146 15L140 28L134 15L140 2Z" fill="#D4AF37" class="animate-pulse"/>
            <!-- Elegant Loops Left -->
            <path d="M120 15 C90 -5, 70 35, 40 15 C25 5, 10 15, 0 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Elegant Loops Right -->
            <path d="M160 15 C190 -5, 210 35, 240 15 C255 5, 270 15, 280 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Accent Diamonds -->
            <path d="M40 13L43 15L40 17L37 15L40 13Z" fill="#D4AF37"/>
            <path d="M240 13L243 15L240 17L237 15L240 13Z" fill="#D4AF37"/>
            <!-- Accent Dots -->
            <circle cx="75" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="205" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="10" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
            <circle cx="270" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
        </svg>
    </div>
        @include('landing-page.template-4.partials.gift')
    @endif

    @if ($invitation)
        <div class="relative z-10 flex w-full flex-col items-center justify-center py-10 opacity-90">
        <svg width="280" height="30" viewBox="0 0 280 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Center Diamond -->
            <path d="M140 2L146 15L140 28L134 15L140 2Z" fill="#D4AF37" class="animate-pulse"/>
            <!-- Elegant Loops Left -->
            <path d="M120 15 C90 -5, 70 35, 40 15 C25 5, 10 15, 0 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Elegant Loops Right -->
            <path d="M160 15 C190 -5, 210 35, 240 15 C255 5, 270 15, 280 15" stroke="#D4AF37" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.7"/>
            <!-- Accent Diamonds -->
            <path d="M40 13L43 15L40 17L37 15L40 13Z" fill="#D4AF37"/>
            <path d="M240 13L243 15L240 17L237 15L240 13Z" fill="#D4AF37"/>
            <!-- Accent Dots -->
            <circle cx="75" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="205" cy="9" r="1.5" fill="#D4AF37" opacity="0.8"/>
            <circle cx="10" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
            <circle cx="270" cy="15" r="1.5" fill="#D4AF37" opacity="0.5"/>
        </svg>
    </div>
        @include('landing-page.template-4.partials.rsvp')
        @include('landing-page.template-4.partials.wishes')
    @endif

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-[#D4AF37]/20 to-transparent -mt-px"></div>

    @include('landing-page.template-4.partials.footer')

    @include('landing-page.template-4.partials.music')
@endsection
