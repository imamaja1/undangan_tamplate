<style>
    /* Scrollbar for comments */
    .custom-scrollbar::-webkit-scrollbar {
        width: 0px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(163, 130, 34, 0.3);
        border-radius: 4px;
    }
</style>

<section class="bg-[#fef9f0] text-[#32302a] py-12 px-4 overflow-hidden flex flex-col justify-center">
    <div class="w-full max-w-md mx-auto relative z-10">
        <div class="grid grid-cols-1 gap-8 items-start w-full">
            <div class="bg-[#e4e2d3]/30 backdrop-blur-md p-6 md:p-8 rounded-xl border border-[#a38222]/30 opacity-0 translate-y-8 transition-all duration-1000"
                x-data="{ v: false }" x-intersect="v = true" :class="v ? '!opacity-100 !translate-y-0' : ''">
                
                <h2 class="font-display-lg-mobile text-[32px] font-semibold text-[#a38222] mb-4 text-center tracking-tight">Daftar Ucapan</h2>
                
                <!-- Livewire Wishes List -->
                @livewire('landing-page.wishes-list', ['invitation' => $invitation, 'theme' => 'template-2'])
            </div>
        </div>

        <!-- Bottom Decorative Divider -->
        <div class="flex items-center justify-center mt-12 opacity-0 translate-y-8 transition-all duration-1000"
            x-data="{ v: false }" x-intersect="v = true" :class="v ? '!opacity-100 !translate-y-0' : ''">
            <div class="h-[1px] bg-gradient-to-r from-transparent via-[#a38222] to-transparent w-1/3"></div>
        </div>
    </div>
</section>
