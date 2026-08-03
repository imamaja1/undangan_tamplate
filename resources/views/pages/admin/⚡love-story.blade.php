<?php

use App\Models\Invitation;
use App\Models\LoveStory;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Cerita Cinta')] class extends Component {
    use WithFileUploads;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $title = '';

    public string $date = '';

    public string $description = '';

    public $photo;

    public ?string $existingPhoto = null;

    public bool $removePhoto = false;

    public int $sortOrder = 0;

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function loveStories()
    {
        return $this->invitation?->loveStories()->orderBy('sort_order')->get() ?? collect();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->sortOrder = $this->loveStories->count();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $story = $this->invitation?->loveStories()->findOrFail($id);

        $this->editingId = $story->id;
        $this->title = $story->title;
        $this->date = $story->date?->format('Y-m-d') ?? '';
        $this->description = $story->description;
        $this->sortOrder = $story->sort_order;
        $this->existingPhoto = $story->photo_path ? asset('storage/'.$story->photo_path) : null;
        $this->removePhoto = false;
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
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:5000'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'sortOrder' => ['required', 'integer', 'min:0'],
        ]);

        $data = [
            'title' => $validated['title'],
            'date' => $validated['date'],
            'description' => $validated['description'],
            'sort_order' => $validated['sortOrder'],
        ];

        if ($this->photo) {
            $data['photo_path'] = $this->photo->store('love-stories', 'public');
        } elseif ($this->removePhoto) {
            $data['photo_path'] = null;
        }

        if ($this->editingId) {
            $this->invitation?->loveStories()->findOrFail($this->editingId)->update($data);
        } else {
            $this->invitation?->loveStories()->create($data);
        }

        $this->dispatch('toast', message: 'Cerita tersimpan.', type: 'success');
        $this->cancel();
    }

    public function deletePhoto(): void
    {
        $this->removePhoto = true;
        $this->existingPhoto = null;
    }

    public function delete(int $id): void
    {
        $this->invitation?->loveStories()->findOrFail($id)->delete();

        $this->dispatch('toast', message: 'Cerita dihapus.', type: 'danger');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->title = '';
        $this->date = '';
        $this->description = '';
        $this->photo = null;
        $this->existingPhoto = null;
        $this->removePhoto = false;
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
                <h1 class="text-2xl font-semibold tracking-tight">Cerita Cinta</h1>
                <p class="text-sm text-muted-foreground">Kisah perjalanan cinta kamu berdua.</p>
            </div>
            <x-ui.button wire:click="create">
                <x-lucide-plus class="size-4" />
                Tambah Cerita
            </x-ui.button>
        </div>

        <x-ui.dialog wire:model="showForm">
            <x-ui.dialog.content class="max-h-[85vh] overflow-y-auto">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>{{ $this->editingId ? 'Edit Cerita' : 'Tambah Cerita' }}</x-ui.dialog.title>
                    <x-ui.dialog.description>Kisah perjalanan cinta kamu berdua.</x-ui.dialog.description>
                </x-ui.dialog.header>

                <form wire:submit="save" class="space-y-6">
                    <div class="grid gap-2">
                        <x-ui.label for="title">Judul</x-ui.label>
                        <x-ui.input wire:model="title" id="title" type="text" required placeholder="Pertama Bertemu" />
                        @error('title')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <x-ui.label for="date">Tanggal</x-ui.label>
                            <x-ui.input wire:model="date" id="date" type="date" required />
                            @error('date')
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
                        <x-ui.label for="description">Deskripsi</x-ui.label>
                        <x-ui.textarea wire:model="description" id="description" rows="4" required />
                        @error('description')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="photo">Foto</x-ui.label>
                        @if ($this->photo)
                            <img src="{{ $this->photo->temporaryUrl() }}" alt="Pratinjau" class="mx-auto size-32 rounded-xl border object-cover" />
                        @elseif ($this->existingPhoto)
                            <div class="relative mx-auto size-32">
                                <img src="{{ $this->existingPhoto }}" alt="Foto Saat Ini" class="size-32 rounded-xl border object-cover" />
                                <button type="button" wire:click="deletePhoto" class="absolute -right-2 -top-2 flex size-6 items-center justify-center rounded-full bg-destructive text-destructive-foreground shadow hover:bg-destructive/90" title="Hapus Foto">
                                    <x-lucide-x class="size-3" />
                                </button>
                            </div>
                        @endif
                        <x-ui.input wire:model="photo" id="photo" type="file" accept="image/*" />
                        @error('photo')
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
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left text-xs uppercase tracking-wider text-muted-foreground">
                            <th class="px-4 py-3">Urutan</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->loveStories as $story)
                            <tr wire:key="ls-{{ $story->id }}" class="border-b last:border-0">
                                <td class="px-4 py-3 text-muted-foreground">{{ $story->sort_order }}</td>
                                <td class="px-4 py-3 font-medium">{{ $story->title }}</td>
                                <td class="px-4 py-3">{{ $story->date?->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $story->id }})" title="Edit" aria-label="Edit">
                                            <x-lucide-pencil class="size-4" />
                                        </x-ui.button>
                                        <x-ui.button
                                            variant="ghost"
                                            size="icon"
                                            x-data="swalConfirm('Hapus cerita ini?')"
                                            x-on:click="__confirm('delete', {{ $story->id }})"
                                            title="Hapus"
                                            aria-label="Hapus"
                                        >
                                            <x-lucide-trash-2 class="size-4 text-destructive" />
                                        </x-ui.button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-muted-foreground">Belum ada cerita.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
