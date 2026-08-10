<section class="flex flex-col items-center px-6 py-24 relative z-10">

    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="mb-14 flex flex-col items-center gap-3 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
        <span class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.4em] text-[#D8C4A6]">Perjalanan Cinta</span>
        <h2 class="font-playfair text-[34px] text-[#F9F9FD] mt-2 drop-shadow-md">Kisah Kami</h2>
        <span class="divider-gold mt-4"></span>
    </div>

    <div class="flex w-full max-w-sm flex-col gap-8">
        @foreach ($loveStories as $index => $story)
            <div
                x-data="{ v: false }" x-intersect.half="v = true"
                class="navy-card group relative flex flex-col p-7 anim-fade-up border border-[#D8C4A6]/25 shadow-xl overflow-hidden hover:border-[#D8C4A6]/60"
                style="transition-delay: {{ $index * 100 }}ms"
                :class="v ? 'is-visible' : ''"
            >
                {{-- Decorative background accent --}}
                <div class="absolute -right-8 -top-8 w-24 h-24 bg-[#D8C4A6]/5 rounded-full blur-2xl pointer-events-none"></div>

                {{-- Year badge or Heart icon + chapter --}}
                <div class="flex items-center gap-4 mb-5">
                    @if (trim($story->year) !== '')
                        <div class="flex h-9 items-center justify-center rounded-lg bg-[#1D274D] px-4 font-playfair text-[17px] font-semibold tracking-wider text-[#D8C4A6] shadow-inner">
                            {{ $story->year }}
                        </div>
                    @else
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#1D274D] text-[#D8C4A6] shadow-inner border border-[#D8C4A6]/20">
                            <svg class="w-4 h-4 fill-current mt-[2px]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-[#D8C4A6]/40 to-transparent"></div>
                </div>

                <h3 class="font-playfair text-[20px] text-[#1D274D] font-semibold tracking-wide {{ trim($story->story) !== '' ? 'mb-3' : 'mb-0' }}">
                    {{ $story->title }}
                </h3>

                @if (trim($story->story) !== '')
                    <p class="font-inter text-[11px] leading-[2.1] tracking-wide text-[#1D274D]/80">
                        {{ $story->story }}
                    </p>
                @endif

                @if ($story->photo_path)
                    <div class="mt-6 overflow-hidden rounded-[14px] bg-[#1a2238] p-1.5 border border-[#D8C4A6]/30 shadow-lg relative z-10">
                        <img src="{{ asset('storage/'.$story->photo_path) }}" alt="{{ $story->title }}" class="img-editorial w-full h-auto rounded-[10px] object-cover" loading="lazy">
                    </div>
                @endif
            </div>
        @endforeach
    </div>

</section>
