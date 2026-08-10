<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-[#1D274D]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'The Wedding - Editorial Issue')</title>
        @yield('meta')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Inter:wght@200;300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Typography */
            .font-playfair   { font-family: 'Playfair Display', serif; }
            .font-cormorant  { font-family: 'Cormorant Garamond', serif; }
            .font-inter      { font-family: 'Inter', sans-serif; }

            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 3px; }
            ::-webkit-scrollbar-track { background: #1D274D; }
            ::-webkit-scrollbar-thumb { background: #D8C4A6; border-radius: 9999px; }

            /* Animation: Fade Up */
            .anim-fade-up {
                opacity: 0;
                transform: translateY(24px);
                transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);
            }
            .anim-fade-up.is-visible { opacity: 1; transform: translateY(0); }

            /* Animation: Fade In */
            .anim-fade-in {
                opacity: 0;
                transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1);
            }
            .anim-fade-in.is-visible { opacity: 1; }

            /* Divider Champagne Gold */
            .divider-gold {
                display: block;
                width: 48px;
                height: 1px;
                background: linear-gradient(90deg, transparent, #D8C4A6, transparent);
                margin: 0 auto;
            }

            /* Section Header Tag */
            .section-label {
                font-family: 'Inter', sans-serif;
                font-size: 9px;
                font-weight: 500;
                letter-spacing: 0.45em;
                text-transform: uppercase;
                color: #D8C4A6;
            }

            /* Deep Navy Pearl Card (24px rounded) */
            .navy-card {
                background-color: #F9F9FD;
                color: #1D274D;
                border-radius: 24px;
                border: 1px solid rgba(216, 196, 166, 0.25);
                box-shadow: 0 15px 35px -5px rgba(10, 15, 35, 0.3);
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .navy-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 20px 40px -5px rgba(10, 15, 35, 0.4);
            }

            .navy-dark-card {
                background-color: #151E3D;
                color: #F9F9FD;
                border-radius: 24px;
                border: 1px solid rgba(216, 196, 166, 0.15);
                box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.4);
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .navy-dark-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.5);
            }

            /* Glassmorphism utility */
            .glass-panel {
                background: rgba(29, 39, 77, 0.65);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(216, 196, 166, 0.2);
            }

            /* Image Grayscale to Color Micro-interaction */
            .img-editorial {
                filter: grayscale(80%) contrast(1.05);
                transition: filter 0.7s ease, transform 0.7s ease;
            }
            .group:hover .img-editorial, .img-editorial:hover {
                filter: grayscale(0%) contrast(1);
                transform: scale(1.02);
            }

            /* Global Cursor Pointer */
            a, button, select, label, input[type="submit"], input[type="button"], input[type="radio"], input[type="checkbox"], [role="button"] {
                cursor: pointer !important;
            }

            /* Livewire Overrides for Template 3 Deep Navy & Pearl */
            .bg-navy {
                background-color: #F9F9FD !important;
                color: #1D274D !important;
                border-radius: 24px !important;
                border: 1px solid rgba(216, 196, 166, 0.25) !important;
            }
            .border-champagne\/20, .border-champagne\/15 {
                border-color: rgba(216, 196, 166, 0.25) !important;
            }
            .hover\:border-champagne\/40:hover {
                border-color: #D8C4A6 !important;
            }
            .text-champagne, .text-champagne\/60 {
                color: #D8C4A6 !important;
            }
            .ring-champagne\/50 {
                --tw-ring-color: #D8C4A6 !important;
            }
            .text-champagne\/40 {
                color: rgba(216, 196, 166, 0.6) !important;
            }
            .text-softwhite\/80, .text-softwhite\/50, .text-softwhite\/70, .text-softwhite {
                color: #1D274D !important;
            }

            /* RSVP Form Overrides */
            .rounded-3xl.bg-white\/\[0\.03\] {
                background-color: #F9F9FD !important;
                border-radius: 24px !important;
                border: 1px solid rgba(216, 196, 166, 0.25) !important;
                padding: 2.25rem !important;
                box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.3) !important;
            }

            input[type="text"], textarea, select#pax {
                color: #1D274D !important;
                border-bottom: 1px solid rgba(216, 196, 166, 0.4) !important;
            }
            input::placeholder, textarea::placeholder {
                color: #7A859E !important;
            }

            /* Livewire Submit Buttons */
            .bg-navy.py-3\.5, .rounded-full.bg-gradient-to-r {
                background: #1D274D !important;
                border: 1px solid rgba(216, 196, 166, 0.4) !important;
                color: #F9F9FD !important;
                border-radius: 14px !important;
                text-transform: uppercase !important;
                font-family: 'Inter', sans-serif !important;
                font-weight: 700 !important;
                letter-spacing: 0.35em !important;
                font-size: 8.5px !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            }
            .bg-navy.py-3\.5:hover, .rounded-full.bg-gradient-to-r:hover {
                background: #D8C4A6 !important;
                border-color: #D8C4A6 !important;
                color: #1D274D !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 12px rgba(216, 196, 166, 0.2) !important;
            }

            /* ACCESSIBILITY: Fix contrast for Gold labels inside white RSVP form */
            .rounded-3xl.bg-white\/\[0\.03\] .text-champagne,
            .rounded-3xl.bg-white\/\[0\.03\] .text-champagne\/60,
            .rounded-3xl.bg-white\/\[0\.03\] .text-champagne\/40 {
                color: #1D274D !important;
                font-weight: 700 !important;
            }

            /* ACCESSIBILITY: Fix contrast for Initials avatar inside white Wishes card */
            .bg-champagne.text-navy, .bg-champagne {
                background-color: #1D274D !important;
                color: #F9F9FD !important;
                border: 1px solid rgba(216, 196, 166, 0.3) !important;
            }
        </style>
    </head>
    <body
        class="bg-[#1D274D] text-[#F9F9FD] antialiased font-inter selection:bg-[#D8C4A6] selection:text-[#1D274D]"
        x-data="{ loaded: false }"
        x-init="window.addEventListener('load', () => setTimeout(() => loaded = true, 800))"
    >
        {{-- Deep Navy Preloader --}}
        <div
            x-show="!loaded"
            x-transition:leave="transition duration-[1000ms] ease-in-out"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[200] mx-auto flex max-w-md flex-col items-center justify-center bg-[#1D274D]"
        >
            <div class="glass-panel p-8 text-center rounded-3xl max-w-[280px]">
                <p class="font-inter text-[8px] uppercase tracking-[0.5em] text-[#D8C4A6] mb-3">Editorial Edition</p>
                <span class="divider-gold mb-4"></span>
                <p class="font-playfair text-2xl italic text-[#F9F9FD]">The Wedding</p>
                <p class="font-cormorant text-xs italic text-[#D8C4A6]/80 mt-2">Deep Navy Collection</p>
            </div>
        </div>

        <main class="relative mx-auto flex min-h-dvh w-full max-w-md flex-col overflow-hidden bg-[#1D274D] shadow-2xl">
            {{-- Velvet Texture Overlay --}}
            <div class="pointer-events-none fixed inset-0 z-0 h-full w-full opacity-30 mix-blend-overlay" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>
            
            <div class="relative z-10">
                @yield('content')
            </div>
        </main>
    </body>
</html>
