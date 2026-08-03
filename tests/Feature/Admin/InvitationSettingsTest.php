<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class InvitationSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_an_invitation(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test('pages::admin.invitation')
            ->set('title', 'Undangan Pernikahan')
            ->set('openingMessage', 'Dengan memohon rahmat Allah SWT...')
            ->set('status', 'published')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('invitations', [
            'user_id' => $user->id,
            'title' => 'Undangan Pernikahan',
            'status' => 'published',
        ]);
    }

    public function test_user_can_update_existing_invitation(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Livewire::test('pages::admin.invitation')
            ->set('title', 'Judul Baru')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('invitations', [
            'id' => $invitation->id,
            'title' => 'Judul Baru',
        ]);
    }

    public function test_user_can_upload_a_cover_image(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test('pages::admin.invitation')
            ->set('title', 'Undangan Pernikahan')
            ->set('coverImage', UploadedFile::fake()->image('sampul.jpg'))
            ->call('save')
            ->assertHasNoErrors();

        $invitation = Invitation::where('user_id', $user->id)->firstOrFail();
        $this->assertStringStartsWith('invitations/', $invitation->cover_image);
        Storage::disk('public')->assertExists($invitation->cover_image);
    }

    public function test_user_can_upload_background_music(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test('pages::admin.invitation')
            ->set('title', 'Undangan Pernikahan')
            ->set('musicFile', UploadedFile::fake()->create('musik.mp3', 1024))
            ->call('save')
            ->assertHasNoErrors();

        $invitation = Invitation::where('user_id', $user->id)->firstOrFail();
        $this->assertStringStartsWith('invitations/music/', $invitation->music_url);
        Storage::disk('public')->assertExists($invitation->music_url);
    }

    public function test_music_file_must_be_audio(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test('pages::admin.invitation')
            ->set('title', 'Undangan Pernikahan')
            ->set('musicFile', UploadedFile::fake()->image('musik.jpg'))
            ->call('save')
            ->assertHasErrors(['musicFile']);
    }
}
