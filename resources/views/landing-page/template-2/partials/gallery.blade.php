<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet"/>

<style>
    .font-label-caps { font-family: 'Montserrat', sans-serif; }
    .font-display-lg, .font-display-lg-mobile, .font-headline-md, .font-body-lg, .font-body-md { font-family: 'EB Garamond', serif; }
    
    .bg-surface { background-color: #fef9f0; }
    .text-primary { color: #715c2e; }
    .text-secondary { color: #685e49; }
    .border-outline-variant { border-color: #cec6b4; }
</style>

<section class="bg-surface text-[#1d1b16] antialiased py-12 px-4 overflow-hidden" x-data="{
    photos: [@foreach($galleries as $gallery)'{{ addslashes(asset('storage/'.$gallery->file_path)) }}',@endforeach],
    lightboxIndex: null,
    touchStartX: null,
    open(index) {
        this.lightboxIndex = index;
    },
    close() {
        this.lightboxIndex = null;
    },
    next() {
        if (this.lightboxIndex === null || this.photos.length < 2) return;
        this.lightboxIndex = (this.lightboxIndex + 1) % this.photos.length;
    },
    prev() {
        if (this.lightboxIndex === null || this.photos.length < 2) return;
        this.lightboxIndex = (this.lightboxIndex - 1 + this.photos.length) % this.photos.length;
    },
    touchStart(event) {
        this.touchStartX = event.changedTouches[0].clientX;
    },
    touchEnd(event) {
        if (this.touchStartX === null) return;
        const deltaX = event.changedTouches[0].clientX - this.touchStartX;
        if (deltaX < -40) {
            this.next();
        } else if (deltaX > 40) {
            this.prev();
        }
        this.touchStartX = null;
    }
}">
    <div class="max-w-md mx-auto relative w-full">
        <!-- Header Section -->
        <div 
            x-data="{ v: false }" x-intersect.half="v = true"
            class="text-center mb-10 opacity-0 translate-y-8 transition-all duration-1000"
            :class="v ? '!opacity-100 !translate-y-0' : ''"
        >
            <h2 class="font-display-lg-mobile text-[40px] font-semibold text-primary mb-2 leading-tight">Galeri Prewedding</h2>
            <p class="font-body-lg text-[18px] text-secondary italic">Momen indah yang kami abadikan</p>
            
            <div class="flex justify-center mt-4">
                <span class="material-symbols-outlined text-primary text-sm" style="font-variation-settings: 'FILL' 1;">diamond</span>
            </div>
        </div>

        {{-- Bento Grid Gallery (Mobile Layout Base) --}}
        @if(count($galleries) > 0)
        <div class="grid grid-cols-2 gap-2 auto-rows-[150px] w-full">
            @foreach ($galleries as $index => $gallery)
                @php
                    $mod = $index % 4;
                    $gridClass = '';
                    if ($mod === 0) {
                        $gridClass = 'col-span-2 row-span-2';
                    } elseif ($mod === 1) {
                        $gridClass = 'col-span-1 row-span-2';
                    } else {
                        $gridClass = 'col-span-1 row-span-1';
                    }
                @endphp
                <div
                    x-data="{ v: false }" x-intersect.half="v = true"
                    class="{{ $gridClass }} relative overflow-hidden rounded-lg border border-outline-variant group cursor-zoom-in opacity-0 translate-y-8 transition-all duration-700"
                    style="transition-delay: {{ ($index % 4) * 100 }}ms"
                    :class="v ? '!opacity-100 !translate-y-0' : ''"
                    @click="open({{ $index }})"
                >
                    <img
                        src="{{ asset('storage/'.$gallery->file_path) }}"
                        alt="Gallery"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        loading="lazy"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-full p-4 flex justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none text-white">
                        <span class="material-symbols-outlined">zoom_in</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Lightbox Overlay --}}
        <div
            x-show="lightboxIndex !== null"
            x-transition.opacity.duration.300ms
            @keydown.escape.window="close()"
            @keydown.left.window="prev()"
            @keydown.right.window="next()"
            @touchstart.passive="touchStart($event)"
            @touchend.passive="touchEnd($event)"
            class="fixed inset-0 z-[200] flex items-center justify-center touch-pan-y"
            style="background: rgba(29,27,22,0.94); backdrop-filter: blur(8px); display:none;"
            @click.self="close()"
        >
            <button @click="close()" class="absolute top-5 right-5 z-10 flex h-9 w-9 cursor-pointer items-center justify-center rounded-full text-white transition-colors hover:bg-white/10" style="border: 1px solid rgba(163,130,34,0.5);">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 3l10 10M13 3L3 13"/></svg>
            </button>

            <button @click="prev()" aria-label="Foto sebelumnya" class="absolute left-4 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white transition-colors hover:bg-white/10" style="border: 1px solid rgba(163,130,34,0.5);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>

            <button @click="next()" aria-label="Foto berikutnya" class="absolute right-4 top-1/2 z-10 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white transition-colors hover:bg-white/10" style="border: 1px solid rgba(163,130,34,0.5);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
            </button>

            <img :src="photos[lightboxIndex] ?? ''" alt="Galeri" class="max-h-[85dvh] max-w-[90vw] rounded-xl object-contain shadow-2xl" style="border: 1px solid rgba(163,130,34,0.4);">

            <div class="absolute bottom-5 left-1/2 z-10 -translate-x-1/2 rounded-full px-4 py-1.5 text-sm text-white/90" style="background: rgba(29,27,22,0.7); border: 1px solid rgba(163,130,34,0.5);">
                <span x-text="(lightboxIndex ?? 0) + 1"></span> / <span x-text="photos.length"></span>
            </div>
        </div>
        @endif
    </div>
</section>
