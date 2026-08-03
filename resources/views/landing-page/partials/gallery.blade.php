<section
    id="gallery"
    class="relative overflow-hidden py-20 px-5"
    style="background: linear-gradient(175deg, #0a1128 0%, #0d1b2e 50%, #0a1128 100%);"
>
    {{-- Parchment texture --}}
    <div class="parchment pointer-events-none absolute inset-0 opacity-40"></div>
    {{-- Ambient glow --}}
    <div class="pointer-events-none absolute top-0 left-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/3 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(201,176,55,0.15) 0%, transparent 70%);"></div>

    {{-- Section heading --}}
    <div class="reveal relative z-10 mb-8 flex flex-col items-center gap-3 text-center">
        <p class="text-[10px] font-semibold uppercase tracking-[0.45em] text-[#c9b037]/60">Our Gallery</p>
        <h2 class="text-[#c9b037]" style="font-family:'Great Vibes',cursive; font-size:3rem; line-height:1.2;">Moments</h2>
        <div class="flex items-center gap-3">
            <div class="h-px w-12 bg-gradient-to-r from-transparent to-[#d4af37]/60"></div>
            <svg width="10" height="10" viewBox="0 0 10 10" fill="#d4af37" opacity="0.7"><path d="M5 0.5 L6 3.5 L9.5 4 L7 6.5 L7.5 10 L5 8.5 L2.5 10 L3 6.5 L0.5 4 L4 3.5 Z"/></svg>
            <div class="h-px w-12 bg-gradient-to-l from-transparent to-[#d4af37]/60"></div>
        </div>
    </div>

    {{-- Mosaic Grid --}}
    <div class="reveal relative z-10 mx-auto max-w-sm" x-data="{ lightbox: null, photos: {{ json_encode($galleries->map(fn($g) => asset('storage/'.$g->file_path))->values()) }} }">

        @php $chunks = $galleries->values()->chunk(3); @endphp

        @foreach ($chunks as $chunkIndex => $chunk)
            @php
                $photos = $chunk->values();
                $count  = $photos->count();
                $offset = $chunkIndex * 3;
                $pattern = $chunkIndex % 2; // alternate between 2 layout patterns
            @endphp

            @if ($count === 1)
                {{-- Single wide photo --}}
                <div class="mb-2">
                    <div class="relative overflow-hidden rounded-xl cursor-zoom-in shadow-[0_8px_30px_rgba(92,74,42,0.18)]"
                         @click="lightbox = {{ $offset }}" style="border: 1px solid rgba(201,176,55,0.2);">
                        <img src="{{ asset('storage/'.$photos[0]->file_path) }}" alt="Gallery" loading="lazy"
                             class="h-52 w-full object-cover transition-transform duration-700 hover:scale-105"
                             style="filter: sepia(8%) contrast(1.05);">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#c9b037]/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>

            @elseif ($count === 2)
                {{-- Two equal photos side by side --}}
                <div class="mb-2 grid grid-cols-2 gap-2">
                    @foreach ($photos as $i => $photo)
                        <div class="relative overflow-hidden rounded-xl cursor-zoom-in shadow-[0_6px_20px_rgba(92,74,42,0.15)]"
                             @click="lightbox = {{ $offset + $i }}" style="border: 1px solid rgba(201,176,55,0.2);">
                            <img src="{{ asset('storage/'.$photo->file_path) }}" alt="Gallery" loading="lazy"
                                 class="h-36 w-full object-cover transition-transform duration-700 hover:scale-105"
                                 style="filter: sepia(8%) contrast(1.05);">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#c9b037]/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @endforeach
                </div>

            @else
                {{-- Three photos: alternating pattern --}}
                @if ($pattern === 0)
                    {{-- Pattern A: 1 tall left + 2 stacked right --}}
                    <div class="mb-2 grid grid-cols-2 gap-2">
                        <div class="relative overflow-hidden rounded-xl cursor-zoom-in shadow-[0_8px_30px_rgba(92,74,42,0.18)]"
                             @click="lightbox = {{ $offset + 0 }}" style="border: 1px solid rgba(201,176,55,0.2);">
                            <img src="{{ asset('storage/'.$photos[0]->file_path) }}" alt="Gallery" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 hover:scale-105" style="min-height:170px; filter: sepia(8%) contrast(1.05);">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#c9b037]/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            @foreach ([$photos[1], $photos[2]] as $si => $photo)
                                <div class="relative overflow-hidden rounded-xl cursor-zoom-in shadow-[0_6px_20px_rgba(92,74,42,0.15)]"
                                     @click="lightbox = {{ $offset + $si + 1 }}" style="border: 1px solid rgba(201,176,55,0.2);">
                                    <img src="{{ asset('storage/'.$photo->file_path) }}" alt="Gallery" loading="lazy"
                                         class="h-[82px] w-full object-cover transition-transform duration-700 hover:scale-105"
                                         style="filter: sepia(8%) contrast(1.05);">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#c9b037]/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Pattern B: 2 stacked left + 1 tall right --}}
                    <div class="mb-2 grid grid-cols-2 gap-2">
                        <div class="flex flex-col gap-2">
                            @foreach ([$photos[0], $photos[1]] as $si => $photo)
                                <div class="relative overflow-hidden rounded-xl cursor-zoom-in shadow-[0_6px_20px_rgba(92,74,42,0.15)]"
                                     @click="lightbox = {{ $offset + $si }}" style="border: 1px solid rgba(201,176,55,0.2);">
                                    <img src="{{ asset('storage/'.$photo->file_path) }}" alt="Gallery" loading="lazy"
                                         class="h-[82px] w-full object-cover transition-transform duration-700 hover:scale-105"
                                         style="filter: sepia(8%) contrast(1.05);">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#c9b037]/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="relative overflow-hidden rounded-xl cursor-zoom-in shadow-[0_8px_30px_rgba(92,74,42,0.18)]"
                             @click="lightbox = {{ $offset + 2 }}" style="border: 1px solid rgba(201,176,55,0.2);">
                            <img src="{{ asset('storage/'.$photos[2]->file_path) }}" alt="Gallery" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 hover:scale-105" style="min-height:170px; filter: sepia(8%) contrast(1.05);">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#c9b037]/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

        {{-- ===== LIGHTBOX OVERLAY ===== --}}
        <div
            x-show="lightbox !== null"
            x-transition.opacity.duration.300ms
            @keydown.escape.window="lightbox = null"
            class="fixed inset-0 z-[200] flex items-center justify-center"
            style="background: rgba(10,8,5,0.92); backdrop-filter: blur(8px); display:none;"
            @click.self="lightbox = null"
        >
            {{-- Close --}}
            <button @click="lightbox = null" class="absolute top-5 right-5 z-10 flex h-9 w-9 cursor-pointer items-center justify-center rounded-full text-white transition-colors hover:bg-white/10" style="border: 1px solid rgba(255,255,255,0.2);">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 3l10 10M13 3L3 13"/></svg>
            </button>

            {{-- Prev --}}
            <button @click="lightbox = (lightbox - 1 + photos.length) % photos.length" class="absolute left-3 z-10 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full text-white transition-colors hover:bg-white/10" style="border: 1px solid rgba(255,255,255,0.15);">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 3L5 8l5 5"/></svg>
            </button>

            {{-- Image --}}
            <img :src="photos[lightbox]" alt="Gallery" class="max-h-[85dvh] max-w-[90vw] rounded-xl object-contain shadow-2xl" style="border: 1px solid rgba(201,176,55,0.3);">

            {{-- Next --}}
            <button @click="lightbox = (lightbox + 1) % photos.length" class="absolute right-3 z-10 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full text-white transition-colors hover:bg-white/10" style="border: 1px solid rgba(255,255,255,0.15);">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3l5 5-5 5"/></svg>
            </button>

            {{-- Counter --}}
            <p class="absolute bottom-5 left-1/2 -translate-x-1/2 text-[11px] font-medium tracking-widest text-white/50" x-text="(lightbox + 1) + ' / ' + photos.length"></p>
        </div>
    </div>
</section>
