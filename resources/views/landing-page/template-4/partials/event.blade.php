<section
    id="events"
    x-data="{ reveal: false }"
    x-intersect="reveal = true"
    :class="reveal ? 'reveal-visible' : ''"
    class="reveal-section relative flex min-h-dvh flex-col items-center justify-center gap-10 overflow-hidden px-6 py-24"
    
>
    {{-- Ambient glows --}}
    <div class="pointer-events-none absolute top-0 left-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(212,175,55,0.12) 0%, transparent 70%);"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 h-72 w-72 translate-x-1/3 translate-y-1/3 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(212,175,55,0.06) 0%, transparent 70%);"></div>


    {{-- Section heading --}}
    <div class="reveal relative z-10 flex flex-col items-center gap-3 text-center">
        <p class="text-[10px] font-semibold uppercase tracking-[0.45em] text-[#D4AF37]">The Wedding Events</p>
        <h2 class="text-[#D4AF37]" style="font-family:'Great Vibes',cursive; font-size:3rem; line-height:1.2;">Rangkaian Acara</h2>
        <div class="flex items-center gap-3">
            <div class="h-px w-12 bg-gradient-to-r from-transparent to-[#D4AF37]/60"></div>
            <svg width="10" height="10" viewBox="0 0 10 10" fill="#D4AF37" opacity="0.7"><path d="M5 0.5 L6 3.5 L9.5 4 L7 6.5 L7.5 10 L5 8.5 L2.5 10 L3 6.5 L0.5 4 L4 3.5 Z"/></svg>
            <div class="h-px w-12 bg-gradient-to-l from-transparent to-[#D4AF37]/60"></div>
        </div>
    </div>

    {{-- Event Cards --}}
    <div class="relative z-10 flex w-full max-w-sm flex-col gap-5">
        @foreach ($events as $index => $event)
            @php
                $dayName  = \Carbon\Carbon::parse($event->event_date)->locale('id')->isoFormat('dddd');
                $dateStr  = \Carbon\Carbon::parse($event->event_date)->locale('id')->isoFormat('D MMMM YYYY');
                $timeStr  = $event->start_time
                    ? substr($event->start_time, 0, 5) . ($event->end_time ? ' – ' . ($event->end_time === '23:59' || $event->end_time === '00:00' ? 'Selesai' : substr($event->end_time, 0, 5)) : '')
                    : null;

                // Build Google Calendar link
                $gcalStart = \Carbon\Carbon::parse($event->event_date->format('Y-m-d') . ' ' . ($event->start_time ?? '00:00'))->format('Ymd\THis');
                $gcalEnd   = $event->end_time && $event->end_time !== '23:59' && $event->end_time !== '00:00'
                    ? \Carbon\Carbon::parse($event->event_date->format('Y-m-d') . ' ' . $event->end_time)->format('Ymd\THis')
                    : \Carbon\Carbon::parse($event->event_date->format('Y-m-d') . ' ' . ($event->start_time ?? '00:00'))->addHours(2)->format('Ymd\THis');
                $gcalUrl   = 'https://calendar.google.com/calendar/render?' . http_build_query([
                    'action'   => 'TEMPLATE',
                    'text'     => $event->title,
                    'dates'    => $gcalStart . '/' . $gcalEnd,
                    'details'  => $event->location_address ?? '',
                    'location' => $event->location_name ?? '',
                ]);

                $isAkad = str_contains(strtolower($event->type ?? $event->title), 'akad') || str_contains(strtolower($event->title), 'akad');
            @endphp

            <x-section-card class="reveal reveal-delay-{{ $index % 3 + 1 }} !anim-elegant-lines">

                <div class="flex flex-col items-center gap-5 px-6 py-8 text-center">

                    {{-- Icon --}}
                    <div class="flex h-14 w-14 items-center justify-center rounded-full shadow-[0_4px_20px_rgba(212,175,55,0.3)]"
                         >
                        @if ($isAkad)
                            {{-- Mosque / Akad icon --}}
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="#D4AF37" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 24h20M6 24V13M22 24V13"/>
                                <path d="M10 24v-5a4 4 0 0 1 8 0v5"/>
                                <path d="M2 13h24M14 2 Q14 2 6 8h16Q22 2 14 2Z"/>
                                <circle cx="14" cy="5" r="1.2" fill="#D4AF37" stroke="none"/>
                            </svg>
                        @else
                            {{-- Party / Reception icon --}}
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="#D4AF37" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 4 C14 4 8 8 8 14 C8 18.4 10.7 22 14 22 C17.3 22 20 18.4 20 14 C20 8 14 4 14 4Z"/>
                                <path d="M14 22 v4"/>
                                <path d="M10 26 h8"/>
                                <path d="M8 9 Q4 10 4 14 M20 9 Q24 10 24 14"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Event title --}}
                    <div>
                        <h3 class="text-[#D4AF37]" style="font-family:'Playfair Display',serif; font-size:1.7rem; font-style:italic; line-height:1.2;">
                            {{ $event->title }}
                        </h3>
                    </div>

                    {{-- Date & Time --}}
                    <div class="flex flex-col items-center gap-1.5 w-full">
                        <div class="flex items-center gap-2">
                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#D4AF37" stroke-width="1.3"><rect x="1" y="2" width="11" height="10" rx="1.5"/><path d="M4 1v2M9 1v2M1 5h11"/></svg>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-[#D4AF37]">
                                {{ strtoupper($dayName) }}, {{ strtoupper($dateStr) }}
                            </p>
                        </div>

                        @if ($timeStr)
                            <div class="flex items-center gap-2">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#D4AF37" stroke-width="1.3"><circle cx="6.5" cy="6.5" r="5.5"/><path d="M6.5 3.5v3l2 1.5"/></svg>
                                <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#D4AF37]">{{ $timeStr }} WIB</p>
                            </div>
                        @endif

                        @if ($event->location_name)
                            <div class="flex items-center gap-2 mt-1">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="#D4AF37" stroke-width="1.3"><path d="M6.5 1C4.5 1 3 2.7 3 4.8C3 7.5 6.5 12 6.5 12C6.5 12 10 7.5 10 4.8C10 2.7 8.5 1 6.5 1Z"/><circle cx="6.5" cy="4.8" r="1.3"/></svg>
                                <p class="text-[11px] text-[#D4AF37] leading-tight">{{ $event->location_name }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Divider --}}
                    <div class="w-full h-px bg-gradient-to-r from-transparent via-[#D4AF37]/40 to-transparent"></div>

                    {{-- Action buttons --}}
                    <div class="flex w-full flex-col gap-2.5">
                        {{-- Add to Calendar --}}
                        <a
                            href="{{ $gcalUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex w-full items-center justify-center gap-2 rounded-full border py-2.5 text-[10px] font-semibold uppercase tracking-[0.3em] transition-all duration-300"
                            style="border-color: rgba(212,175,55,0.5); color: #D4AF37; background: rgba(10,17,40,0.8);"
                            onmouseover="this.style.background='rgba(212,175,55,0.1)'; this.style.borderColor='rgba(212,175,55,0.8)';"
                            onmouseout="this.style.background='rgba(10,17,40,0.8)'; this.style.borderColor='rgba(212,175,55,0.5)';"
                        >
                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="1" y="2" width="11" height="10" rx="1.5"/><path d="M4 1v2M9 1v2M1 5h11"/><path d="M6.5 7.5v2M5.5 8.5h2" stroke-width="1.2"/></svg>
                            Tambah Kalender
                        </a>

                        {{-- Maps button (only if URL exists) --}}
                        @if ($event->google_maps_url)
                            <a
                                href="{{ $event->google_maps_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex w-full items-center justify-center gap-2 rounded-full py-2.5 text-[10px] font-semibold uppercase tracking-[0.3em] transition-all duration-300"
                                
                                onmouseover="this.style.boxShadow='0 6px 24px rgba(212,175,55,0.55)';"
                                onmouseout="this.style.boxShadow='0 4px 16px rgba(212,175,55,0.35)';"
                            >
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M6.5 1C4.5 1 3 2.7 3 4.8C3 7.5 6.5 12 6.5 12C6.5 12 10 7.5 10 4.8C10 2.7 8.5 1 6.5 1Z"/><circle cx="6.5" cy="4.8" r="1.3"/></svg>
                                Lihat Lokasi
                            </a>
                        @endif
                    </div>
                </div>
            </x-section-card>
        @endforeach
    </div>
</section>
