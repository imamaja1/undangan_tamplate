<?php

use App\Concerns\PasswordValidationRules;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {
    use PasswordValidationRules;

    public string $password = '';
    public bool $confirmingUserDeletion = false;

    #[On('confirming-delete-user')]
    public function confirmUserDeletion()
    {
        $this->confirmingUserDeletion = true;
    }

    public function closeModal()
    {
        $this->confirmingUserDeletion = false;
        $this->reset('password');
        $this->resetValidation();
    }

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => $this->currentPasswordRules(),
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-ui.dialog wire:model="confirmingUserDeletion">
    <x-ui.dialog.content class="sm:max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <x-ui.dialog.header>
                <x-ui.dialog.title>{{ __('Are you sure you want to delete your account?') }}</x-ui.dialog.title>
                <x-ui.dialog.description>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </x-ui.dialog.description>
            </x-ui.dialog.header>

            <div class="grid gap-2">
                <x-ui.label for="password">{{ __('Password') }}</x-ui.label>
                <x-ui.input wire:model="password" id="password" type="password" required />
                @error('password')
                    <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <x-ui.dialog.footer>
                <x-ui.button variant="outline" type="button" wire:click="closeModal">{{ __('Cancel') }}</x-ui.button>
                <x-ui.button variant="destructive" type="submit" data-test="confirm-delete-user-button">
                    {{ __('Delete account') }}
                </x-ui.button>
            </x-ui.dialog.footer>
        </form>
    </x-ui.dialog.content>
</x-ui.dialog>
