<section class="flex flex-col items-center px-6 py-24 relative z-10">

    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="mb-14 flex flex-col items-center gap-3 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
        <span class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.4em] text-[#D8C4A6]">Tanda Kasih</span>
        <h2 class="font-playfair text-[34px] text-[#F9F9FD] mt-2 drop-shadow-md">Wedding Gift</h2>
        <span class="divider-gold mt-4"></span>
        <p class="font-playfair mt-5 text-[15px] italic text-[#F9F9FD]/80 max-w-[260px] leading-relaxed">
            Doa restu Anda adalah hadiah terindah bagi kami.
        </p>
    </div>

    <div class="flex w-full max-w-sm flex-col gap-8">
        @foreach ($gifts as $index => $gift)
            <div
                x-data="{ v: false, copied: false }" x-intersect.half="v = true"
                class="navy-card flex flex-col items-center overflow-hidden anim-fade-up shadow-xl border border-[#D8C4A6]/25"
                style="transition-delay: {{ $index * 100 }}ms"
                :class="v ? 'is-visible' : ''"
            >
                {{-- Bank Header --}}
                <div class="w-full bg-[#151E3D] px-6 py-4 text-center rounded-t-[22px]">
                    <span class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.4em] text-[#D8C4A6]">{{ $gift->provider_name }}</span>
                </div>

                @if ($gift->qr_code_path)
                    <div class="p-6 pb-4">
                        <div class="border border-[#D8C4A6]/30 p-3 bg-white rounded-[14px] shadow-inner">
                            <img src="{{ asset('storage/'.$gift->qr_code_path) }}" alt="QR" class="h-28 w-28 object-contain block mx-auto">
                        </div>
                    </div>
                @endif

                <div class="flex flex-col items-center gap-1 px-6 py-5 text-center">
                    <p class="font-playfair text-[24px] font-bold tracking-[0.1em] text-[#1D274D]">{{ $gift->account_number }}</p>
                    <p class="font-inter text-[9px] font-bold uppercase tracking-widest text-[#1D274D]/90 mt-1">a.n. {{ $gift->account_name }}</p>
                </div>

                <div class="w-full p-4 pt-0">
                    <button
                        @click="navigator.clipboard.writeText('{{ $gift->account_number }}'); copied = true; setTimeout(() => copied = false, 3000)"
                        class="w-full rounded-2xl bg-[#1D274D] py-3.5 text-center font-inter text-[8px] font-semibold uppercase tracking-[0.35em] text-[#F9F9FD] transition-all duration-300 hover:bg-[#D8C4A6] hover:text-[#1D274D]"
                    >
                        <span x-show="!copied">Salin Nomor Rekening</span>
                        <span x-show="copied">Tersalin ✓</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

</section>
