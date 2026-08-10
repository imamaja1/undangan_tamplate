<div>
@if ($theme === 'template-2')
    <div>
        <div class="text-center mb-6">
            <h2 class="font-display-lg-mobile text-[40px] font-semibold text-[#a38222] mb-2 tracking-tight">Konfirmasi Kehadiran</h2>
            <p class="font-body-md text-[16px] text-[#32302a]">Kami menantikan kehadiran Anda.</p>
        </div>

        @if ($isSubmitted)
            <div class="flex flex-col items-center justify-center gap-4 py-8 text-center relative z-10" x-data x-init="typeof confetti !== 'undefined' && confetti({particleCount: 100, spread: 70, origin: {y: 0.6}, colors: ['#a38222', '#ffffff', '#e4e2d3']})">
                <div class="flex h-16 w-16 items-center justify-center rounded-full border border-[#a38222] text-[#a38222] bg-[#e4e2d3]/30">
                    <span class="material-symbols-outlined text-3xl">check</span>
                </div>
                <div>
                    <h4 class="font-display-lg-mobile text-2xl font-bold text-[#a38222] uppercase mt-4">Terima Kasih</h4>
                    <p class="mt-2 font-body-md text-[16px] text-[#32302a]">Konfirmasi kehadiran Anda telah berhasil dikirim.</p>
                </div>
            </div>
        @else
            <form wire:submit="submit" class="space-y-4">
                <!-- Name Field -->
                <div>
                    <label class="block font-label-caps text-[12px] font-semibold tracking-[0.15em] text-[#a38222] mb-1">Nama Lengkap</label>
                    <input wire:model="name" class="w-full bg-[#f2ede5]/50 border-0 border-b border-[#a38222] text-[#32302a] placeholder:text-[#7a7768] focus:ring-0 focus:border-[#a38222] transition-colors py-2 px-1 font-body-lg text-[18px]" placeholder="Masukkan nama Anda" type="text" required />
                    @error('name') <span class="mt-1 text-[11px] text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Guest Count Field -->
                <div>
                    <label class="block font-label-caps text-[12px] font-semibold tracking-[0.15em] text-[#a38222] mb-1">Jumlah Tamu</label>
                    <select wire:model="pax" class="w-full bg-[#f2ede5]/50 border-0 border-b border-[#a38222] text-[#32302a] focus:ring-0 focus:border-[#a38222] transition-colors py-2 px-1 font-body-lg text-[18px] appearance-none">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" class="text-[#1e1b16]">{{ $i }} Orang</option>
                        @endfor
                    </select>
                </div>

                <!-- Attendance Status -->
                <div>
                    <label class="block font-label-caps text-[12px] font-semibold tracking-[0.15em] text-[#a38222] mb-2">Status Kehadiran</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center cursor-pointer group relative">
                            <input wire:model="status" class="peer absolute opacity-0" name="attendance" type="radio" value="attending" required />
                            <div class="w-4 h-4 rounded-full border border-[#a38222] mr-2 flex items-center justify-center radio-circle peer-checked:bg-[#a38222]">
                                <div class="w-2 h-2 rounded-full bg-[#fef9f0] opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                            <span class="font-body-md text-[16px] text-[#32302a]/80 group-hover:text-[#32302a] transition-colors">Hadir</span>
                        </label>
                        <label class="flex items-center cursor-pointer group relative">
                            <input wire:model="status" class="peer absolute opacity-0" name="attendance" type="radio" value="declined" />
                            <div class="w-4 h-4 rounded-full border border-[#a38222] mr-2 flex items-center justify-center radio-circle peer-checked:bg-[#a38222]">
                                <div class="w-2 h-2 rounded-full bg-[#fef9f0] opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                            <span class="font-body-md text-[16px] text-[#32302a]/80 group-hover:text-[#32302a] transition-colors">Tidak Hadir</span>
                        </label>
                    </div>
                    @error('status') <span class="mt-1 text-[11px] text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Separator for Ucapan -->
                <div class="pt-8 mt-8 border-t border-[#a38222]/30">
                    <h2 class="font-display-lg-mobile text-[40px] font-semibold text-[#a38222] mb-6 text-center tracking-tight">Ucapan & Doa</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block font-label-caps text-[12px] font-semibold tracking-[0.15em] text-[#a38222] mb-1">Pesan</label>
                            <textarea wire:model="message" class="w-full bg-[#f2ede5]/50 border-0 border-b border-[#a38222] text-[#32302a] placeholder:text-[#7a7768] focus:ring-0 focus:border-[#a38222] transition-colors py-2 px-1 font-body-lg text-[18px] resize-none" placeholder="Tuliskan ucapan Anda di sini..." rows="3"></textarea>
                            @error('message') <span class="mt-1 text-[11px] text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <button wire:loading.attr="disabled" class="w-full bg-transparent border border-[#a38222] text-[#a38222] font-label-caps text-[12px] font-semibold tracking-[1.5px] py-3 px-6 rounded hover:bg-[#a38222]/10 transition-colors uppercase mt-4 flex justify-center items-center gap-2" type="submit">
                            <span wire:loading.remove>Kirim Ucapan</span>
                            <span wire:loading>Mengirim...</span>
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
@else
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
@endif
</div>
