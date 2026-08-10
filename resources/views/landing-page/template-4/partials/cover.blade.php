@php
    $photo = $invitation?->cover_image
        ? asset('storage/'.$invitation->cover_image)
        : ($bride?->photo_path ? asset('storage/'.$bride->photo_path) : null);
@endphp

<section
    x-data="{ __coverOpen: false }"
    x-effect="document.body.style.overflow = __coverOpen ? '' : 'hidden'"
    :class="__coverOpen ? 'pointer-events-none -translate-y-full opacity-0' : 'translate-y-0 opacity-100'"
    class="fixed inset-0 z-50 mx-auto flex min-h-dvh w-full max-w-md flex-col items-center justify-center gap-9 overflow-hidden bg-[#3A141A] px-8 py-16 text-center shadow-2xl transition-all duration-700 ease-in-out"
>
    {{-- Glow midnight --}}
    <div class="pointer-events-none absolute -top-24 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-[#5e0015]/30 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 -right-16 h-80 w-80 rounded-full bg-[#D4AF37]/10 blur-3xl"></div>

    <div class="relative flex items-center gap-4">
        <div class="h-px w-10 bg-gradient-to-r from-transparent to-[#D4AF37]"></div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.45em] text-[#D4AF37]/70">You Are Invited</p>
        <div class="h-px w-10 bg-gradient-to-l from-transparent to-[#D4AF37]"></div>
    </div>

    {{-- Foto dalam bingkai emas melingkar --}}
    <div class="rounded-full bg-[#4A1C24]/40 p-1.5 shadow-[0_0_35px_rgba(212,175,55,0.25)] ring-2 ring-[#D4AF37]/70">
        <div class="rounded-full p-1 ring-1 ring-[#D4AF37]/40">
            @if ($photo)
                <img
                    src="{{ $photo }}"
                    alt="Foto mempelai"
                    class="size-44 rounded-full object-cover md:size-52"
                />
            @else
                <div class="flex size-44 items-center justify-center rounded-full bg-gradient-to-br from-[#5B0017] to-[#2B1810] md:size-52">
                    <span class="font-script text-4xl text-[#D4AF37]">S &amp; J</span>
                </div>
            @endif
        </div>
    </div>

    <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-[#D4AF37]/40">The Wedding Of</p>
        <h1 class="mt-3 font-script text-5xl leading-tight text-[#D4AF37] md:text-6xl">
            {{ $bride?->full_name ?? 'Mempelai Wanita' }} &amp; {{ $groom?->full_name ?? 'Mempelai Pria' }}
        </h1>
    </div>

    @include('landing-page.template-4.partials.countdown')

    @php
        $guestName = request()->query('to');
    @endphp

    @if($guestName)
        <div class="flex flex-col items-center gap-1.5 mt-2">
            <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#D4AF37]/80">Kepada Yth. Bapak/Ibu/Saudara/i,</p>
            <p class="text-2xl font-bold text-[#D4AF37] drop-shadow-md" style="font-family: 'Playfair Display', serif;">{{ urldecode($guestName) }}</p>
            <p class="text-[9px] font-light italic text-[#D4AF37]/60 mt-1">*Mohon maaf bila ada kesalahan penulisan nama/gelar</p>
        </div>
    @endif

    <button
        type="button"
        @click="__coverOpen = true; window.dispatchEvent(new CustomEvent('cover-dismissed'))"
        class="rounded-full bg-[#D4AF37] px-9 py-3.5 text-xs font-semibold uppercase tracking-[0.3em] text-[#2B1810] shadow-[0_0_28px_rgba(212,175,55,0.4)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_42px_rgba(212,175,55,0.65)]"
    >
        Open Invitation
    </button>
</section>
