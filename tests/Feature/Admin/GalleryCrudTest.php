<?php

namespace Tests\Feature\Admin;

use App\Models\Gallery;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class GalleryCrudTest extends TestCase
{
    use RefreshDatabase;

    private function actingUserWithInvitation(): array
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        return [$user, $invitation];
    }

    public function test_user_can_create_a_gallery_image(): void
    {
        Storage::fake('public');
        [, $invitation] = $this->actingUserWithInvitation();

        Livewire::test('pages::admin.gallery')
            ->set('type', 'image')
            ->set('file', UploadedFile::fake()->image('photo.jpg'))
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('galleries', [
            'invitation_id' => $invitation->id,
            'type' => 'image',
        ]);

        $gallery = Gallery::where('invitation_id', $invitation->id)->first();
        Storage::disk('public')->assertExists($gallery->file_path);
    }

    public function test_file_is_required_when_creating(): void
    {
        $this->actingUserWithInvitation();

        Livewire::test('pages::admin.gallery')
            ->set('type', 'image')
            ->call('save')
            ->assertHasErrors(['file']);
    }

    public function test_user_can_delete_a_gallery_item(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $gallery = Gallery::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.gallery')
            ->call('delete', $gallery->id);

        $this->assertDatabaseMissing('galleries', ['id' => $gallery->id]);
    }
}
