@if ($mainEvent)
    @php
        $targetDate = \Carbon\Carbon::parse(
            $mainEvent->event_date instanceof \Carbon\Carbon
                ? $mainEvent->event_date->format('Y-m-d')
                : $mainEvent->event_date
        )->toDateString() . 'T' . ($mainEvent->start_time ?? '00:00');
    @endphp
    
    <div
        x-data="countdown('{{ $targetDate }}')"
        class="mt-6 flex w-full max-w-[200px] items-center justify-center gap-6"
    >
        <div class="flex flex-col items-center">
            <span class="font-display text-[22px] font-semibold tracking-wider text-white tabular-nums" x-text="days">00</span>
            <span class="mt-1.5 font-inter text-[7.5px] font-bold uppercase tracking-[0.25em] text-[#D8C4A6]">Hari</span>
        </div>
        
        <div class="h-6 w-px bg-white/30"></div>
        
        <div class="flex flex-col items-center">
            <span class="font-display text-[22px] font-semibold tracking-wider text-white tabular-nums" x-text="hours">00</span>
            <span class="mt-1.5 font-inter text-[7.5px] font-bold uppercase tracking-[0.25em] text-[#D8C4A6]">Jam</span>
        </div>
        
        <div class="h-6 w-px bg-white/30"></div>
        
        <div class="flex flex-col items-center">
            <span class="font-display text-[22px] font-semibold tracking-wider text-white tabular-nums" x-text="mins">00</span>
            <span class="mt-1.5 font-inter text-[7.5px] font-bold uppercase tracking-[0.25em] text-[#D8C4A6]">Menit</span>
        </div>
    </div>
@endif
