@php
    $guestName = $to ?: 'Bapak/Ibu Tamu Undangan';
    $monogram = collect([$bride?->full_name, $groom?->full_name])
        ->filter()
        ->map(fn (string $name) => strtoupper(substr(trim($name), 0, 1)))
        ->implode(' & ');
@endphp

<section
    id="opening"
    x-data="{ reveal: false }"
    x-intersect="reveal = true"
    :class="reveal ? 'reveal-visible' : ''"
    class="reveal-section relative flex min-h-dvh flex-col items-center justify-center gap-6 overflow-hidden bg-transparent px-8 py-16 text-center"
>
    {{-- Cahaya ambient halus --}}
    <div class="pointer-events-none absolute top-0 left-0 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#D4AF37]/5 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 h-[500px] w-[500px] translate-x-1/2 translate-y-1/2 rounded-full bg-[#D4AF37]/5 blur-3xl"></div>

    {{-- Salam pembuka --}}
    <div class="relative mt-2">
        <p class="font-arabic text-[32px] leading-relaxed text-[#D4AF37]">السلام عليكم ورحمة الله وبركاته</p>
        <p class="mt-3 text-[9px] font-bold uppercase tracking-[0.2em] text-[#D4AF37]/80">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
    </div>

    {{-- Monogram --}}
    <div class="relative my-2 flex items-center gap-5">
        <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-[#D4AF37]/70"></div>
        <span class="font-display text-5xl font-bold text-[#D4AF37]" style="text-shadow: 0 4px 15px rgba(212,175,55,0.3);">{{ $monogram ?: 'D & D' }}</span>
        <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-[#D4AF37]/70"></div>
    </div>

    {{-- Teks undangan --}}
    <p class="relative max-w-[280px] text-sm italic leading-relaxed text-[#FAF6F0]/90">
        Dengan memohon rahmat dan ridha Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara pernikahan kami.
    </p>

    {{-- Kartu sambutan --}}
    <div class="relative mt-6 w-full max-w-[320px] rounded-[16px] border border-[#D4AF37]/40 anim-stardust px-6 py-8 shadow-[0_15px_40px_rgba(43,24,16,0.5)] backdrop-blur-sm">
        <p class="text-[9px] font-bold uppercase tracking-[0.25em] text-[#D4AF37]/90">
            Kepada Yth. Bapak/Ibu/Saudara/i:
        </p>
        <p class="mt-5 font-display text-[26px] font-semibold leading-tight text-[#D4AF37]">{{ $guestName }}</p>
        <div class="mx-auto mt-6 h-[1px] w-24 bg-gradient-to-r from-transparent via-[#D4AF37]/40 to-transparent"></div>
        <p class="mt-4 text-[10px] italic text-[#FAF6F0]/70">Mohon maaf apabila ada kesalahan penulisan nama/gelar</p>
    </div>
</section>
