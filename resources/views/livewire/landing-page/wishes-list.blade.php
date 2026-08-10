@if ($theme === 'template-2')
<div class="mt-6 flex-1 overflow-y-auto space-y-4 pr-2 custom-scrollbar max-h-[400px]">
    @forelse ($wishes as $wish)
        <div class="bg-[#e4e2d3]/20 p-4 rounded border-l-2 border-[#a38222]">
            <div class="flex justify-between items-start mb-1">
                <h4 class="font-headline-md text-[32px] font-medium text-[#a38222]">{{ $wish->name }}</h4>
                <span class="font-label-caps text-[10px] text-[#7a7768]">{{ $wish->created_at->diffForHumans() }}</span>
            </div>
            <p class="font-body-md text-[18px] text-[#32302a] leading-relaxed">{{ $wish->message }}</p>
        </div>
    @empty
        <div class="py-10 text-center font-body-md text-[16px] text-[#7a7768] italic">
            Belum ada ucapan. Jadilah yang pertama!
        </div>
    @endforelse

    @if ($totalWishes > $limit)
        <div class="flex justify-center mt-6">
            <button
                wire:click="loadMore"
                class="bg-transparent border border-[#a38222] text-[#a38222] font-label-caps text-[12px] font-semibold py-2 px-6 rounded hover:bg-[#a38222]/10 transition-colors uppercase tracking-[1.5px]"
            >
                Muat Lebih Banyak
            </button>
        </div>
    @endif
</div>
@else
<div class="flex w-full flex-col gap-4">
    @forelse ($wishes as $wish)
        <div class="reveal relative flex flex-col gap-4 rounded-2xl p-5 transition-all bg-navy border border-champagne/20 hover:border-champagne/40 shadow-[0_6px_24px_rgba(0,0,0,0.25)]">

            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    {{-- Avatar with gold ring --}}
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-navy ring-1 ring-champagne/50">
                        <span class="text-sm font-semibold text-champagne font-display">
                            {{ strtoupper(substr(trim($wish->name), 0, 1)) }}
                        </span>
                    </div>

                    {{-- Name & Time --}}
                    <div class="flex flex-col">
                        <h4 class="font-sans text-sm font-semibold text-champagne">
                            {{ $wish->name }}
                        </h4>
                        <span class="text-[10px] font-medium uppercase tracking-[0.15em] text-champagne/40">
                            {{ $wish->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                {{-- Gold filled heart icon --}}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#c9b037" stroke="#c9b037" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </div>

            {{-- Message --}}
            <p class="text-[13px] font-light leading-relaxed text-softwhite/80">
                "{{ $wish->message }}"
            </p>
        </div>
    @empty
        <div class="py-10 text-center text-[13px] font-light text-champagne/40">
            Belum ada ucapan. Jadilah yang pertama!
        </div>
    @endforelse

    @if ($totalWishes > $limit)
        <div class="mt-4 flex justify-center">
            <button
                wire:click="loadMore"
                class="rounded-full bg-gradient-to-r from-[#c9b037] via-[#e8d070] to-[#c9b037] px-6 py-2.5 text-[10px] font-bold uppercase tracking-[0.3em] text-navy transition-all hover:shadow-[0_6px_24px_rgba(201,176,55,0.5)] hover:tracking-[0.35em]"
            >
                Lihat Semua Ucapan
            </button>
        </div>
    @endif
</div>
@endif
