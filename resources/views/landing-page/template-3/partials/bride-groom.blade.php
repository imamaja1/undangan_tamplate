<section class="flex flex-col items-center px-6 py-24 relative z-10">

    {{-- Section Header --}}
    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="mb-14 flex flex-col items-center gap-3 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
        <span class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.4em] text-[#D8C4A6]">Mempelai</span>
        <h2 class="font-playfair text-[34px] text-[#F9F9FD] mt-2 drop-shadow-md">Pasangan Bahagia</h2>
        <span class="divider-gold mt-4"></span>
    </div>

    {{-- Bride Card --}}
    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="navy-card group mb-10 flex w-full max-w-sm flex-col items-center p-8 text-center anim-fade-up shadow-xl border border-[#D8C4A6]/25"
        :class="v ? 'is-visible' : ''"
    >
        <div class="relative mb-8 w-full max-w-[180px] overflow-hidden rounded-2xl border border-[#D8C4A6]/30 bg-[#151E3D] p-1.5 aspect-square shadow-lg">
            @if ($bride?->photo_path)
                <img src="{{ asset('storage/'.$bride->photo_path) }}" alt="{{ $bride->full_name }}" class="img-editorial h-full w-full rounded-[14px] object-cover">
            @else
                <div class="h-full w-full rounded-[14px] bg-[#151E3D]"></div>
            @endif
        </div>

        <span class="font-inter text-[8.5px] font-bold uppercase tracking-[0.45em] text-[#1D274D]/80 mb-3">Mempelai Wanita</span>
        <h3 class="font-playfair text-[28px] text-[#1D274D] font-bold leading-tight mb-2">{{ $bride?->full_name ?? 'Nama Mempelai Wanita' }}</h3>

        @if ($bride?->parents_name)
            <div class="w-full border-t border-[#D8C4A6]/30 pt-5 mt-4">
                <p class="font-playfair text-sm text-[#1D274D]/80">
                    Putri dari
                </p>
                <p class="font-inter text-[10px] font-bold uppercase tracking-[0.2em] text-[#1D274D] mt-2">{{ $bride->parents_name }}</p>
            </div>
        @endif
    </div>

    {{-- Ampersand --}}
    <div
        x-data="{ v: false }" x-intersect="v = true"
        class="glass-panel mb-10 flex h-12 w-12 items-center justify-center rounded-full anim-fade-in"
        :class="v ? 'is-visible' : ''"
    >
        <span class="font-cormorant text-2xl text-[#D8C4A6] italic">&amp;</span>
    </div>

    {{-- Groom Card --}}
    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="navy-card group flex w-full max-w-sm flex-col items-center p-8 text-center anim-fade-up shadow-xl border border-[#D8C4A6]/25"
        :class="v ? 'is-visible' : ''"
    >
        <div class="relative mb-8 w-full max-w-[180px] overflow-hidden rounded-2xl border border-[#D8C4A6]/30 bg-[#151E3D] p-1.5 aspect-square shadow-lg">
            @if ($groom?->photo_path)
                <img src="{{ asset('storage/'.$groom->photo_path) }}" alt="{{ $groom->full_name }}" class="img-editorial h-full w-full rounded-[14px] object-cover">
            @else
                <div class="h-full w-full rounded-[14px] bg-[#151E3D]"></div>
            @endif
        </div>

        <span class="font-inter text-[8.5px] font-bold uppercase tracking-[0.45em] text-[#1D274D]/80 mb-3">Mempelai Pria</span>
        <h3 class="font-playfair text-[28px] text-[#1D274D] font-bold leading-tight mb-2">{{ $groom?->full_name ?? 'Nama Mempelai Pria' }}</h3>

        @if ($groom?->parents_name)
            <div class="w-full border-t border-[#D8C4A6]/30 pt-5 mt-4">
                <p class="font-playfair text-sm text-[#1D274D]/80">
                    Putra dari
                </p>
                <p class="font-inter text-[10px] font-bold uppercase tracking-[0.2em] text-[#1D274D] mt-2">{{ $groom->parents_name }}</p>
            </div>
        @endif
    </div>

</section>
