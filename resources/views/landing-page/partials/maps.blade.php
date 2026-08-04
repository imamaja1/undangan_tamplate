<section
    id="maps"
    x-data="{ reveal: false }"
    x-intersect="reveal = true"
    :class="reveal ? 'reveal-visible' : ''"
    class="reveal-section relative overflow-hidden"
    style="background: linear-gradient(175deg, #1d274d 0%, #263360 60%, #1a2240 100%);"
>
    {{-- Sparkle overlay --}}
    <div class="sparkles pointer-events-none absolute inset-0 opacity-10"></div>
    <div class="pointer-events-none absolute top-0 right-0 h-80 w-80 translate-x-1/3 -translate-y-1/3 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(201,176,55,0.12) 0%, transparent 70%);"></div>


    @foreach ($events as $event)
        @if ($event->location_name || $event->google_maps_url)
            @php
                $query   = urlencode(($event->location_name ?? '') . ' ' . ($event->location_address ?? ''));
                $embedUrl = 'https://maps.google.com/maps?q=' . $query . '&output=embed&hl=id&z=16';
            @endphp

            <div class="reveal relative z-10 flex flex-col">
                {{-- Info panel --}}
                <div class="px-8 py-10">
                    <p class="mb-3 text-[10px] font-semibold uppercase tracking-[0.45em] text-champagne/70">Venue Location</p>

                    <h3 class="mb-3 leading-tight text-[#e8e6e1]"
                        style="font-family:'Playfair Display',serif; font-size:1.8rem; font-style:italic; line-height:1.25;">
                        {{ $event->location_name ?? $event->title }}
                    </h3>

                    @if ($event->location_address)
                        <p class="mb-6 text-[13px] font-light leading-relaxed text-[#b8c4d0]/75">
                            {{ $event->location_address }}
                        </p>
                    @endif

                    @if ($event->google_maps_url)
                        <a
                            href="{{ $event->google_maps_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2.5 rounded-full px-7 py-3.5 text-[10px] font-bold uppercase tracking-[0.35em] text-[#c9b037] transition-all duration-300"
                            style="background: rgba(29,39,77,0.8); border: 1px solid rgba(201,176,55,0.5); box-shadow: 0 4px 20px rgba(0,0,0,0.3);"
                            onmouseover="this.style.background='rgba(201,176,55,0.15)'; this.style.borderColor='rgba(201,176,55,0.9)';"
                            onmouseout="this.style.background='rgba(29,39,77,0.8)'; this.style.borderColor='rgba(201,176,55,0.5)';"
                        >
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 1C4.8 1 3 2.9 3 5.2C3 8.3 7 13 7 13C7 13 11 8.3 11 5.2C11 2.9 9.2 1 7 1Z"/>
                                <circle cx="7" cy="5.2" r="1.5"/>
                            </svg>
                            Lihat Google Maps
                        </a>
                    @endif
                </div>

                {{-- Embedded Map --}}
                <div class="relative h-[240px] w-full overflow-hidden" style="border-top: 1px solid rgba(201,176,55,0.2);">
                    {{-- Map overlay gradient (top fade) --}}
                    <div class="pointer-events-none absolute top-0 inset-x-0 h-10 z-10"
                         style="background: linear-gradient(180deg, rgba(26,34,64,0.6) 0%, transparent 100%);"></div>

                    <iframe
                        src="{{ $embedUrl }}"
                        width="100%"
                        height="240"
                        style="border: 0; filter: saturate(0.7) brightness(0.9);"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi {{ $event->location_name ?? $event->title }}"
                    ></iframe>
                </div>

                {{-- Divider between events --}}
                @if (!$loop->last)
                    <div class="mx-8 my-2 h-px bg-gradient-to-r from-transparent via-[#c9b037]/30 to-transparent"></div>
                @endif
            </div>
        @endif
    @endforeach

    {{-- Bottom padding --}}
    <div class="h-6"></div>
</section>
