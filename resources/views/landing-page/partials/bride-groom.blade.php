@php
    $groomName = $groom?->nickname ?: ($groom?->full_name ?: 'Mempelai Pria');
    $brideName = $bride?->nickname ?: ($bride?->full_name ?: 'Mempelai Wanita');

    if ($groom?->father_name && $groom?->mother_name) {
        $groomParents = 'Bapak '.$groom->father_name.' & Ibu '.$groom->mother_name;
    } elseif ($groom?->father_name) {
        $groomParents = 'Bapak & Ibu '.$groom->father_name;
    } elseif ($groom?->mother_name) {
        $groomParents = 'Bapak & Ibu '.$groom->mother_name;
    } else {
        $groomParents = 'Bapak & Ibu';
    }

    if ($bride?->father_name && $bride?->mother_name) {
        $brideParents = 'Bapak '.$bride->father_name.' & Ibu '.$bride->mother_name;
    } elseif ($bride?->father_name) {
        $brideParents = 'Bapak & Ibu '.$bride->father_name;
    } elseif ($bride?->mother_name) {
        $brideParents = 'Bapak & Ibu '.$bride->mother_name;
    } else {
        $brideParents = 'Bapak & Ibu';
    }

    $groomInitial = $groom?->full_name ? strtoupper(substr(trim($groom->full_name), 0, 1)) : 'P';
    $brideInitial = $bride?->full_name ? strtoupper(substr(trim($bride->full_name), 0, 1)) : 'W';
@endphp

<section
    id="bride-groom"
    x-data="{ reveal: false }"
    x-intersect="reveal = true"
    :class="reveal ? 'reveal-visible' : ''"
    class="reveal-section relative flex min-h-dvh flex-col items-center justify-center gap-16 overflow-hidden bg-gradient-to-b from-[#0a1128] via-[#0d1b2e] to-[#0a1128] px-8 py-24 text-center"
>
    {{-- Cahaya ambient halus --}}
    <div class="pointer-events-none absolute top-0 left-0 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-champagne/5 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 h-[500px] w-[500px] translate-x-1/2 translate-y-1/2 rounded-full bg-champagne/3 blur-3xl"></div>


    <div class="relative z-10 mx-auto flex max-w-sm flex-col items-center gap-4">
        <p class="text-[10px] font-semibold uppercase tracking-[0.42em] text-champagne/50">Meet The Couple</p>
        <p class="text-[15px] font-light italic leading-loose text-softwhite/60">"Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri..."</p>
    </div>

    {{-- Profil mempelai pria (atas) --}}
    <div class="relative z-10 mt-2 flex flex-col items-center gap-5">
        <div class="rounded-full bg-navy/40 p-1.5 shadow-[0_0_30px_rgba(201,176,55,0.2),0_12px_30px_rgba(0,0,0,0.3)] ring-2 ring-champagne/70">
            <div class="relative size-44 overflow-hidden rounded-full md:size-52">
                @if ($groom?->photo_path)
                    <img
                        src="{{ asset('storage/'.$groom->photo_path) }}"
                        alt="Foto mempelai pria"
                        class="h-full w-full object-cover grayscale contrast-[1.1]"
                    />
                @else
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#f8f3ea] to-[#ecdfcc]">
                        <span class="font-script text-6xl text-[#b76e79]">{{ $groomInitial }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <h2 class="font-display text-4xl leading-tight text-champagne">{{ $groomName }}</h2>
            <p class="mt-4 text-[11px] font-semibold uppercase tracking-[0.3em] text-softwhite/60">Putra dari</p>
            <p class="mt-2 font-display text-lg italic text-softwhite/50">{{ $groomParents }}</p>
        </div>
    </div>

    {{-- Hati emas penghubung --}}
    <div class="relative z-10 flex items-center justify-center py-2">
        <div class="absolute left-1/2 top-1/2 h-28 w-px -translate-x-1/2 -translate-y-1/2 bg-gradient-to-b from-transparent via-champagne to-transparent"></div>
        <div class="relative rounded-full bg-navy/50 p-2 shadow-[0_0_24px_rgba(201,176,55,0.35)] ring-1 ring-champagne/50 backdrop-blur-sm">
            <x-lucide-heart class="heart-beat size-6 fill-[#c9b037] text-[#c9b037]" />
        </div>
    </div>

    {{-- Profil mempelai wanita (bawah) --}}
    <div class="relative z-10 flex flex-col items-center gap-5">
        <div class="rounded-full bg-navy/40 p-1.5 shadow-[0_0_30px_rgba(201,176,55,0.2),0_12px_30px_rgba(0,0,0,0.3)] ring-2 ring-champagne/70">
            <div class="relative size-44 overflow-hidden rounded-full md:size-52">
                @if ($bride?->photo_path)
                    <img
                        src="{{ asset('storage/'.$bride->photo_path) }}"
                        alt="Foto mempelai wanita"
                        class="h-full w-full object-cover grayscale contrast-[1.1]"
                    />
                @else
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#f8f3ea] to-[#ecdfcc]">
                        <span class="font-script text-6xl text-[#b76e79]">{{ $brideInitial }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <h2 class="font-display text-4xl leading-tight text-champagne">{{ $brideName }}</h2>
            <p class="mt-4 text-[11px] font-semibold uppercase tracking-[0.3em] text-softwhite/60">Putri dari</p>
            <p class="mt-2 font-display text-lg italic text-softwhite/50">{{ $brideParents }}</p>
        </div>
    </div>
</section>
