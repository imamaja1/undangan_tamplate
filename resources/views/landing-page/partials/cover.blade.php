@php
    $photo = $invitation?->cover_image
        ? asset('storage/'.$invitation->cover_image)
        : ($bride?->photo_path ? asset('storage/'.$bride->photo_path) : null);
@endphp

<section
    x-data="{ __coverOpen: false }"
    x-effect="document.body.style.overflow = __coverOpen ? '' : 'hidden'"
    :class="__coverOpen ? 'pointer-events-none -translate-y-full opacity-0' : 'translate-y-0 opacity-100'"
    class="fixed inset-0 z-50 mx-auto flex min-h-dvh w-full max-w-md flex-col items-center justify-center gap-9 overflow-hidden bg-gradient-to-b from-[#060a18] via-[#0d1b2e] to-[#0a1128] px-8 py-16 text-center shadow-2xl transition-all duration-700 ease-in-out"
>
    {{-- Glow midnight --}}
    <div class="pointer-events-none absolute -top-24 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-[#1a3a5c]/30 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 -right-16 h-80 w-80 rounded-full bg-[#c9b037]/10 blur-3xl"></div>

    <div class="relative flex items-center gap-4">
        <div class="h-px w-10 bg-gradient-to-r from-transparent to-[#c9b037]"></div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.45em] text-champagne/70">You Are Invited</p>
        <div class="h-px w-10 bg-gradient-to-l from-transparent to-[#c9b037]"></div>
    </div>

    {{-- Foto dalam bingkai emas melingkar --}}
    <div class="rounded-full bg-navy/40 p-1.5 shadow-[0_0_35px_rgba(201,176,55,0.25)] ring-2 ring-champagne/70">
        <div class="rounded-full p-1 ring-1 ring-champagne/40">
            @if ($photo)
                <img
                    src="{{ $photo }}"
                    alt="Foto mempelai"
                    class="size-44 rounded-full object-cover md:size-52"
                />
            @else
                <div class="flex size-44 items-center justify-center rounded-full bg-gradient-to-br from-[#1a2a4a] to-[#0d1b2e] md:size-52">
                    <span class="font-script text-4xl text-champagne">S &amp; J</span>
                </div>
            @endif
        </div>
    </div>

    <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-champagne/40">The Wedding Of</p>
        <h1 class="mt-3 font-script text-5xl leading-tight text-champagne md:text-6xl">
            {{ $bride?->full_name ?? 'Mempelai Wanita' }} &amp; {{ $groom?->full_name ?? 'Mempelai Pria' }}
        </h1>
    </div>

    @include('landing-page.partials.countdown')

    <button
        type="button"
        @click="__coverOpen = true; window.dispatchEvent(new CustomEvent('cover-dismissed'))"
        class="rounded-full bg-champagne px-9 py-3.5 text-xs font-semibold uppercase tracking-[0.3em] text-[#060a18] shadow-[0_0_28px_rgba(201,176,55,0.4)] transition-all duration-300 hover:shadow-[0_0_42px_rgba(201,176,55,0.65)]"
    >
        Open Invitation
    </button>
</section>
