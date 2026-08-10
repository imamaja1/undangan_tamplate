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

<section class="bg-surface text-[#1d1b16] antialiased py-12 px-4 overflow-hidden">
    <div class="max-w-md mx-auto relative z-10 w-full">
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
                    class="{{ $gridClass }} relative overflow-hidden rounded-lg border border-outline-variant group cursor-pointer opacity-0 translate-y-8 transition-all duration-700"
                    style="transition-delay: {{ ($index % 4) * 100 }}ms"
                    :class="v ? '!opacity-100 !translate-y-0' : ''"
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
        @endif
    </div>
</section>
