<div class="flex w-full flex-col gap-5">
    @forelse ($wishes as $wish)
        <div class="reveal relative flex flex-col gap-4 rounded-2xl p-6 transition-all bg-white shadow-[0_8px_30px_rgba(0,0,0,0.25)] border border-champagne/20 hover:border-champagne/50 hover:shadow-[0_12px_40px_rgba(201,176,55,0.2)]">

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    {{-- Avatar --}}
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full shadow-inner bg-navy">
                        <span class="text-lg font-semibold text-champagne font-display">
                            {{ strtoupper(substr(trim($wish->name), 0, 1)) }}
                        </span>
                    </div>

                    {{-- Name & Time --}}
                    <div class="flex flex-col">
                        <h4 class="font-display text-lg font-semibold text-navy">
                            {{ $wish->name }}
                        </h4>
                        <span class="text-[9px] font-semibold uppercase tracking-[0.2em] text-navy/50">
                            {{ $wish->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                {{-- Heart icon --}}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c9b037" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-40">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </div>

            {{-- Message --}}
            <p class="text-[13px] font-light italic leading-relaxed text-navy/70">
                "{{ $wish->message }}"
            </p>
        </div>
    @empty
        <div class="py-8 text-center text-sm italic text-champagne/50">
            Belum ada ucapan. Jadilah yang pertama memberikan ucapan!
        </div>
    @endforelse

    @if ($totalWishes > $limit)
        <div class="mt-4 flex justify-center">
            <button
                wire:click="loadMore"
                class="rounded-full border border-champagne/30 bg-white px-6 py-2.5 text-[10px] font-bold uppercase tracking-[0.3em] text-navy transition-all hover:bg-champagne hover:text-navy hover:border-champagne hover:shadow-[0_4px_16px_rgba(201,176,55,0.35)]"
            >
                Lihat Semua Ucapan
            </button>
        </div>
    @endif
</div>
