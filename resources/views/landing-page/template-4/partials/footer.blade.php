<footer
    id="footer"
    x-data="{ reveal: false }"
    x-intersect="reveal = true"
    :class="reveal ? 'reveal-visible' : ''"
    class="reveal-section relative flex flex-col items-center justify-center overflow-hidden py-24 px-6 text-center"
    
>
    {{-- Sparkles --}}
    <div class="sparkles pointer-events-none absolute inset-0 opacity-15"></div>
    <div class="pointer-events-none absolute top-0 left-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(212,175,55,0.1) 0%, transparent 70%);"></div>

    {{-- Top Divider --}}
    <div class="mb-12 h-px w-24 bg-gradient-to-r from-transparent via-[#D4AF37]/40 to-transparent"></div>

    {{-- Thank You Text --}}
    <div class="reveal relative z-10 flex flex-col items-center gap-6">
        <h2 class="text-[#e8e6e1]" style="font-family:'Playfair Display',serif; font-size:2.5rem; font-style:italic; line-height:1.2; letter-spacing:0.02em;">
            Terima Kasih
        </h2>

        <p class="max-w-xs text-[14px] font-light leading-relaxed text-[#b8c4d0]/80" style="font-family:'Inter', sans-serif;">
            Suatu kehormatan bagi kami atas kehadiran dan doa restu Bapak/Ibu/Saudara/i.
        </p>

        @php
            // Extract initials from bride and groom names safely
            $brideInitial = $bride ? strtoupper(substr(trim($bride->full_name), 0, 1)) : 'S';
            $groomInitial = $groom ? strtoupper(substr(trim($groom->full_name), 0, 1)) : 'J';
            
            // Extract first names
            $brideFirstName = $bride ? explode(' ', trim($bride->full_name))[0] : 'Sarah';
            $groomFirstName = $groom ? explode(' ', trim($groom->full_name))[0] : 'James';
        @endphp

        {{-- Initials --}}
        <div class="mt-8 text-[#D4AF37]" style="font-family:'Playfair Display',serif; font-size:3rem; line-height:1; letter-spacing:0.1em;">
            {{ $brideInitial }} <span class="font-light italic text-[#D4AF37] text-[2.5rem]">&amp;</span> {{ $groomInitial }}
        </div>
    </div>

    {{-- Copyright / Made With --}}
    <div class="relative z-10 mt-20 flex w-full flex-col items-center gap-4">
        <div class="h-px w-full max-w-[200px] bg-gradient-to-r from-transparent via-[#D4AF37]/20 to-transparent"></div>
        <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-[#8a9bbd]/60">
            Made with <span class="text-[#b76e79] mx-1 text-[11px]">♥</span> by {{ strtoupper($brideFirstName) }} &amp; {{ strtoupper($groomFirstName) }}
        </p>
    </div>
</footer>
