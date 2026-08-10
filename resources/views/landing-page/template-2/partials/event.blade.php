<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet"/>

<style>
    .font-label-caps { font-family: 'EB Garamond', serif; }
    .font-display-lg, .font-display-lg-mobile, .font-headline-md, .font-body-md, .font-body-lg { font-family: 'EB Garamond', serif; }
    
    .bg-surface { background-color: #fef9f0; }
    .bg-surface-container-lowest { background-color: #ffffff; }
    .text-primary { color: #735a2f; }
    .bg-primary { background-color: #735a2f; }
    .text-on-primary { color: #ffffff; }
    .text-on-surface-variant { color: #4c4639; }
    .text-on-surface { color: #1d1b16; }
    .border-outline-variant { border-color: #cfc5b4; }
    .border-primary { border-color: #735a2f; }
</style>

<section class="bg-surface text-[#1d1b16] antialiased py-12 px-6 md:px-16 overflow-hidden">
    <div class="max-w-md mx-auto relative z-10">
        <!-- Header Section -->
        <div 
            x-data="{ v: false }" x-intersect.half="v = true"
            class="text-center flex flex-col items-center mb-12 opacity-0 translate-y-8 transition-all duration-1000"
            :class="v ? '!opacity-100 !translate-y-0' : ''"
        >
            <h2 class="font-display-lg-mobile text-[40px] font-semibold text-primary mb-2 leading-tight">Acara Pernikahan</h2>
            <div class="flex justify-center items-center gap-4 mb-4">
                <div class="h-px bg-primary w-16 opacity-50"></div>
                <span class="material-symbols-outlined text-primary text-sm">diamond</span>
                <div class="h-px bg-primary w-16 opacity-50"></div>
            </div>
            <p class="font-body-lg text-[18px] text-on-surface-variant max-w-sm mx-auto">
                Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami.
            </p>
        </div>

        <!-- Events Grid (Forced to Mobile 1-Column) -->
        <div class="flex flex-col gap-10 items-center w-full">
            @foreach ($events as $index => $event)
                @php
                    $dayName = \Carbon\Carbon::parse($event->event_date)->locale('id')->isoFormat('dddd');
                    $dateStr = \Carbon\Carbon::parse($event->event_date)->locale('id')->isoFormat('D MMMM YYYY');
                    $timeStr = $event->start_time
                        ? substr($event->start_time, 0, 5) . ' WIB' . ($event->end_time && !in_array($event->end_time, ['23:59', '00:00'])
                            ? ' - ' . substr($event->end_time, 0, 5) . ' WIB'
                            : ' - selesai')
                        : null;
                @endphp
                
                <article 
                    x-data="{ v: false }" x-intersect.half="v = true"
                    class="w-full bg-surface-container-lowest border border-outline-variant p-8 relative overflow-hidden group rounded-[1rem] shadow-sm hover:shadow-md transition-shadow duration-300 opacity-0 translate-y-8 transition-all duration-700"
                    style="transition-delay: {{ $index * 150 }}ms"
                    :class="v ? '!opacity-100 !translate-y-0' : ''"
                >
                    <!-- Decorative background pattern (subtle) -->
                    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, #735a2f 1px, transparent 0); background-size: 24px 24px;"></div>
                    
                    <div class="relative z-10 flex flex-col h-full items-center text-center">
                        <span class="material-symbols-outlined text-4xl text-primary mb-4" style="font-variation-settings: 'FILL' 1;">
                            {{ stripos($event->title, 'akad') !== false ? 'mosque' : 'favorite' }}
                        </span>
                        
                        <h3 class="font-headline-md text-[32px] font-medium text-primary mb-2">{{ $event->title }}</h3>
                        
                        <p class="font-body-md text-[16px] text-on-surface-variant mb-6 uppercase tracking-wider">
                            {{ $dayName }}, {{ $dateStr }}
                        </p>
                        
                        <div class="flex flex-col gap-3 mb-8 w-full">
                            @if ($timeStr)
                            <div class="flex items-center justify-center gap-2 text-on-surface">
                                <span class="material-symbols-outlined text-sm">schedule</span>
                                <span class="font-body-md text-[16px]">{{ $timeStr }}</span>
                            </div>
                            @endif
                            
                            @if ($event->location_name)
                            <div class="flex flex-col items-center justify-center gap-1 text-on-surface">
                                <div class="flex items-start justify-center gap-2">
                                    <span class="material-symbols-outlined text-sm mt-1">location_on</span>
                                    <span class="font-body-md text-[16px] font-medium">{{ $event->location_name }}</span>
                                </div>
                                @if ($event->location_address)
                                    <span class="font-body-md text-[14px] text-on-surface-variant max-w-[250px] leading-snug mt-1">{{ $event->location_address }}</span>
                                @endif
                            </div>
                            @endif
                        </div>
                        
                        @if ($event->google_maps_url)
                        <div class="mt-auto w-full flex justify-center">
                            <a class="inline-flex items-center justify-center gap-2 border border-primary text-primary font-label-caps text-[14px] font-semibold tracking-widest uppercase py-3 px-6 hover:bg-primary hover:text-on-primary transition-colors duration-300 w-full rounded-full" href="{{ $event->google_maps_url }}" target="_blank">
                                <span class="material-symbols-outlined text-sm">map</span>
                                Google Maps
                            </a>
                        </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
