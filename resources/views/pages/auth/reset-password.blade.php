<x-layouts::auth :title="__('Reset password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Reset password')" :description="__('Please enter your new password below')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email Address -->
            <div class="grid gap-2">
                <x-ui.label for="email">{{ __('Email') }}</x-ui.label>
                <x-ui.input
                    id="email"
                    name="email"
                    value="{{ request('email') }}"
                    type="email"
                    required
                    autocomplete="email"
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

            <x-ui.button type="submit" class="w-full" data-test="reset-password-button">
                {{ __('Reset password') }}
            </x-ui.button>
        </form>
    </div>
</x-layouts::auth>
