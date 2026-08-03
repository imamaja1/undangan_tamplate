<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Appearance settings')] class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <h2 class="sr-only">{{ __('Appearance settings') }}</h2>

    <x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        <div x-data="{
                theme: localStorage.getItem('theme') || 'system',
                setTheme(val) {
                    this.theme = val;
                    localStorage.setItem('theme', val);
                    if (val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }"
            class="flex items-center space-x-4 mt-6">

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="radio" value="light" x-model="theme" @change="setTheme('light')" class="text-primary focus:ring-primary h-4 w-4 border-input">
                <span class="text-sm font-medium">{{ __('Light') }}</span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="radio" value="dark" x-model="theme" @change="setTheme('dark')" class="text-primary focus:ring-primary h-4 w-4 border-input">
                <span class="text-sm font-medium">{{ __('Dark') }}</span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="radio" value="system" x-model="theme" @change="setTheme('system')" class="text-primary focus:ring-primary h-4 w-4 border-input">
                <span class="text-sm font-medium">{{ __('System') }}</span>
            </label>
        </div>
    </x-pages::settings.layout>
</section>
