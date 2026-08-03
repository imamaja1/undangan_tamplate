<x-layouts::auth :title="__('Register')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <div class="grid gap-2">
                <x-ui.label for="name">{{ __('Name') }}</x-ui.label>
                <x-ui.input
                    id="name"
                    name="name"
                    :value="old('name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Full name')"
                />
                @error('name')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="grid gap-2">
                <x-ui.label for="email">{{ __('Email address') }}</x-ui.label>
                <x-ui.input
                    id="email"
                    name="email"
                    :value="old('email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />
                @error('email')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="grid gap-2">
                <x-ui.label for="password">{{ __('Password') }}</x-ui.label>
                <x-ui.input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                />
                @error('password')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="grid gap-2">
                <x-ui.label for="password_confirmation">{{ __('Confirm password') }}</x-ui.label>
                <x-ui.input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                />
                @error('password_confirmation')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <x-ui.button type="submit" class="w-full" data-test="register-user-button">
                {{ __('Create account') }}
            </x-ui.button>
        </form>

        <div class="text-center text-sm text-muted-foreground space-x-1 rtl:space-x-reverse">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" wire:navigate class="underline underline-offset-4 hover:text-primary">
                {{ __('Log in') }}
            </a>
        </div>
    </div>
</x-layouts::auth>
