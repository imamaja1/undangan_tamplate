<x-layouts::auth :title="__('Forgot password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div class="grid gap-2">
                <x-ui.label for="email">{{ __('Email address') }}</x-ui.label>
                <x-ui.input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autofocus
                    placeholder="email@example.com"
                />
                @error('email')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <x-ui.button type="submit" class="w-full" data-test="email-password-reset-link-button">
                {{ __('Email password reset link') }}
            </x-ui.button>
        </form>

        <div class="text-center text-sm text-muted-foreground space-x-1 rtl:space-x-reverse">
            <span>{{ __('Or, return to') }}</span>
            <a href="{{ route('login') }}" wire:navigate class="underline underline-offset-4 hover:text-primary">
                {{ __('log in') }}
            </a>
        </div>
    </div>
</x-layouts::auth>
