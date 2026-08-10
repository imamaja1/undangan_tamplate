@extends('landing-page.template-2.layouts.app')

@section('title', 'Undangan Pernikahan - Exclusive')

@section('meta')
    @include('landing-page.partials.og-meta')
@endsection

@section('content')
    @include('landing-page.template-2.partials.cover')

    @include('landing-page.template-2.partials.opening')

    @include('landing-page.template-2.partials.bride-groom')

    @if ($loveStories && $loveStories->count() > 0)
        @include('landing-page.template-2.partials.love-story')
    @endif

    @if ($events && $events->count() > 0)
        @include('landing-page.template-2.partials.event')
    @endif

    @if ($galleries && $galleries->count() > 0)
        @include('landing-page.template-2.partials.gallery')
    @endif

    @if ($gifts && $gifts->count() > 0)
        @include('landing-page.template-2.partials.gift')
    @endif

    @if ($invitation)
        @include('landing-page.template-2.partials.rsvp')
        @include('landing-page.template-2.partials.wishes')
    @endif

    @include('landing-page.template-2.partials.footer')

    @include('landing-page.template-2.partials.music')
@endsection
