<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-[#FAF7F2]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'The Wedding - Exclusive Edition')</title>
        @yield('meta')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <style>
            /* Typography */
            .font-playfair   { font-family: 'Playfair Display', serif; }
            .font-cormorant  { font-family: 'Cormorant Garamond', serif; }
            .font-inter      { font-family: 'Inter', sans-serif; }

            /* Scrollbar */
            ::-webkit-scrollbar { width: 3px; }
            ::-webkit-scrollbar-track { background: #FAF7F2; }
            ::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 9999px; }

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

            /* Thin warm gold divider */
            .divider-gold {
                display: block;
                width: 48px;
                height: 1px;
                background: linear-gradient(90deg, transparent, #C59B27, transparent);
                margin: 0 auto;
            }

            /* Magazine Section Tag / Label */
            .section-label {
                font-family: 'Inter', sans-serif;
                font-size: 9px;
                font-weight: 500;
                letter-spacing: 0.45em;
                text-transform: uppercase;
                color: #C59B27;
            }

            /* Warm Editorial Magazine Card */
            .magazine-card {
                background: #FFFFFF;
                border: 1px solid #E8DFD1;
                box-shadow: 0 10px 35px -5px rgba(44, 37, 35, 0.05);
                position: relative;
                border-radius: 4px;
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .magazine-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 45px -5px rgba(44, 37, 35, 0.08);
            }
            .magazine-card-inset {
                border: 1px solid #F0E8DC;
                margin: 6px;
            }

            /* Force cursor pointer on interactive elements */
            a, button, select, label, input[type="submit"], input[type="button"], input[type="radio"], input[type="checkbox"], [role="button"] {
                cursor: pointer !important;
            }

            /* Livewire Overrides for Warm Theme */
            .bg-navy {
                background-color: #FFFFFF !important;
                border: 1px solid #E8DFD1 !important;
                box-shadow: 0 10px 30px -5px rgba(44, 37, 35, 0.04) !important;
                border-radius: 4px !important;
            }
            .border-champagne\/20, .border-champagne\/15 {
                border-color: #E8DFD1 !important;
            }
            .hover\:border-champagne\/40:hover {
                border-color: #C59B27 !important;
            }
            .text-champagne, .text-champagne\/60 {
                color: #C59B27 !important;
            }
            .ring-champagne\/50 {
                --tw-ring-color: #C59B27 !important;
            }
            .text-champagne\/40 {
                color: #7A6F6C !important;
            }
            .text-softwhite\/80, .text-softwhite\/50, .text-softwhite\/70, .text-softwhite {
                color: #2C2523 !important;
            }

            /* RSVP Form Cards */
            .rounded-3xl.bg-white\/\[0\.03\] {
                background-color: #FFFFFF !important;
                border-radius: 4px !important;
                border: 1px solid #E8DFD1 !important;
                padding: 2rem !important;
                box-shadow: 0 12px 35px -5px rgba(44, 37, 35, 0.06) !important;
            }

            /* Inputs inside Warm Theme */
            input[type="text"], textarea, select#pax {
                color: #2C2523 !important;
                border-bottom: 1px solid #E8DFD1 !important;
            }
            input::placeholder, textarea::placeholder {
                color: #A39793 !important;
            }

            /* Buttons inside Livewire */
            .bg-navy.py-3\.5, .rounded-full.bg-gradient-to-r {
                background: #2C2523 !important;
                border: 1px solid #2C2523 !important;
                color: #FAF7F2 !important;
                border-radius: 2px !important;
                text-transform: uppercase !important;
                font-family: 'Inter', sans-serif !important;
                font-weight: 500 !important;
                letter-spacing: 0.35em !important;
                font-size: 9px !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            }
            .bg-navy.py-3\.5:hover, .rounded-full.bg-gradient-to-r:hover {
                background: #C59B27 !important;
                border-color: #C59B27 !important;
                color: #FFFFFF !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 12px rgba(197, 155, 39, 0.25) !important;
            }
        </style>
    </head>
    <body class="bg-[#FAF7F2] text-[#2C2523] antialiased font-inter">
        <div 
            x-data="{ loaded: false }"
            x-init="window.addEventListener('load', () => setTimeout(() => loaded = true, 800))"
        >
            {{-- Preloader (Style Template 1) --}}
            <div 
                x-show="!loaded"
                x-transition:leave="transition ease-in-out duration-700"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-[200] mx-auto flex max-w-md flex-col items-center justify-center bg-[#380e14]"
            >
                <div class="relative flex items-center justify-center">
                    <div class="absolute h-20 w-20 animate-[spin_3s_linear_infinite] rounded-full border-t-2 border-b-2 border-[#f2ca50]/60"></div>
                    <div class="absolute h-14 w-14 animate-[spin_2s_linear_infinite_reverse] rounded-full border-r-2 border-l-2 border-[#f2ca50]/40"></div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f2ca50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse">
                        <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1.1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.9 7.9 7.9-7.9 1-1a5.5 5.5 0 000-7.8z"/>
                    </svg>
                </div>
                <p class="mt-6 font-inter text-[9px] font-semibold uppercase tracking-[0.4em] text-[#f2ca50]/80 animate-pulse">Memuat Undangan</p>
            </div>

            <main class="relative mx-auto flex min-h-dvh w-full max-w-md flex-col overflow-hidden bg-[#FAF7F2] shadow-2xl border-x border-[#E8DFD1]/60">
                <div class="relative z-10">
                    @yield('content')
                </div>
            </main>
        </div>
        @livewireScripts
    </body>
</html>
