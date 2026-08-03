<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-background font-sans text-foreground antialiased flex flex-col md:flex-row">
        
        <!-- Sidebar Desktop -->
        <aside class="hidden w-64 flex-col border-r bg-muted/40 md:flex min-h-screen sticky top-0">
            <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
                <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 font-semibold" />
            </div>
            
            <div class="flex-1 overflow-auto py-4">
                <nav class="grid items-start px-2 text-sm font-medium lg:px-4 gap-1">
                    <div class="px-2 py-2 text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('Platform') }}
                    </div>
                    <a
                        href="{{ route('dashboard') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('dashboard') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-layout-dashboard class="size-4" />
                        {{ __('Dashboard') }}
                    </a>

                    <div class="px-2 py-2 mt-4 text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('Manajemen Undangan') }}
                    </div>

                    <a
                        href="{{ route('admin.invitation') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.invitation*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-settings class="size-4" />
                        {{ __('Pengaturan') }}
                    </a>
                    
                    <a
                        href="{{ route('admin.bride-groom') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.bride-groom*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-users class="size-4" />
                        {{ __('Mempelai') }}
                    </a>
                    
                    <a
                        href="{{ route('admin.love-story') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.love-story*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-heart class="size-4" />
                        {{ __('Cerita Cinta') }}
                    </a>
                    
                    <a
                        href="{{ route('admin.events') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.events*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-calendar class="size-4" />
                        {{ __('Acara') }}
                    </a>
                    
                    <a
                        href="{{ route('admin.gallery') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.gallery*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-image class="size-4" />
                        {{ __('Galeri') }}
                    </a>
                    
                    <a
                        href="{{ route('admin.gifts') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.gifts*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-gift class="size-4" />
                        {{ __('Hadiah') }}
                    </a>

                    <div class="px-2 py-2 mt-4 text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('Tamu & RSVP') }}
                    </div>
                    
                    <a
                        href="{{ route('admin.guest-lists') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.guest-lists*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-book-user class="size-4" />
                        {{ __('Daftar Tamu') }}
                    </a>
                    
                    <a
                        href="{{ route('admin.rsvps') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.rsvps*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-message-square-heart class="size-4" />
                        {{ __('RSVP & Ucapan') }}
                    </a>

                    <a
                        href="{{ route('admin.wa-configs') }}"
                        wire:navigate
                        class="flex items-center gap-3 rounded-lg px-3 py-2 transition-all {{ request()->routeIs('admin.wa-configs*') ? 'bg-muted text-primary' : 'text-muted-foreground hover:text-primary hover:bg-muted/50' }}"
                    >
                        <x-lucide-smartphone class="size-4" />
                        {{ __('WA Config') }}
                    </a>
                </nav>
            </div>
            
            <div class="mt-auto p-4">
                <nav class="grid items-start text-sm font-medium gap-1">
                   
                </nav>
            </div>
            
            <div class="border-t p-4">
                <x-desktop-user-menu />
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex w-full flex-1 flex-col">
            <header class="sticky top-0 z-30 flex h-14 items-center justify-between border-b bg-background px-4 md:hidden">
                <!-- Mobile Menu (Sheet) -->
                <x-ui.sheet>
                    <x-ui.sheet.trigger asChild>
                        <x-ui.button variant="outline" size="icon" class="md:hidden">
                            <x-lucide-menu class="size-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </x-ui.button>
                    </x-ui.sheet.trigger>
                    <x-ui.sheet.content side="left" class="flex flex-col">
                        <nav class="grid gap-2 text-lg font-medium">
                            <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 font-semibold mb-4" />
                            <a
                                href="{{ route('dashboard') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('dashboard') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-layout-dashboard class="size-5" />
                                {{ __('Dashboard') }}
                            </a>
                            
                            <div class="mx-[-0.65rem] px-3 py-2 mt-4 text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                                {{ __('Manajemen Undangan') }}
                            </div>

                            <a
                                href="{{ route('admin.invitation') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.invitation*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-settings class="size-5" />
                                {{ __('Pengaturan') }}
                            </a>
                            
                            <a
                                href="{{ route('admin.bride-groom') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.bride-groom*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-users class="size-5" />
                                {{ __('Mempelai') }}
                            </a>
                            
                            <a
                                href="{{ route('admin.love-story') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.love-story*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-heart class="size-5" />
                                {{ __('Cerita Cinta') }}
                            </a>
                            
                            <a
                                href="{{ route('admin.events') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.events*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-calendar class="size-5" />
                                {{ __('Acara') }}
                            </a>
                            
                            <a
                                href="{{ route('admin.gallery') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.gallery*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-image class="size-5" />
                                {{ __('Galeri') }}
                            </a>
                            
                            <a
                                href="{{ route('admin.gifts') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.gifts*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-gift class="size-5" />
                                {{ __('Hadiah') }}
                            </a>
                            
                            <div class="mx-[-0.65rem] px-3 py-2 mt-4 text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                                {{ __('Tamu & RSVP') }}
                            </div>

                            <a
                                href="{{ route('admin.guest-lists') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.guest-lists*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-book-user class="size-5" />
                                {{ __('Daftar Tamu') }}
                            </a>
                            
                            <a
                                href="{{ route('admin.rsvps') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.rsvps*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-message-square-heart class="size-5" />
                                {{ __('RSVP & Ucapan') }}
                            </a>

                            <a
                                href="{{ route('admin.wa-configs') }}"
                                wire:navigate
                                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 {{ request()->routeIs('admin.wa-configs*') ? 'bg-muted text-foreground' : 'text-muted-foreground hover:text-foreground' }}"
                            >
                                <x-lucide-smartphone class="size-5" />
                                {{ __('WA Config') }}
                            </a>
                        </nav>
                    </x-ui.sheet.content>
                </x-ui.sheet>
                
                <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="md:hidden" />
                
                <div class="w-10">
                    <x-desktop-user-menu />
                </div>
            </header>
            
            <main class="flex-1 p-4 md:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>

        <!-- Toasts -->
        <div
            x-data="{
                toasts: [],
                push(message, type = 'success') {
                    const id = Date.now() + Math.random();

                    this.toasts.push({ id, message, type });

                    setTimeout(() => this.remove(id), 4000);
                },
                remove(id) {
                    this.toasts = this.toasts.filter((toast) => toast.id !== id);
                },
            }"
            @toast.window="push($event.detail.message, $event.detail.type ?? 'success')"
            class="pointer-events-none fixed bottom-4 right-4 z-50 flex w-full max-w-sm flex-col gap-2"
        >
            <template x-for="toast in toasts" :key="toast.id">
                <div
                    class="pointer-events-auto flex items-start gap-3 rounded-lg border bg-card p-4 text-sm shadow-lg"
                    :class="toast.type === 'danger' ? 'border-destructive/40' : 'border-border'"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                >
                    <x-lucide-check-circle class="size-5 shrink-0 text-primary" x-show="toast.type !== 'danger'" />
                    <x-lucide-alert-circle class="size-5 shrink-0 text-destructive" x-show="toast.type === 'danger'" />
                    <p class="flex-1 pt-0.5" x-text="toast.message"></p>
                    <button type="button" class="text-muted-foreground transition-colors hover:text-foreground" @click="remove(toast.id)">
                        <x-lucide-x class="size-4" />
                    </button>
                </div>
            </template>
        </div>
        <!-- Page Loading Overlay -->
        <div
            x-data="{ loading: false, timeout: null }"
            x-on:livewire:navigate.window="timeout = setTimeout(() => loading = true, 200)"
            x-on:livewire:navigated.window="clearTimeout(timeout); loading = false"
            x-show="loading"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="pointer-events-none fixed inset-0 z-[100] flex items-center justify-center bg-background/80 backdrop-blur-sm"
        >
            <div class="flex flex-col items-center gap-3">
                <div class="size-8 rounded-full border-2 border-primary border-t-transparent animate-spin"></div>
                <p class="text-sm text-muted-foreground">Memuat...</p>
            </div>
        </div>
    </body>
</html>
