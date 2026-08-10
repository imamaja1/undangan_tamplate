<section
    id="gift"
    x-data="{ reveal: false }"
    x-intersect="reveal = true"
    :class="reveal ? 'reveal-visible' : ''"
    class="reveal-section relative flex min-h-dvh flex-col items-center justify-center gap-10 overflow-hidden px-6 py-24"
    
>
    {{-- Sparkle & glow --}}
    <div class="sparkles pointer-events-none absolute inset-0 opacity-10"></div>
    <div class="pointer-events-none absolute top-0 left-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%);"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 h-72 w-72 translate-x-1/3 translate-y-1/3 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(183,110,121,0.1) 0%, transparent 70%);"></div>


    {{-- Heading --}}
    <div class="reveal relative z-10 flex flex-col items-center gap-3 text-center">
        <p class="text-[10px] font-semibold uppercase tracking-[0.45em] text-[#D4AF37]/60">Wedding Gift</p>
        <h2 class="text-[#D4AF37]" style="font-family:'Great Vibes',cursive; font-size:3rem; line-height:1.2;">Digital Gift</h2>
        <div class="flex items-center gap-3">
            <div class="h-px w-12 bg-gradient-to-r from-transparent to-[#D4AF37]/50"></div>
            <svg width="12" height="12" viewBox="0 0 12 12" fill="#D4AF37" opacity="0.7"><path d="M6 0.5 L7.5 4 L11.5 4.5 L8.5 7.5 L9.5 11.5 L6 9.5 L2.5 11.5 L3.5 7.5 L0.5 4.5 L4.5 4 Z"/></svg>
            <div class="h-px w-12 bg-gradient-to-l from-transparent to-[#D4AF37]/50"></div>
        </div>
        <p class="mt-2 max-w-xs text-center text-[13px] font-light leading-relaxed text-[#b8c4d0]/75" style="font-family:'Cormorant Garamond',serif; font-size:1rem;">
            Doa restu Anda adalah hadiah terindah bagi kami. Namun jika Anda ingin memberikan tanda kasih, Anda dapat mengirimkannya melalui:
        </p>
    </div>

    {{-- Gift Cards --}}
    <div class="relative z-10 flex w-full max-w-sm flex-col gap-5">
        @foreach ($gifts as $index => $gift)
            <x-section-card
                x-data="{ copied: false }"
                class="reveal reveal-delay-{{ $index % 3 + 1 }} text-center anim-diamond-grid border-[#D4AF37]/30"
            >
                <div class="flex flex-col items-center gap-4 px-8 py-8">

                    {{-- Provider logo / name --}}
                    @if ($gift->qr_code_path)
                        <div class="flex flex-col items-center gap-3">
                            <h3 class="text-[#D4AF37]" style="font-family:'Playfair Display',serif; font-size:1.6rem; font-style:italic; font-weight:600; letter-spacing:0.03em;">
                                {{ $gift->provider_name }}
                            </h3>
                            <div class="overflow-hidden rounded-xl p-2 !anim-diamond-grid" style="border: 1px solid rgba(212,175,55,0.3); background: rgba(255,255,255,0.8);">
                                <img src="{{ asset('storage/'.$gift->qr_code_path) }}" alt="QR Code {{ $gift->provider_name }}" class="h-40 w-40 object-contain">
                            </div>
                        </div>
                    @else
                        <h3 class="text-[#D4AF37]" style="font-family:'Playfair Display',serif; font-size:1.8rem; font-style:italic; font-weight:600; letter-spacing:0.04em;">
                            {{ $gift->provider_name }}
                        </h3>
                    @endif

                    {{-- Account number --}}
                    <div class="w-full">
                        <p class="text-[#D4AF37]" style="font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:500; letter-spacing:0.08em; line-height:1.3;">
                            {{ $gift->account_number }}
                        </p>
                        <p class="mt-1.5 text-[12px] font-medium italic text-[#D4AF37]/70">a.n {{ $gift->account_name }}</p>
                    </div>

                    {{-- Divider --}}
                    <div class="w-full h-px bg-gradient-to-r from-transparent via-[#D4AF37]/40 to-transparent"></div>

                    {{-- Copy button --}}
                    <button
                        type="button"
                        @click="
                            navigator.clipboard.writeText('{{ $gift->account_number }}');
                            copied = true;
                            setTimeout(() => copied = false, 2500);
                        "
                        class="flex w-full items-center justify-center gap-2.5 rounded-full py-3 text-[10px] font-bold uppercase tracking-[0.35em] text-white transition-all duration-300 cursor-pointer"
                        :class="copied ? 'scale-95' : 'hover:scale-[1.02]'"
                        
                    >
                        <template x-if="!copied">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="5" y="5" width="8" height="8" rx="1.5"/>
                                <path d="M3 9H2a1 1 0 01-1-1V2a1 1 0 011-1h6a1 1 0 011 1v1"/>
                            </svg>
                        </template>
                        <template x-if="copied">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 7l3.5 3.5L12 3"/>
                            </svg>
                        </template>
                        <span x-text="copied ? 'Tersalin!' : 'Copy'"></span>
                    </button>
                </div>
            </x-section-card>
        @endforeach
    </div>
</section>
