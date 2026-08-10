<footer class="flex flex-col items-center px-6 py-20 text-center bg-[#151E3D] rounded-t-[40px] mt-8">
    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="flex flex-col items-center gap-5 anim-fade-up"
        :class="v ? 'is-visible' : ''"
    >
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="opacity-40">
            <path d="M10 0L12.245 7.27L20 10L12.245 12.73L10 20L7.755 12.73L0 10L7.755 7.27L10 0Z" fill="#D8C4A6"/>
        </svg>

        <h2 class="font-playfair text-3xl italic text-[#F9F9FD]">Terima Kasih</h2>

        <p class="font-cormorant text-base italic text-[#F9F9FD]/60 max-w-[240px] leading-relaxed">
            Atas perhatian dan doa restu Bapak/Ibu/Saudara/i sekalian.
        </p>

        <span class="divider-gold my-1"></span>

        <p class="font-inter text-[8px] font-medium uppercase tracking-[0.3em] text-[#D8C4A6]/70">
            &copy; {{ date('Y') }} &nbsp;{{ $bride?->nickname ?? 'Bride' }} &amp; {{ $groom?->nickname ?? 'Groom' }}
        </p>
    </div>
</footer>
