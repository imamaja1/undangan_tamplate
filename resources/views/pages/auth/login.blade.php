<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <x-passkey-verify />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div class="grid gap-2">
                <x-ui.label for="email">{{ __('Email address') }}</x-ui.label>
                <x-ui.input
                    id="email"
                    name="email"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                />
                @error('email')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="grid gap-2">
                <div class="flex items-center">
                    <x-ui.label for="password">{{ __('Password') }}</x-ui.label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate class="ml-auto inline-block text-sm underline-offset-4 hover:underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <x-ui.input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                />
                @error('password')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center space-x-2">
                <x-ui.checkbox id="remember" name="remember" :checked="old('remember')" />
                <label for="remember" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                    {{ __('Remember me') }}
                </label>
            </div>

            <x-ui.button type="submit" class="w-full" data-test="login-button">
                {{ __('Log in') }}
            </x-ui.button>
        </form>

        <div class="text-center text-sm text-muted-foreground space-x-1 rtl:space-x-reverse">
            <span>{{ __('Don\'t have an account?') }}</span>
            <a href="{{ route('register') }}" wire:navigate class="underline underline-offset-4 hover:text-primary">
                {{ __('Sign up') }}
            </a>
        </div>
    </div>
</x-layouts::auth>
