<section class="flex flex-col items-center px-6 py-24 relative z-10">

    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="mb-14 flex flex-col items-center gap-3 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
        <span class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.4em] text-[#D8C4A6]">Galeri</span>
        <h2 class="font-playfair text-[34px] text-[#F9F9FD] mt-2 drop-shadow-md">Momen Bahagia</h2>
        <span class="divider-gold mt-4"></span>
    </div>

    <div class="grid grid-cols-3 gap-2 w-full max-w-sm">
        @foreach ($galleries as $gallery)
            <div
                x-data="{ v: false }" x-intersect.half="v = true"
                class="overflow-hidden rounded-xl border border-[#D8C4A6]/20 bg-[#F9F9FD] p-1 shadow-lg anim-fade-in aspect-square"
                :class="v ? 'is-visible' : ''"
            >
                <img src="{{ asset('storage/'.$gallery->file_path) }}" alt="Gallery" class="img-editorial w-full h-full object-cover rounded-lg" loading="lazy">
            </div>
        @endforeach
    </div>

</section>
