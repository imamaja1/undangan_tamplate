@php
    $guestName = $to ?: 'Bapak/Ibu Tamu Undangan';
    $monogram = collect([$bride?->full_name, $groom?->full_name])
        ->filter()
        ->map(fn (string $name) => strtoupper(substr(trim($name), 0, 1)))
        ->implode(' & ');
@endphp

<section
    id="opening"
    class="relative flex min-h-dvh flex-col items-center justify-center gap-8 overflow-hidden bg-gradient-to-b from-[#0a1128] via-[#0d1b2e] to-[#0a1128] px-8 py-16 text-center"
>
    {{-- Cahaya ambient halus --}}
    <div class="pointer-events-none absolute top-0 left-0 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-champagne/5 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 h-[500px] w-[500px] translate-x-1/2 translate-y-1/2 rounded-full bg-champagne/3 blur-3xl"></div>

    {{-- Filigree emas halus di sudut atas & bawah --}}
    <div class="filigree pointer-events-none absolute inset-x-0 top-0 h-24 opacity-70"></div>
    <div class="filigree pointer-events-none absolute inset-x-0 bottom-0 h-24 rotate-180 opacity-70"></div>

    {{-- Salam pembuka --}}
    <div class="relative mt-4">
        <p class="font-arabic text-3xl leading-relaxed text-champagne">السلام عليكم ورحمة الله وبركاته</p>
        <p class="mt-2 text-[11px] font-medium uppercase tracking-[0.3em] text-champagne/60">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
    </div>

    {{-- Monogram emas berkilau --}}
    <div class="relative flex items-center gap-5">
        <div class="h-px w-14 bg-gradient-to-r from-transparent to-[#c9b037]"></div>
        <span class="gold-shimmer font-display text-5xl font-semibold">{{ $monogram ?: 'S & J' }}</span>
        <div class="h-px w-14 bg-gradient-to-l from-transparent to-[#c9b037]"></div>
    </div>

    {{-- Teks undangan --}}
    <p class="relative max-w-xs text-sm italic leading-relaxed text-softwhite/80">
        Dengan memohon rahmat dan ridha Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara pernikahan kami.
    </p>

    {{-- Kartu sambutan --}}
    <div class="glass-card relative w-full max-w-sm overflow-hidden rounded-3xl px-8 py-7">
        <div class="relative">
            <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-champagne/70">
                Kepada Yth. Bapak/Ibu/Saudara/i:
            </p>
            <p class="mt-3 font-display text-3xl text-champagne">{{ $guestName }}</p>
            <div class="mx-auto mt-4 h-px w-24 bg-gradient-to-r from-transparent via-[#d4af37] to-transparent"></div>
            <p class="mt-3 text-xs italic text-softwhite/50">Mohon maaf apabila ada kesalahan penulisan nama/gelar</p>
        </div>
    </div>
</section>
