@php
    $guestName = request()->query('to') ?? 'Bapak/Ibu Tamu Undangan';
    
    $brideNickname = $bride?->nickname ?? 'Bride';
    $groomNickname = $groom?->nickname ?? 'Groom';
    
    $brideInitial = mb_substr($brideNickname, 0, 1);
    $groomInitial = mb_substr($groomNickname, 0, 1);
@endphp

<section class="relative flex flex-col items-center px-6 py-24 overflow-hidden">
    {{-- Decorative Leaves Background --}}
    <div class="absolute -right-16 top-10 w-48 opacity-[0.15] -scale-x-100 pointer-events-none">
        <svg class="h-full w-full origin-bottom-left animate-sway-reverse text-[#D8C4A6]" viewBox="-20 -60 300 400" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M20,330 C50,250 100,120 170,50" stroke-width="2" stroke-linecap="round"/>
            <path d="M45,280 C110,310 160,250 170,240 C140,220 90,230 45,280 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M45,280 C90,270 140,250 170,240" stroke-width="0.7"/> 
            <path d="M65,220 C20,170 10,110 0,90 C40,120 70,160 65,220 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M65,220 C40,170 10,120 0,90" stroke-width="0.7"/>
            <path d="M95,170 C160,190 220,130 230,120 C200,100 150,110 95,170 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M95,170 C140,155 190,135 230,120" stroke-width="0.7"/>
            <path d="M120,120 C75,70 65,10 55,-10 C95,20 125,60 120,120 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M120,120 C95,70 65,20 55,-10" stroke-width="0.7"/>
            <path d="M150,70 C215,90 260,30 270,20 C240,0 190,10 150,70 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M150,70 C190,55 240,30 270,20" stroke-width="0.7"/>
            <path d="M170,50 C200,10 170,-40 160,-50 C140,-20 130,20 170,50 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M170,50 C175,10 165,-20 160,-50" stroke-width="0.7"/>
        </svg>
    </div>
    
    <div class="absolute -left-16 bottom-20 w-52 opacity-[0.15] pointer-events-none">
        <svg class="h-full w-full origin-bottom-left animate-sway text-[#D8C4A6]" viewBox="-20 -60 300 400" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M20,330 C50,250 100,120 170,50" stroke-width="2" stroke-linecap="round"/>
            <path d="M45,280 C110,310 160,250 170,240 C140,220 90,230 45,280 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M45,280 C90,270 140,250 170,240" stroke-width="0.7"/> 
            <path d="M65,220 C20,170 10,110 0,90 C40,120 70,160 65,220 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M65,220 C40,170 10,120 0,90" stroke-width="0.7"/>
            <path d="M95,170 C160,190 220,130 230,120 C200,100 150,110 95,170 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M95,170 C140,155 190,135 230,120" stroke-width="0.7"/>
            <path d="M120,120 C75,70 65,10 55,-10 C95,20 125,60 120,120 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M120,120 C95,70 65,20 55,-10" stroke-width="0.7"/>
            <path d="M150,70 C215,90 260,30 270,20 C240,0 190,10 150,70 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M150,70 C190,55 240,30 270,20" stroke-width="0.7"/>
            <path d="M170,50 C200,10 170,-40 160,-50 C140,-20 130,20 170,50 Z" stroke-width="1.5" stroke-linejoin="round"/>
            <path d="M170,50 C175,10 165,-20 160,-50" stroke-width="0.7"/>
        </svg>
    </div>

    <div
        x-data="{ v: false }"
        x-intersect.half="v = true"
        class="navy-card relative flex w-full max-w-[340px] flex-col items-center px-8 py-16 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
        {{-- Inner Border --}}
        <div class="pointer-events-none absolute inset-2.5 rounded-[18px] border border-[#D8C4A6]/25"></div>
        <div class="pointer-events-none absolute inset-1.5 rounded-[22px] border border-[#D8C4A6]/10"></div>

        {{-- Arabic Greeting --}}
        <p class="font-playfair text-[28px] leading-relaxed text-[#D8C4A6] drop-shadow-sm mb-4 mt-2" dir="rtl">
            السلام عليكم ورحمة الله وبركاته
        </p>

        {{-- Latin Greeting --}}
        <p class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.25em] text-[#1D274D]/80 mb-8">
            Assalamu'alaikum Warahmatullahi Wabarakatuh
        </p>

        {{-- Monogram --}}
        <div class="relative flex items-center justify-center gap-5 mb-8">
            <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-[#D8C4A6]"></div>
            <span class="font-playfair text-[42px] text-[#1D274D] font-medium lowercase tracking-wide drop-shadow-sm">
                {{ $brideInitial }} <span class="text-[28px] mx-1 text-[#D8C4A6]">&</span> {{ $groomInitial }}
            </span>
            <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-[#D8C4A6]"></div>
        </div>

        {{-- Invitation Text --}}
        <p class="font-playfair text-[15px] leading-loose text-[#1D274D] italic max-w-[260px]">
            Dengan memohon rahmat dan ridha Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara pernikahan kami.
        </p>

        {{-- Guest Info Box --}}
        <div class="mt-12 w-full rounded-[14px] bg-[#1D274D] border border-[#D8C4A6]/40 p-6 shadow-2xl relative overflow-hidden">
            {{-- Little corner accents in the box --}}
            <div class="absolute top-2 left-2 w-2 h-2 border-t border-l border-[#D8C4A6]/50"></div>
            <div class="absolute top-2 right-2 w-2 h-2 border-t border-r border-[#D8C4A6]/50"></div>
            <div class="absolute bottom-2 left-2 w-2 h-2 border-b border-l border-[#D8C4A6]/50"></div>
            <div class="absolute bottom-2 right-2 w-2 h-2 border-b border-r border-[#D8C4A6]/50"></div>

            <p class="font-inter text-[7.5px] font-bold uppercase tracking-[0.3em] text-[#D8C4A6] mb-4">
                Kepada Yth. Bapak/Ibu/Saudara/i:
            </p>
            <p class="font-playfair text-[22px] text-[#F9F9FD] font-semibold tracking-wide mb-5">
                {{ urldecode($guestName) }}
            </p>
            
            <div class="mx-auto h-[1px] w-3/4 bg-gradient-to-r from-transparent via-[#D8C4A6]/40 to-transparent mb-3.5"></div>
            
            <p class="font-inter text-[7px] font-medium italic tracking-widest text-[#F9F9FD]/60">
                Mohon maaf apabila ada kesalahan penulisan nama/gelar
            </p>
        </div>
    </div>
</section>
