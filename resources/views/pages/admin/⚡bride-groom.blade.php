<?php

use App\Models\BrideGroom;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Mempelai')] class extends Component {
    use WithFileUploads;

    public bool $showForm = false;

    public ?int $editingId = null;

    public string $type = 'bride';

    public string $fullName = '';

    public string $nickname = '';

    public string $fatherName = '';

    public string $motherName = '';

    public string $instagramUrl = '';

    public $photo;

    public string $description = '';

    public function mount(): void
    {
        if (! $this->invitation) {
            return;
        }
    }

    #[Computed]
    public function invitation(): ?Invitation
    {
        return Auth::user()->invitation;
    }

    #[Computed]
    public function brideGrooms()
    {
        return $this->invitation?->brideGrooms()->orderBy('id')->get() ?? collect();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $brideGroom = $this->invitation?->brideGrooms()->findOrFail($id);

        $this->editingId = $brideGroom->id;
        $this->type = $brideGroom->type;
        $this->fullName = $brideGroom->full_name;
        $this->nickname = $brideGroom->nickname;
        $this->fatherName = $brideGroom->father_name ?? '';
        $this->motherName = $brideGroom->mother_name ?? '';
        $this->instagramUrl = $brideGroom->instagram_url ?? '';
        $this->description = $brideGroom->description ?? '';
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
            'type' => ['required', Rule::in(['bride', 'groom'])],
            'fullName' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255'],
            'fatherName' => ['nullable', 'string', 'max:255'],
            'motherName' => ['nullable', 'string', 'max:255'],
            'instagramUrl' => ['nullable', 'url', 'max:500'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $data = [
            'type' => $validated['type'],
            'full_name' => $validated['fullName'],
            'nickname' => $validated['nickname'],
            'father_name' => $validated['fatherName'] ?: null,
            'mother_name' => $validated['motherName'] ?: null,
            'instagram_url' => $validated['instagramUrl'] ?: null,
            'description' => $validated['description'] ?: null,
        ];

        if ($this->photo) {
            $data['photo_path'] = $this->photo->store('bride-grooms', 'public');
        }

        if ($this->editingId) {
            $this->invitation?->brideGrooms()->findOrFail($this->editingId)->update($data);
        } else {
            $this->invitation?->brideGrooms()->create($data);
        }

        $this->dispatch('toast', message: 'Mempelai tersimpan.', type: 'success');
        $this->cancel();
    }

    public function delete(int $id): void
    {
        $this->invitation?->brideGrooms()->findOrFail($id)->delete();

        $this->dispatch('toast', message: 'Mempelai dihapus.', type: 'danger');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->type = 'bride';
        $this->fullName = '';
        $this->nickname = '';
        $this->fatherName = '';
        $this->motherName = '';
        $this->instagramUrl = '';
        $this->photo = null;
        $this->description = '';
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
                <h1 class="text-2xl font-semibold tracking-tight">Mempelai</h1>
                <p class="text-sm text-muted-foreground">Informasi pengantin pria dan wanita.</p>
            </div>
            <x-ui.button wire:click="create">
                <x-lucide-plus class="size-4" />
                Tambah Mempelai
            </x-ui.button>
        </div>

        <x-ui.dialog wire:model="showForm">
            <x-ui.dialog.content class="max-h-[85vh] overflow-y-auto">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>{{ $this->editingId ? 'Edit Mempelai' : 'Tambah Mempelai' }}</x-ui.dialog.title>
                    <x-ui.dialog.description>Informasi pengantin pria dan wanita.</x-ui.dialog.description>
                </x-ui.dialog.header>

                <form wire:submit="save" class="space-y-6">
                    <div class="grid gap-2">
                        <x-ui.label for="type">Posisi</x-ui.label>
                        <x-ui.select wire:model="type" id="type">
                            <option value="bride">Mempelai Wanita</option>
                            <option value="groom">Mempelai Pria</option>
                        </x-ui.select>
                        @error('type')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <x-ui.label for="fullName">Nama Lengkap</x-ui.label>
                            <x-ui.input wire:model="fullName" id="fullName" type="text" required />
                            @error('fullName')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="nickname">Nama Panggilan</x-ui.label>
                            <x-ui.input wire:model="nickname" id="nickname" type="text" required />
                            @error('nickname')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <x-ui.label for="fatherName">Nama Ayah</x-ui.label>
                            <x-ui.input wire:model="fatherName" id="fatherName" type="text" />
                            @error('fatherName')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="motherName">Nama Ibu</x-ui.label>
                            <x-ui.input wire:model="motherName" id="motherName" type="text" />
                            @error('motherName')
                                <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="instagramUrl">URL Instagram</x-ui.label>
                        <x-ui.input wire:model="instagramUrl" id="instagramUrl" type="url" placeholder="https://instagram.com/..." />
                        @error('instagramUrl')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="photo">Foto</x-ui.label>
                        @if ($this->photo)
                            <img src="{{ $this->photo->temporaryUrl() }}" alt="Pratinjau" class="mx-auto size-32 rounded-full border object-cover" />
                        @endif
                        <x-ui.input wire:model="photo" id="photo" type="file" accept="image/*" />
                        @error('photo')
                            <p class="text-[0.8rem] font-medium text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-2">
                        <x-ui.label for="description">Deskripsi</x-ui.label>
                        <x-ui.textarea wire:model="description" id="description" rows="3" />
                        @error('description')
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
                            <th class="px-4 py-3">Posisi</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Instagram</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->brideGrooms as $brideGroom)
                            <tr wire:key="bg-{{ $brideGroom->id }}" class="border-b last:border-0">
                                <td class="px-4 py-3">
                                    <x-ui.badge variant="secondary">{{ $brideGroom->type === 'bride' ? 'Wanita' : 'Pria' }}</x-ui.badge>
                                </td>
                                <td class="px-4 py-3 font-medium">{{ $brideGroom->full_name }} ({{ $brideGroom->nickname }})</td>
                                <td class="px-4 py-3 text-muted-foreground">{{ $brideGroom->instagram_url ?? '—' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <x-ui.button variant="ghost" size="icon" wire:click="edit({{ $brideGroom->id }})" title="Edit" aria-label="Edit">
                                            <x-lucide-pencil class="size-4" />
                                        </x-ui.button>
                                        <x-ui.button
                                            variant="ghost"
                                            size="icon"
                                            x-data="swalConfirm('Hapus mempelai ini?')"
                                            x-on:click="__confirm('delete', {{ $brideGroom->id }})"
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
                                <td colspan="4" class="px-4 py-10 text-center text-muted-foreground">Belum ada data mempelai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
