<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet"/>
<style>
    .font-label-caps { font-family: 'Montserrat', sans-serif; }
    .font-display-lg, .font-display-lg-mobile, .font-headline-md, .font-body-md { font-family: 'EB Garamond', serif; }
    
    /* Custom RSVP Radio */
    input[type="radio"]:checked + div .radio-circle {
        background-color: #a38222;
        border-color: #a38222;
    }
    .radio-circle {
        transition: all 0.2s ease-in-out;
    }
</style>

<section class="bg-[#fef9f0] text-[#32302a] py-12 px-4 overflow-hidden flex flex-col justify-center">
    <div class="w-full max-w-md mx-auto relative z-10">
        <!-- Divider -->
        <div class="flex items-center justify-center mb-8 opacity-0 translate-y-8 transition-all duration-1000"
            x-data="{ v: false }" x-intersect="v = true" :class="v ? '!opacity-100 !translate-y-0' : ''">
            <div class="h-[1px] bg-gradient-to-r from-transparent via-[#a38222] to-transparent w-1/3"></div>
            <span class="material-symbols-outlined text-[#a38222] mx-2 text-sm">diamond</span>
            <div class="h-[1px] bg-gradient-to-r from-transparent via-[#a38222] to-transparent w-1/3"></div>
        </div>

        <div class="grid grid-cols-1 gap-8 items-start w-full">
            <div class="bg-[#e4e2d3]/30 backdrop-blur-md p-6 md:p-8 rounded-xl border border-[#a38222]/30 opacity-0 translate-y-8 transition-all duration-1000"
                x-data="{ v: false }" x-intersect="v = true" :class="v ? '!opacity-100 !translate-y-0' : ''">
                
                <!-- Livewire Form (Includes both RSVP & Message submit) -->
                @livewire('landing-page.rsvp-form', ['invitation' => $invitation, 'theme' => 'template-2'])
            </div>
        </div>
    </div>
</section>
