<section class="flex flex-col items-center px-6 py-24 relative z-10 pb-32">

    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="mb-14 flex flex-col items-center gap-3 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
        <span class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.4em] text-[#D8C4A6]">Ucapan</span>
        <h2 class="font-playfair text-[34px] text-[#F9F9FD] mt-2 drop-shadow-md">Doa &amp; Harapan</h2>
        <span class="divider-gold mt-4"></span>
        <p class="font-playfair mt-5 text-[15px] italic text-[#F9F9FD]/80 max-w-[260px] leading-relaxed">
            Setiap doa Anda adalah cahaya bagi perjalanan cinta kami.
        </p>
    </div>

    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="w-full max-w-sm anim-fade-up"
        :class="v ? 'is-visible' : ''"
    >
        @livewire('landing-page.wishes-list', ['invitation' => $invitation])
    </div>

</section>
