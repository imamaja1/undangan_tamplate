<?php

use App\Models\Gallery;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Galeri')] class extends Component {
    use WithFileUploads;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $type = 'image';

    public $file;

    public int $sortOrder = 0;

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function galleries()
    {
        return $this->invitation?->galleries()->orderBy('sort_order')->get() ?? collect();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->sortOrder = $this->galleries->count();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $gallery = $this->invitation?->galleries()->findOrFail($id);

        $this->editingId = $gallery->id;
        $this->type = $gallery->type;
        $this->sortOrder = $gallery->sort_order;
        $this->showForm = true;
    }

    public function cancel(): void
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function save(): void
    {
        $validated = $this->validate([
            'type' => ['required', Rule::in(['image', 'video'])],
            'file' => [$this->editingId ? 'nullable' : 'required', $this->type === 'video' ? 'mimes:mp4,mov,webm' : 'image', 'max:10240'],
            'sortOrder' => ['required', 'integer', 'min:0'],
        ]);

        $data = [
            'type' => $validated['type'],
            'sort_order' => $validated['sortOrder'],
        ];

        if ($this->file) {
            $data['file_path'] = $this->file->store($this->type === 'video' ? 'galleries/videos' : 'galleries/images', 'public');
        }

        if ($this->editingId) {
            $this->invitation?->galleries()->findOrFail($this->editingId)->update($data);
        } else {
            $this->invitation?->galleries()->create($data);
        }

        $this->dispatch('toast', message: 'Media tersimpan.', type: 'success');
        $this->cancel();
    }

    public function delete(int $id): void
    {
        $this->invitation?->galleries()->findOrFail($id)->delete();

        $this->dispatch('toast', message: 'Media dihapus.', type: 'danger');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->type = 'image';
        $this->file = null;
        $this->sortOrder = 0;
        $this->resetValidation();
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
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Galeri</h1>
                <p class="text-sm text-muted-foreground">Foto dan video untuk ditampilkan di undangan.</p>
            </div>
            <x-ui.button wire:click="create">
                <x-lucide-plus class="size-4" />
                Tambah Media
            </x-ui.button>
        </div>

        <x-ui.dialog wire:model="showForm">
            <x-ui.dialog.content class="max-h-[85vh] overflow-y-auto">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>{{ $this->editingId ? 'Edit Media' : 'Tambah Media' }}</x-ui.dialog.title>
                    <x-ui.dialog.description>Foto dan video untuk ditampilkan di undangan.</x-ui.dialog.description>
                </x-ui.dialog.header>

                <form wire:submit="save" class="space-y-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <x-ui.label for="type">Jenis Media</x-ui.label>
                            <x-ui.select wire:model="type" id="type">
                                <option value="image">Gambar</option>
                                <option value="video">Video</option>
                            </x-ui.select>
                            @error('type')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="sortOrder">Urutan</x-ui.label>
                            <x-ui.input wire:model="sortOrder" id="sortOrder" type="number" min="0" required />
                            @error('sortOrder')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="file">File</x-ui.label>
                        @if ($this->file)
                            <div class="flex items-center gap-3 rounded-md border p-3 text-sm text-muted-foreground">
                                <x-lucide-file class="size-4" />
                                {{ $this->file->getClientOriginalName() }}
                            </div>
                        @endif
                        <x-ui.input wire:model="file" id="file" type="file" accept="{{ $this->type === 'video' ? 'video/*' : 'image/*' }}" />
                        <p class="text-xs text-muted-foreground">{{ $this->type === 'video' ? 'MP4, MOV, WebM. Maksimal 10 MB.' : 'JPG, PNG, WEBP. Maksimal 10 MB.' }}</p>
                        @error('file')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <x-ui.button type="submit">Simpan</x-ui.button>
                        <x-ui.button type="button" variant="ghost" x-on:click="__dialogOpen = false">Batal</x-ui.button>
                    </div>
                </form>
            </x-ui.dialog.content>
        </x-ui.dialog>

        <x-ui.card class="p-6">
            @if ($this->galleries->isEmpty())
                <p class="py-10 text-center text-sm text-muted-foreground">Belum ada media.</p>
            @else
                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($this->galleries as $gallery)
                        <div wire:key="gal-{{ $gallery->id }}" class="overflow-hidden rounded-xl border">
                            @if ($gallery->type === 'video')
                                <video src="{{ asset('storage/'.$gallery->file_path) }}" class="h-40 w-full object-cover" muted preload="metadata"></video>
                            @else
                                <img src="{{ asset('storage/'.$gallery->file_path) }}" alt="{{ $gallery->type }}" class="h-40 w-full object-cover" />
                            @endif
                            <div class="flex items-center justify-between gap-2 border-t bg-card p-2">
                                <div class="min-w-0">
                                    <x-ui.badge variant="secondary">{{ $gallery->type }}</x-ui.badge>
                                </div>
                                <div class="inline-flex shrink-0 gap-2">
                                    <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $gallery->id }})" title="Edit" aria-label="Edit">
                                        <x-lucide-pencil class="size-4" />
                                    </x-ui.button>
                                    <x-ui.button
                                        variant="ghost"
                                        size="icon"
                                        x-data="swalConfirm('Hapus media ini?')"
                                        x-on:click="__confirm('delete', {{ $gallery->id }})"
                                        title="Hapus"
                                        aria-label="Hapus"
                                    >
                                        <x-lucide-trash-2 class="size-4 text-destructive" />
                                    </x-ui.button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-ui.card>
    @endif
</div>
