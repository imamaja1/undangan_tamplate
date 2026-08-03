<div class="relative w-full max-w-sm rounded-3xl p-8 bg-white shadow-[0_20px_60px_rgba(0,0,0,0.3)] border border-champagne/30">

    <div class="mb-8 text-center">
        <h3 class="font-display text-4xl italic text-navy mb-3">RSVP</h3>
        <p class="text-[13px] font-light leading-relaxed text-navy/60">
            Mohon konfirmasi kehadiran Anda sebelum tanggal <span class="font-medium">1 Juli 2027</span>.
        </p>
    </div>

    @if ($isSubmitted)
        <div class="flex flex-col items-center justify-center gap-4 py-8 text-center" x-data x-init="confetti({particleCount: 100, spread: 70, origin: {y: 0.6}, colors: ['#c9b037', '#f0e0a0', '#0a1128']})">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-50 text-green-600 ring-1 ring-green-500/20">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </div>
            <div>
                <h4 class="font-display text-xl text-navy">Terima Kasih!</h4>
                <p class="mt-2 text-sm text-navy/60">Konfirmasi kehadiran Anda telah berhasil dikirim.</p>
            </div>
        </div>
    @else
        <form wire:submit="submit" class="flex flex-col gap-6">

            {{-- Nama Lengkap --}}
            <div class="flex flex-col gap-2">
                <label for="name" class="text-[10px] font-semibold uppercase tracking-[0.2em] text-navy/50">Nama Lengkap</label>
                <input
                    wire:model="name"
                    type="text"
                    id="name"
                    required
                    placeholder="Tulis nama Anda"
                    class="rounded-xl border border-champagne/30 bg-navy/5 px-4 py-3 text-sm text-navy placeholder:text-navy/30 focus:border-champagne focus:outline-none focus:ring-1 focus:ring-champagne"
                >
                @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- Jumlah Tamu --}}
                <div class="flex flex-col gap-2">
                    <label for="pax" class="text-[10px] font-semibold uppercase tracking-[0.2em] text-navy/50">Jumlah Tamu</label>
                    <select
                        wire:model="pax"
                        id="pax"
                        class="rounded-xl border border-champagne/30 bg-navy/5 px-4 py-3 text-sm text-navy focus:border-champagne focus:outline-none focus:ring-1 focus:ring-champagne"
                    >
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }} Orang</option>
                        @endfor
                    </select>
                </div>

                {{-- Status Kehadiran --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-semibold uppercase tracking-[0.2em] text-navy/50">Status Kehadiran</label>
                    <div class="flex flex-col gap-2 pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="status" value="attending" class="h-4 w-4 border-champagne text-navy focus:ring-champagne">
                            <span class="text-sm text-navy">Hadir</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="status" value="declined" class="h-4 w-4 border-champagne text-navy focus:ring-champagne">
                            <span class="text-sm text-navy">Tidak Hadir</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Pesan / Harapan --}}
            <div class="flex flex-col gap-2">
                <label for="message" class="text-[10px] font-semibold uppercase tracking-[0.2em] text-navy/50">Pesan/Harapan</label>
                <textarea
                    wire:model="message"
                    id="message"
                    rows="3"
                    placeholder="Tulis ucapan selamat"
                    class="rounded-xl border border-champagne/30 bg-navy/5 px-4 py-3 text-sm text-navy placeholder:text-navy/30 focus:border-champagne focus:outline-none focus:ring-1 focus:ring-champagne"
                ></textarea>
                @error('message') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="mt-2 w-full rounded-xl bg-navy py-3.5 text-[11px] font-bold uppercase tracking-[0.3em] text-champagne transition-all duration-300 hover:bg-champagne hover:text-navy hover:shadow-[0_4px_20px_rgba(201,176,55,0.4)] disabled:opacity-70 disabled:hover:scale-100"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Kirim Konfirmasi</span>
                <span wire:loading>Mengirim...</span>
            </button>
        </form>
    @endif
</div>
