@extends('landing-page.layouts.app')

@section('title', 'Undangan Pernikahan')

@section('content')
    @include('landing-page.partials.cover')

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>

    @include('landing-page.partials.opening')

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>

    @include('landing-page.partials.bride-groom')

    @if ($loveStories && $loveStories->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.partials.love-story')
    @endif

    @if ($events && $events->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.partials.event')
        @include('landing-page.partials.maps')
    @endif

    @if ($galleries && $galleries->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.partials.gallery')
    @endif

    @if ($gifts && $gifts->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.partials.gift')
    @endif

    @if ($invitation)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.partials.rsvp')
        @include('landing-page.partials.wishes')
    @endif

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>

    @include('landing-page.partials.footer')

    @include('landing-page.partials.music')
@endsection
