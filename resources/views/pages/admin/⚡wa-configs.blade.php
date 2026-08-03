<?php

use App\Models\Invitation;
use App\Models\WaConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('WA Config')] class extends Component {
    public string $provider = 'fonnte';

    public string $apiKey = '';

    public string $messageTemplate = '';

    public function mount(): void
    {
        $config = $this->waConfig;

        if (! $config) {
            return;
        }

        $this->provider = $config->provider;
        $this->apiKey = $config->api_key ?? '';
        $this->messageTemplate = $config->message_template ?? '';
    }

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function waConfig(): ?WaConfig
    {
        return $this->invitation?->waConfig;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'provider' => ['required', Rule::in(['fonnte'])],
            'apiKey' => ['nullable', 'string', 'max:500'],
            'messageTemplate' => ['nullable', 'string', 'max:5000'],
        ]);

        $data = [
            'provider' => $validated['provider'],
            'api_key' => $validated['apiKey'] ?: null,
            'message_template' => $validated['messageTemplate'] ?: null,
        ];

        if ($this->waConfig) {
            $this->waConfig->update($data);
        } else {
            $this->invitation?->waConfig()->create($data);
        }

        $this->dispatch('toast', message: 'Konfigurasi WhatsApp tersimpan.', type: 'success');
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-6">
    @if (! $this->invitation)
        <x-ui.card class="p-6">
            <p class="text-sm text-muted-foreground">
                Kamu belum membuat undangan. Silakan <a href="{{ route('admin.invitation') }}" wire:navigate class="font-medium text-primary underline underline-offset-4">atur undangan</a> terlebih dahulu.
            </p>
        </x-ui.card>
    @else
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Konfigurasi WhatsApp</h1>
            <p class="text-sm text-muted-foreground">Pengaturan API untuk broadcast undangan via WhatsApp.</p>
        </div>

        <x-ui.card class="p-6">
            <form wire:submit="save" class="space-y-6">
                <div class="grid gap-2">
                    <x-ui.label for="provider">Provider</x-ui.label>
                    <x-ui.select wire:model="provider" id="provider">
                        <option value="fonnte">Fonnte</option>
                    </x-ui.select>
                    @error('provider')
                        <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-2">
                    <x-ui.label for="apiKey">API Key</x-ui.label>
                    <x-ui.input wire:model="apiKey" id="apiKey" type="text" autocomplete="off" />
                    <p class="text-xs text-muted-foreground">Kunci API dari dashboard Fonnte.</p>
                    @error('apiKey')
                        <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-2">
                    <x-ui.label for="messageTemplate">Template Pesan</x-ui.label>
                    <x-ui.textarea wire:model="messageTemplate" id="messageTemplate" rows="5" placeholder="Halo {name}, kamu diundang ke pernikahan kami..." />
                    <p class="text-xs text-muted-foreground">Gunakan {name} untuk nama tamu dan {link} untuk tautan undangan.</p>
                    @error('messageTemplate')
                        <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <x-ui.button type="submit">Simpan</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    @endif
</div>
