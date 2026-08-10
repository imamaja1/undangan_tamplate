@php
    $photo = $invitation?->cover_image
        ? asset('storage/'.$invitation->cover_image)
        : ($bride?->photo_path ? asset('storage/'.$bride->photo_path) : null);
    $guestName = request()->query('to');
@endphp

<section
    x-data="{ open: false, ready: false }"
    x-init="setTimeout(() => ready = true, 100)"
    x-effect="document.body.style.overflow = open ? '' : 'hidden'"
    :class="open ? 'pointer-events-none -translate-x-full opacity-0' : ''"
    class="fixed inset-0 z-[60] transition-all duration-1000 ease-[cubic-bezier(0.77,0,0.175,1)] bg-[#f6fbf5] text-[#181d1a] antialiased selection:bg-[#84a98c] selection:text-[#1c3e27]"
>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .font-display-lg-mobile { font-family: 'EB Garamond', serif; font-size: 40px; line-height: 48px; letter-spacing: -0.01em; font-weight: 500; }
        .font-label-caps { font-family: 'Work Sans', sans-serif; font-size: 12px; line-height: 16px; letter-spacing: 0.1em; font-weight: 600; }
        .text-warm-brass { color: #D4AF37; }
        .bg-warm-brass { background-color: #D4AF37; }
    </style>

    <main class="relative w-full max-w-[430px] mx-auto h-[100dvh] overflow-hidden flex flex-col shadow-2xl bg-[#181d1a]">
        <img alt="Cover Photo" class="absolute inset-0 w-full h-full object-cover animate-in fade-in duration-1000" src="{{ $photo ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCDV6Isua3HyRwOMAtXewdMwvUVBwWfBVVzQNK0QFKodoEMvlcRjPmN-7l7TkYO9NEtBmGSqrv37w7RqNELM0jq7XijPPTVnXy6C6BkNz45GO13y8hREKNZA2BG8-lfXU9deXgG_o9wha6tBNUCvUcBh5Z99wSkaTYqjo57SPDeQb3ilWhyW9GMPw6MFWiYvju1doOoG-XkXEQVH86gHqfy4_egZsBSfTxaaIQ6a6IzVdcnHzpvgvJ27KhBItr3KsCgyQ' }}">
        <div class="absolute inset-0 bg-black/10 pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col justify-between w-full px-4 h-full py-4 overflow-y-auto">
            <div class="flex flex-col items-center w-full max-w-sm mx-auto rounded-xl backdrop-blur-md border border-white/20 shadow-xl p-2 px-3 bg-black/40 animate-in fade-in slide-in-from-bottom-4 duration-1000">
                <div class="flex flex-col items-center w-full text-center">
                    <span aria-hidden="true" class="material-symbols-outlined text-warm-brass text-sm leading-none m-0">location_city</span>
                    <span class="font-label-caps text-white uppercase tracking-[0.15em] text-center text-[9px] leading-none m-0">The Wedding of</span>
                    <h1 class="font-display-lg-mobile text-[20px] text-warm-brass text-center leading-tight m-0">
                        {{ $bride?->nickname ?? 'Elise' }} &amp; {{ $groom?->nickname ?? 'Julian' }}
                    </h1>
                </div>
                
                @if ($guestName)
                    <div class="w-8 h-px bg-warm-brass/40 my-0.5"></div>
                    <div class="flex flex-col items-center w-full text-center">
                        <p class="font-label-caps text-white/80 uppercase tracking-widest text-[8px] leading-none m-0">Dear,</p>
                        <p class="font-display-lg-mobile text-[14px] text-warm-brass leading-tight max-w-[260px] mx-auto m-0">{{ urldecode($guestName) }}</p>
                    </div>
                @endif
            </div>

            <div class="flex-1 min-h-[40px]"></div>
            
            <div class="flex flex-col items-center gap-6 w-full max-w-sm mx-auto p-6 rounded-xl backdrop-blur-md border border-white/20 shadow-xl bg-black/40 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-300">
                @if ($mainEvent ?? null)
                    @php
                        $targetDate = \Carbon\Carbon::parse(
                            $mainEvent->event_date instanceof \Carbon\Carbon
                                ? $mainEvent->event_date->format('Y-m-d')
                                : $mainEvent->event_date
                        )->toDateString() . 'T' . ($mainEvent->start_time ?? '00:00');
                    @endphp
                    <div 
                        x-data="{
                            days: '00', hours: '00', mins: '00', secs: '00', _t: null,
                            init() {
                                const end = new Date('{{ $targetDate }}').getTime();
                                const tick = () => {
                                    const diff = Math.max(0, end - Date.now());
                                    this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
                                    this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                                    this.mins = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                                    this.secs = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
                                };
                                tick(); this._t = setInterval(tick, 1000);
                            },
                            destroy() { clearInterval(this._t); }
                        }"
                        class="flex flex-col items-center gap-3 w-full mb-2"
                    >
                        <div class="flex gap-4 justify-center items-center">
                            <div class="flex flex-col items-center">
                                <span class="font-display-lg-mobile text-[32px] text-warm-brass leading-none tabular-nums" x-text="days">00</span>
                                <span class="font-label-caps text-white uppercase tracking-widest text-[10px] mt-1">Days</span>
                            </div>
                            <div class="text-warm-brass font-display-lg-mobile text-[32px] leading-none pb-4">:</div>
                            <div class="flex flex-col items-center">
                                <span class="font-display-lg-mobile text-[32px] text-warm-brass leading-none tabular-nums" x-text="hours">00</span>
                                <span class="font-label-caps text-white uppercase tracking-widest text-[10px] mt-1">Hrs</span>
                            </div>
                            <div class="text-warm-brass font-display-lg-mobile text-[32px] leading-none pb-4">:</div>
                            <div class="flex flex-col items-center">
                                <span class="font-display-lg-mobile text-[32px] text-warm-brass leading-none tabular-nums" x-text="mins">00</span>
                                <span class="font-label-caps text-white uppercase tracking-widest text-[10px] mt-1">Min</span>
                            </div>
                            <div class="text-warm-brass font-display-lg-mobile text-[32px] leading-none pb-4">:</div>
                            <div class="flex flex-col items-center">
                                <span class="font-display-lg-mobile text-[32px] text-warm-brass leading-none tabular-nums" x-text="secs">00</span>
                                <span class="font-label-caps text-white uppercase tracking-widest text-[10px] mt-1">Sec</span>
                            </div>
                        </div>
                        <div class="w-16 h-px bg-warm-brass/50 mt-2"></div>
                    </div>
                @endif
                
                <button 
                    type="button"
                    @click="open = true; window.dispatchEvent(new CustomEvent('cover-dismissed'))"
                    class="group flex items-center justify-center gap-3 w-full bg-[#800000] hover:bg-[#990000] text-warm-brass transition-all duration-300 ease-out py-4 px-8 rounded-full font-label-caps uppercase tracking-widest shadow-lg animate-pulse"
                >
                    <span>Open Invitation</span>
                    <span aria-hidden="true" class="material-symbols-outlined text-[18px] transition-transform duration-300 group-hover:translate-x-1">east</span>
                </button>
            </div>
        </div>
    </main>
</section>
