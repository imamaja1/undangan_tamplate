@extends('landing-page.template-3.layouts.app')

@section('title', 'Undangan Pernikahan - Deep Navy Editorial Edition')

@section('meta')
    @include('landing-page.partials.og-meta')
@endsection

@section('content')
    @include('landing-page.template-3.partials.cover')

    @include('landing-page.template-3.partials.opening')

    @if ($events && $events->count() > 0)
        @include('landing-page.template-3.partials.event')
    @endif

    @include('landing-page.template-3.partials.bride-groom')

    @if ($loveStories && $loveStories->count() > 0)
        @include('landing-page.template-3.partials.love-story')
    @endif

    @if ($galleries && $galleries->count() > 0)
        @include('landing-page.template-3.partials.gallery')
    @endif

    @if ($gifts && $gifts->count() > 0)
        @include('landing-page.template-3.partials.gift')
    @endif

    @if ($invitation)
        @include('landing-page.template-3.partials.rsvp')
        @include('landing-page.template-3.partials.wishes')
    @endif

    @include('landing-page.template-3.partials.footer')

    @include('landing-page.template-3.partials.music')
@endsection
