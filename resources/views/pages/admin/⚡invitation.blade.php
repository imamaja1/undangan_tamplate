<?php

use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Pengaturan Undangan')] class extends Component {
    use WithFileUploads;

    public string $title = '';

    public $coverImage;

    public string $openingMessage = '';

    public $musicFile;

    public string $status = 'draft';

    public function mount(): void
    {
        $invitation = $this->invitation;

        if (! $invitation) {
            return;
        }

        $this->title = $invitation->title;
        $this->openingMessage = $invitation->opening_message ?? '';
        $this->status = $invitation->status;
    }

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function existingMusicUrl(): ?string
    {
        $url = $this->invitation?->music_url;

        if (! $url) {
            return null;
        }

        return str_starts_with($url, 'http') ? $url : asset('storage/'.$url);
    }

    public function save(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'coverImage' => ['nullable', 'image', 'max:2048'],
            'openingMessage' => ['nullable', 'string', 'max:5000'],
            'musicFile' => ['nullable', 'mimes:mp3,wav,ogg,m4a', 'max:10240'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $data = [
            'title' => $validated['title'],
            'opening_message' => $validated['openingMessage'] ?: null,
            'status' => $validated['status'],
        ];

        if ($this->coverImage) {
            $data['cover_image'] = $this->coverImage->store('invitations', 'public');
        }

        if ($this->musicFile) {
            $data['music_url'] = $this->musicFile->store('invitations/music', 'public');
        }

        if ($this->invitation) {
            $this->invitation->update($data);
        } else {
            Auth::user()->invitation()->create($data);
        }

        $this->coverImage = null;
        $this->musicFile = null;
        $this->dispatch('toast', message: 'Pengaturan undangan tersimpan.', type: 'success');
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Pengaturan Undangan</h1>
            <p class="text-sm text-muted-foreground">Konfigurasi dasar undangan digital kamu.</p>
        </div>
        <x-ui.badge variant="{{ $this->status === 'published' ? 'default' : 'secondary' }}">
            {{ $this->status === 'published' ? 'Terbit' : 'Draf' }}
        </x-ui.badge>
    </div>

    <form wire:submit="save" class="grid gap-6 lg:grid-cols-2 lg:items-start">
        <!-- Kolom Kiri: Informasi Umum -->
        <x-ui.card class="p-6">
            <h3 class="mb-4 text-lg font-medium">Informasi Umum</h3>
            <div class="space-y-6">
                <div class="grid gap-2">
                    <x-ui.label for="title">Judul Undangan</x-ui.label>
                    <x-ui.input wire:model="title" id="title" type="text" required autofocus placeholder="Undangan Pernikahan" />
                    @error('title')
                        <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-2">
                    <x-ui.label for="openingMessage">Pesan Pembuka</x-ui.label>
                    <x-ui.textarea wire:model="openingMessage" id="openingMessage" rows="5" placeholder="Dengan memohon rahmat dan ridho Allah SWT..." />
                    @error('openingMessage')
                        <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-2">
                    <x-ui.label for="status">Status Undangan</x-ui.label>
                    <x-ui.select wire:model="status" id="status">
                        <option value="draft">Draf (Hanya bisa dilihat Admin)</option>
                        <option value="published">Terbit (Bisa dilihat Publik)</option>
                    </x-ui.select>
                    @error('status')
                        <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </x-ui.card>

        <!-- Kolom Kanan: Media & Submit -->
        <div class="flex flex-col gap-6">
            <x-ui.card class="p-6">
                <h3 class="mb-4 text-lg font-medium">Media (Visual & Audio)</h3>
                <div class="space-y-6">
                    <div class="grid gap-2">
                        <x-ui.label for="coverImage">Gambar Sampul</x-ui.label>
                        <div class="relative h-48 w-1/2 overflow-hidden rounded-md border">
                            @if ($this->coverImage)
                                <img src="{{ $this->coverImage->temporaryUrl() }}" alt="Pratinjau sampul" class="h-full w-full object-cover" />
                            @elseif ($this->invitation?->cover_image)
                                <img src="{{ asset('storage/'.$this->invitation->cover_image) }}" alt="Sampul" class="h-full w-full object-cover" />
                            @else
                                <div class="flex h-full w-full flex-col items-center justify-center gap-2 bg-muted/40 text-muted-foreground">
                                    <x-lucide-image class="size-8" />
                                    <p class="text-sm">Belum ada gambar</p>
                                </div>
                            @endif
                        </div>
                        <x-ui.input wire:model="coverImage" id="coverImage" type="file" accept="image/*" />
                        <p class="text-xs text-muted-foreground">Format: JPG, PNG, WEBP (Maks: 2 MB).</p>
                        @error('coverImage')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="musicFile">Musik Latar</x-ui.label>
                        @if ($this->musicFile)
                            <div class="flex items-center gap-3 rounded-md border p-3 text-sm text-muted-foreground">
                                <x-lucide-music class="size-4 shrink-0" />
                                <span class="truncate">{{ $this->musicFile->getClientOriginalName() }}</span>
                            </div>
                        @elseif ($this->existingMusicUrl)
                            <div class="rounded-md border p-3">
                                <div class="mb-2 flex items-center gap-3 text-sm text-muted-foreground">
                                    <x-lucide-music class="size-4 shrink-0" />
                                    <span class="truncate">Musik saat ini: {{ basename($this->existingMusicUrl) }}</span>
                                </div>
                                <audio controls preload="none" class="w-full" src="{{ $this->existingMusicUrl }}"></audio>
                            </div>
                        @endif
                        <x-ui.input wire:model="musicFile" id="musicFile" type="file" accept="audio/*" />
                        <p class="text-xs text-muted-foreground">Format: MP3, WAV, M4A (Maks: 10 MB).</p>
                        @error('musicFile')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </x-ui.card>

            <div class="flex items-center justify-end">
                <x-ui.button type="submit" class="w-full sm:w-auto">
                    <x-lucide-save class="mr-2 size-4" />
                    Simpan Pengaturan
                </x-ui.button>
            </div>
        </div>
    </form>
</div>
