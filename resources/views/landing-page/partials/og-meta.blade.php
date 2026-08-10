@php
    $ogImage = $invitation?->cover_image
        ? asset('storage/'.$invitation->cover_image)
        : ($bride?->photo_path ? asset('storage/'.$bride->photo_path) : null);

    $ogTitle = $invitation?->title ?? 'Undangan Pernikahan';
    $ogDescription = $invitation?->opening_message ?? 'Kami mengundang Anda untuk hadir di acara pernikahan kami';
    $ogUrl = url()->current();
@endphp

@if ($ogImage)
    <link rel="icon" type="image/png" href="{{ $ogImage }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ $ogImage }}">
@endif
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('app.name') }}">
