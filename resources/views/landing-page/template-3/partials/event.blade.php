<section class="flex flex-col items-center px-6 py-24 relative">

    <div
        x-data="{ v: false }" x-intersect.half="v = true"
        class="mb-14 flex flex-col items-center gap-3 text-center anim-fade-up z-10"
        :class="v ? 'is-visible' : ''"
    >
        <span class="font-inter text-[8.5px] font-semibold uppercase tracking-[0.4em] text-[#D8C4A6]">Rangkaian Acara</span>
        <h2 class="font-playfair text-[34px] text-[#F9F9FD] mt-2 drop-shadow-md">Jadwal &amp; Lokasi</h2>
        <span class="divider-gold mt-4"></span>
    </div>

    <div class="flex w-full max-w-sm flex-col gap-8">
        @foreach ($events as $index => $event)
            @php
                $dayName = \Carbon\Carbon::parse($event->event_date)->locale('id')->isoFormat('dddd');
                $dateStr = \Carbon\Carbon::parse($event->event_date)->locale('id')->isoFormat('D MMMM YYYY');
                $timeStr = $event->start_time
                    ? substr($event->start_time, 0, 5) . ($event->end_time && !in_array($event->end_time, ['23:59', '00:00'])
                        ? ' — ' . substr($event->end_time, 0, 5)
                        : ' WIB')
                    : null;
            @endphp
            <div
                x-data="{ v: false }" x-intersect.half="v = true"
                class="navy-card flex flex-col overflow-hidden anim-fade-up"
                style="transition-delay: {{ $index * 100 }}ms"
                :class="v ? 'is-visible' : ''"
            >
                {{-- Dark header strip --}}
                <div class="flex items-center justify-between bg-[#151E3D] px-6 py-4 rounded-t-[24px]">
                    <span class="font-inter text-[8px] font-semibold uppercase tracking-[0.35em] text-[#D8C4A6]">{{ $event->title }}</span>
                </div>

                {{-- Date & Time --}}
                <div class="flex flex-col items-center gap-2 px-6 py-8 text-center">
                    <p class="font-playfair text-[28px] text-[#1D274D] font-bold leading-tight">{{ $dateStr }}</p>
                    <p class="font-inter text-[9.5px] font-bold uppercase tracking-[0.25em] text-[#1D274D]/90 mt-1.5">
                        {{ $dayName }}
                        @if ($timeStr)
                            <span class="mx-1.5 text-[#1D274D]/50">&bull;</span>
                            {{ $timeStr }}
                        @endif
                    </p>
                </div>

                @if ($event->location_name)
                    <div class="mx-6 h-px bg-[#D8C4A6]/30"></div>

                    <div class="flex flex-col items-center gap-2 px-6 py-7 text-center">
                        <p class="font-playfair text-[22px] text-[#1D274D] font-semibold tracking-wide">{{ $event->location_name }}</p>
                        @if ($event->location_address)
                            <p class="font-inter text-[11px] leading-[1.8] tracking-wide text-[#1D274D]/80">{{ $event->location_address }}</p>
                        @endif
                    </div>
                @endif

                @if ($event->google_maps_url)
                    <div class="p-4 pt-0">
                        <a
                            href="{{ $event->google_maps_url }}"
                            target="_blank"
                            class="block w-full rounded-2xl bg-[#1D274D] py-3.5 text-center font-inter text-[8px] font-semibold uppercase tracking-[0.35em] text-[#F9F9FD] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:bg-[#D8C4A6] hover:text-[#1D274D]"
                        >
                            Lihat Lokasi
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

</section>
