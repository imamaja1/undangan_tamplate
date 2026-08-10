@php
    $photo = $invitation?->cover_image
        ? asset('storage/'.$invitation->cover_image)
        : ($bride?->photo_path ? asset('storage/'.$bride->photo_path) : null);
    $guestName = request()->query('to');
    
    $brideNickname = $bride?->nickname ?? 'Bride';
    $groomNickname = $groom?->nickname ?? 'Groom';
    
    $brideInitial = mb_substr($brideNickname, 0, 1);
    $groomInitial = mb_substr($groomNickname, 0, 1);
@endphp

<section
    x-data="{ open: false, ready: false }"
    x-init="setTimeout(() => ready = true, 300)"
    x-effect="document.body.style.overflow = open ? '' : 'hidden'"
    :class="open ? 'pointer-events-none -translate-y-full opacity-0' : ''"
    class="fixed inset-0 z-50 mx-auto flex max-w-md flex-col overflow-y-auto bg-[#1a2238] p-4 transition-all duration-[1400ms] ease-[cubic-bezier(0.77,0,0.175,1)]"
>
    <style>
        @keyframes sway {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(3deg); }
        }
        @keyframes sway-reverse {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(-3deg); }
        }
        .animate-sway {
            animation: sway 7s ease-in-out infinite;
        }
        .animate-sway-reverse {
            animation: sway-reverse 8s ease-in-out infinite;
        }
    </style>

    {{-- Frame Border --}}
    <div class="relative flex flex-1 flex-col rounded-xl border border-white/20 p-6 overflow-hidden">
        
        {{-- Floral Decorations (Realistic Botanical Branches) --}}
        
        {{-- Top Left --}}
        <div class="absolute -left-10 top-[15%] w-32 opacity-45">
            <svg class="h-full w-full origin-bottom-left animate-sway text-[#F9F9FD]" viewBox="-20 -60 300 400" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
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

        {{-- Top Right --}}
        <div class="absolute -right-10 top-[15%] w-32 opacity-45 -scale-x-100">
            <svg class="h-full w-full origin-bottom-left animate-sway-reverse text-[#F9F9FD]" viewBox="-20 -60 300 400" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
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

        {{-- Bottom Left --}}
        <div class="absolute -left-12 bottom-[12%] w-44 opacity-45">
            <svg class="h-full w-full origin-bottom-left animate-sway text-[#F9F9FD]" viewBox="-20 -60 300 400" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
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

        {{-- Bottom Right --}}
        <div class="absolute -right-12 bottom-[12%] w-44 opacity-45 -scale-x-100">
            <svg class="h-full w-full origin-bottom-left animate-sway-reverse text-[#F9F9FD]" viewBox="-20 -60 300 400" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
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


        {{-- Content --}}
        <div class="relative z-10 flex h-full flex-col justify-between">
            
            {{-- Top Area --}}
            <div class="anim-fade-in" :class="ready ? 'is-visible' : ''">
                {{-- Header line --}}
                <div class="flex items-center gap-3 w-full">
                    <span class="font-inter text-[8px] font-medium uppercase tracking-[0.3em] text-white/80 whitespace-nowrap">The Wedding Of</span>
                    <div class="h-[0.5px] flex-1 bg-white/30"></div>
                    <span class="font-inter text-[8px] font-medium uppercase tracking-[0.3em] text-white/80">{{ date('Y') }}</span>
                </div>

                {{-- Main Title --}}
                <h1 class="mt-6 text-center font-display text-[26px] tracking-[0.2em] uppercase text-white drop-shadow-md">
                    The Wedding Of
                </h1>
            </div>

            {{-- Center Area --}}
            <div 
                class="flex flex-col items-center anim-fade-up my-auto"
                style="transition-delay: 200ms"
                :class="ready ? 'is-visible' : ''"
            >
                {{-- Photo --}}
                <div class="relative w-full max-w-[210px] rounded-[1.5rem] bg-gradient-to-b from-[#E5C77A] via-[#C9A250] to-[#8C6D23] p-[2.5px] shadow-[0_12px_35px_rgba(0,0,0,0.5)]">
                    <div class="relative h-[270px] w-full rounded-[1.35rem] overflow-hidden bg-[#1a2238]">
                        @if ($photo)
                            <img src="{{ $photo }}" alt="Cover" class="h-full w-full object-cover" style="filter: brightness(0.95) contrast(1.05);">
                        @else
                            <div class="flex h-full w-full items-center justify-center">
                                <span class="font-display text-3xl italic text-[#E5C77A]">Love</span>
                            </div>
                        @endif
                    </div>
                </div>

                <p class="mt-8 font-inter text-[9px] font-bold uppercase tracking-[0.25em] text-[#C9A250]">
                    The Celebration Of
                </p>

                {{-- Monogram --}}
                <div class="mt-3 flex flex-col items-center justify-center">
                    <span class="font-display text-[42px] lowercase leading-none text-white">{{ $brideInitial }}</span>
                    <div class="my-1.5 h-px w-[42px] bg-white"></div>
                    <span class="font-display text-[42px] lowercase leading-none text-white">{{ $groomInitial }}</span>
                </div>

                <p class="mt-5 font-inter text-[8.5px] font-medium uppercase tracking-[0.25em] text-white/70">
                    Segera Dibuka
                </p>

                {{-- Countdown --}}
                @include('landing-page.template-3.partials.countdown')

                {{-- Separator Line below countdown --}}
                <div class="mt-4 h-px w-[85%] bg-white/20"></div>

                @if ($guestName)
                    <div class="mt-4 flex flex-col items-center gap-1.5">
                        <p class="font-inter text-[8px] font-medium uppercase tracking-[0.3em] text-white/60">Kepada Yth.</p>
                        <p class="font-display text-lg text-white font-medium">{{ urldecode($guestName) }}</p>
                    </div>
                @endif
            </div>

            {{-- Bottom CTA --}}
            <div 
                class="mt-4 anim-fade-in"
                style="transition-delay: 400ms"
                :class="ready ? 'is-visible' : ''"
            >
                <button
                    type="button"
                    @click="open = true; window.dispatchEvent(new CustomEvent('cover-dismissed'))"
                    class="relative w-full overflow-hidden rounded-full bg-[#f6f2e9] py-4 text-center font-inter text-[10px] font-bold uppercase tracking-[0.25em] text-[#1a2238] shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:bg-[#e8dec7] active:scale-[0.98]"
                >
                    Buka Undangan
                    
                    {{-- Button Sparkle effect --}}
                    <div class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4 text-white opacity-80" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L14.4 9.6L22 12L14.4 14.4L12 22L9.6 14.4L2 12L9.6 9.6L12 2Z" fill="currentColor"/>
                        </svg>
                    </div>
                </button>
            </div>
        </div>
    </div>
</section>
