<?php

namespace Tests\Feature\Admin;

use App\Models\Gift;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class GiftCrudTest extends TestCase
{
    use RefreshDatabase;

    private function actingUserWithInvitation(): array
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        return [$user, $invitation];
    }

    public function test_user_can_create_a_gift(): void
    {
        Storage::fake('public');
        [, $invitation] = $this->actingUserWithInvitation();

        Livewire::test('pages::admin.gifts')
            ->set('providerName', 'BCA')
            ->set('accountNumber', '1234567890')
            ->set('accountName', 'Andi Wijaya')
            ->set('qrCode', UploadedFile::fake()->image('qr.png'))
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('gifts', [
            'invitation_id' => $invitation->id,
            'provider_name' => 'BCA',
            'account_number' => '1234567890',
            'account_name' => 'Andi Wijaya',
        ]);

        $gift = Gift::where('invitation_id', $invitation->id)->first();
        Storage::disk('public')->assertExists($gift->qr_code_path);
    }

    public function test_user_can_update_a_gift(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $gift = Gift::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.gifts')
            ->call('edit', $gift->id)
            ->set('providerName', 'Mandiri')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('gifts', [
            'id' => $gift->id,
            'provider_name' => 'Mandiri',
        ]);
    }

    public function test_user_can_delete_a_gift(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $gift = Gift::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.gifts')
            ->call('delete', $gift->id);

        $this->assertDatabaseMissing('gifts', ['id' => $gift->id]);
    }

    public function test_required_fields_are_validated(): void
    {
        $this->actingUserWithInvitation();

        Livewire::test('pages::admin.gifts')
            ->call('save')
            ->assertHasErrors(['providerName', 'accountNumber', 'accountName']);
    }
}
