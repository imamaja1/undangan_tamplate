<div class="flex flex-col md:flex-row items-start">
    <div class="w-full md:w-[220px] pb-4 md:pe-10 shrink-0">
        <nav aria-label="{{ __('Settings') }}" class="flex flex-col space-y-1">
            <a href="{{ route('profile.edit') }}" wire:navigate class="px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('profile.edit') ? 'bg-accent text-accent-foreground' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }}">
                {{ __('Profile') }}
            </a>
            <a href="{{ route('security.edit') }}" wire:navigate class="px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('security.edit') ? 'bg-accent text-accent-foreground' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }}">
                {{ __('Security') }}
            </a>
            <a href="{{ route('appearance.edit') }}" wire:navigate class="px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('appearance.edit') ? 'bg-accent text-accent-foreground' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }}">
                {{ __('Appearance') }}
            </a>
        </nav>
    </div>

    <div class="md:hidden w-full h-px bg-border my-4"></div>

    <div class="flex-1 w-full self-stretch max-md:pt-2">
        @if(isset($heading))
            <h2 class="text-2xl font-semibold tracking-tight">{{ $heading }}</h2>
        @endif
        @if(isset($subheading))
            <p class="text-sm text-muted-foreground mt-1">{{ $subheading }}</p>
        @endif

        <div class="mt-6 w-full max-w-2xl">
            {{ $slot }}
        </div>
    </div>
</div>
