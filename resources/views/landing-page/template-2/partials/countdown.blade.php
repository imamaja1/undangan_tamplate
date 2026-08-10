@if ($mainEvent)
    @php
        $targetDate = \Carbon\Carbon::parse(
            $mainEvent->event_date instanceof \Carbon\Carbon
                ? $mainEvent->event_date->format('Y-m-d')
                : $mainEvent->event_date
        )->toDateString() . 'T' . ($mainEvent->start_time ?? '00:00');
    @endphp
    <div
        x-data="{
            days: '00', hours: '00', mins: '00', secs: '00', _t: null,
            init() {
                const end = new Date('{{ $targetDate }}').getTime();
                const tick = () => {
                    const diff = Math.max(0, end - Date.now());
                    this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
                    this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                    this.mins = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                    this.secs = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
                };
                tick(); this._t = setInterval(tick, 1000);
            },
            destroy() { clearInterval(this._t); }
        }"
        class="flex items-center justify-center gap-6 py-6 border-y border-[#E8DFD1] my-4 w-full max-w-[240px]"
    >
        <div class="flex flex-col items-center gap-1">
            <span class="font-cormorant text-3xl font-semibold leading-none text-[#2C2523] tabular-nums" x-text="days">00</span>
            <span class="font-inter text-[8px] font-medium uppercase tracking-[0.3em] text-[#C59B27]">Hari</span>
        </div>
        <div class="h-6 w-px bg-[#E8DFD1]"></div>
        <div class="flex flex-col items-center gap-1">
            <span class="font-cormorant text-3xl font-semibold leading-none text-[#2C2523] tabular-nums" x-text="hours">00</span>
            <span class="font-inter text-[8px] font-medium uppercase tracking-[0.3em] text-[#C59B27]">Jam</span>
        </div>
        <div class="h-6 w-px bg-[#E8DFD1]"></div>
        <div class="flex flex-col items-center gap-1">
            <span class="font-cormorant text-3xl font-semibold leading-none text-[#2C2523] tabular-nums" x-text="mins">00</span>
            <span class="font-inter text-[8px] font-medium uppercase tracking-[0.3em] text-[#C59B27]">Menit</span>
        </div>
    </div>
@endif
