@extends('landing-page.template-1.layouts.app')

@section('title', 'Undangan Pernikahan')

@section('meta')
    @include('landing-page.partials.og-meta')
@endsection

@section('content')
    @include('landing-page.template-1.partials.cover')

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>

    @include('landing-page.template-1.partials.opening')

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>

    @include('landing-page.template-1.partials.bride-groom')

    @if ($loveStories && $loveStories->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.template-1.partials.love-story')
    @endif

    @if ($events && $events->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.template-1.partials.event')
        @include('landing-page.template-1.partials.maps')
    @endif

    @if ($galleries && $galleries->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.template-1.partials.gallery')
    @endif

    @if ($gifts && $gifts->count() > 0)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.template-1.partials.gift')
    @endif

    @if ($invitation)
        <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>
        @include('landing-page.template-1.partials.rsvp')
        @include('landing-page.template-1.partials.wishes')
    @endif

    <div class="relative z-10 h-px w-4/5 mx-auto bg-gradient-to-r from-transparent via-champagne/20 to-transparent -mt-px"></div>

    @include('landing-page.template-1.partials.footer')

    @include('landing-page.template-1.partials.music')
@endsection
