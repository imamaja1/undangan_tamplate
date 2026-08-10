@php
    $target = null;

    if ($mainEvent?->event_date) {
        $target = $mainEvent->event_date->format('Y-m-d').'T'.($mainEvent->start_time ?? '00:00');
    }
@endphp

@if ($target)
    <div
        x-data="countdown('{{ $target }}')"
        class="flex items-center justify-center gap-6 px-4"
    >
        <div class="flex flex-col items-center gap-2">
            <span x-text="days" class="font-display text-3xl font-medium tabular-nums text-[#FAF6F0]">00</span>
            <span class="text-[9px] font-medium uppercase tracking-[0.3em] text-[#D4AF37]/70">Days</span>
        </div>

        <div class="h-10 w-px bg-[#D4AF37]/30"></div>

        <div class="flex flex-col items-center gap-2">
            <span x-text="hours" class="font-display text-3xl font-medium tabular-nums text-[#FAF6F0]">00</span>
            <span class="text-[9px] font-medium uppercase tracking-[0.3em] text-[#D4AF37]/70">Hours</span>
        </div>

        <div class="h-10 w-px bg-[#D4AF37]/30"></div>

        <div class="flex flex-col items-center gap-2">
            <span x-text="mins" class="font-display text-3xl font-medium tabular-nums text-[#FAF6F0]">00</span>
            <span class="text-[9px] font-medium uppercase tracking-[0.3em] text-[#D4AF37]/70">Mins</span>
        </div>
    </div>
@endif
