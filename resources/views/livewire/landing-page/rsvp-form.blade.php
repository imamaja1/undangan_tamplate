<div class="relative w-full max-w-sm rounded-3xl bg-white/[0.03] px-8 py-10 backdrop-blur-sm border border-champagne/15 shadow-[0_20px_60px_rgba(0,0,0,0.3)]">

    <div class="mb-10 text-center">
        <h3 class="font-sans text-2xl font-light tracking-[0.15em] text-champagne uppercase mb-3">RSVP</h3>
        <p class="text-[12px] font-light leading-relaxed text-softwhite/50">
            Mohon konfirmasi kehadiran Anda sebelum tanggal <span class="text-champagne/70">1 Juli 2027</span>.
        </p>
    </div>

    @if ($isSubmitted)
        <div class="flex flex-col items-center justify-center gap-4 py-8 text-center" x-data x-init="confetti({particleCount: 100, spread: 70, origin: {y: 0.6}, colors: ['#c9b037', '#f0e0a0', '#0a1128']})">
            <div class="flex h-14 w-14 items-center justify-center rounded-full border border-champagne/30 text-champagne">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </div>
            <div>
                <h4 class="font-sans text-lg font-light tracking-[0.1em] text-champagne uppercase">Terima Kasih</h4>
                <p class="mt-2 text-[12px] text-softwhite/50">Konfirmasi kehadiran Anda telah berhasil dikirim.</p>
            </div>
        </div>
    @else
        <form wire:submit="submit" class="flex flex-col gap-8">

            {{-- Nama Lengkap --}}
            <div class="flex flex-col gap-1.5">
                <label for="name" class="text-[10px] font-medium uppercase tracking-[0.25em] text-champagne/60">Nama Lengkap</label>
                <input
                    wire:model="name"
                    type="text"
                    id="name"
                    required
                    placeholder="Tulis nama Anda"
                    class="w-full border-0 border-b border-champagne/20 bg-transparent pb-2 pt-1 text-sm font-light text-softwhite placeholder:text-softwhite/25 focus:border-champagne/60 focus:outline-none focus:ring-0 transition-colors"
                >
                @error('name') <span class="mt-1 text-[11px] text-red-400/80">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                {{-- Jumlah Tamu --}}
                <div class="flex flex-col gap-1.5">
                    <label for="pax" class="text-[10px] font-medium uppercase tracking-[0.25em] text-champagne/60">Jumlah Tamu</label>
                    <select
                        wire:model="pax"
                        id="pax"
                        class="w-full border-0 border-b border-champagne/20 bg-transparent pb-2 pt-1 text-sm font-light text-softwhite focus:border-champagne/60 focus:outline-none focus:ring-0 transition-colors"
                    >
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" class="bg-navy text-softwhite">{{ $i }} Orang</option>
                        @endfor
                    </select>
                </div>

                {{-- Status Kehadiran --}}
                <div class="flex flex-col gap-1.5">
                    <span class="text-[10px] font-medium uppercase tracking-[0.25em] text-champagne/60">Status</span>
                    <div class="flex flex-col gap-3 pt-1.5">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" wire:model="status" value="attending" class="sr-only peer">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-champagne/40 transition-colors peer-checked:border-champagne peer-checked:bg-champagne/10">
                                <span class="h-2.5 w-2.5 rounded-full bg-champagne opacity-0 transition-opacity peer-checked:opacity-100"></span>
                            </span>
                            <span class="text-sm font-light text-softwhite/70 transition-colors peer-checked:text-softwhite">Hadir</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" wire:model="status" value="declined" class="sr-only peer">
                            <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-champagne/40 transition-colors peer-checked:border-champagne peer-checked:bg-champagne/10">
                                <span class="h-2.5 w-2.5 rounded-full bg-champagne opacity-0 transition-opacity peer-checked:opacity-100"></span>
                            </span>
                            <span class="text-sm font-light text-softwhite/70 transition-colors peer-checked:text-softwhite">Tidak Hadir</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Pesan / Harapan --}}
            <div class="flex flex-col gap-1.5">
                <label for="message" class="text-[10px] font-medium uppercase tracking-[0.25em] text-champagne/60">Pesan / Harapan</label>
                <textarea
                    wire:model="message"
                    id="message"
                    rows="2"
                    placeholder="Tulis ucapan selamat"
                    class="w-full border-0 border-b border-champagne/20 bg-transparent pb-2 pt-1 text-sm font-light text-softwhite placeholder:text-softwhite/25 focus:border-champagne/60 focus:outline-none focus:ring-0 transition-colors resize-none"
                ></textarea>
                @error('message') <span class="mt-1 text-[11px] text-red-400/80">{{ $message }}</span> @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="mt-2 w-full rounded-full bg-navy py-3.5 text-[10px] font-medium uppercase tracking-[0.4em] text-champagne border border-champagne/20 transition-all duration-300 hover:bg-champagne hover:text-navy hover:border-champagne hover:tracking-[0.5em] disabled:opacity-50"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Kirim Konfirmasi</span>
                <span wire:loading>Mengirim...</span>
            </button>
        </form>
    @endif
</div>
