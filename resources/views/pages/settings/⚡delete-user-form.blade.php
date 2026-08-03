<?php

use Livewire\Component;

new class extends Component {
    public bool $confirmingUserDeletion = false;

    public function confirmUserDeletion()
    {
        $this->dispatch('confirming-delete-user');
    }
}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <h3 class="text-lg font-medium">{{ __('Delete account') }}</h3>
        <p class="text-sm text-muted-foreground">{{ __('Delete your account and all of its resources') }}</p>
    </div>

    <x-ui.button variant="destructive" wire:click="confirmUserDeletion" data-test="delete-user-button">
        {{ __('Delete account') }}
    </x-ui.button>

    <livewire:pages::settings.delete-user-modal />
</section>
