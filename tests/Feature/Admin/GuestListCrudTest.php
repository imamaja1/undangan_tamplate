<?php

namespace Tests\Feature\Admin;

use App\Models\GuestList;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GuestListCrudTest extends TestCase
{
    use RefreshDatabase;

    private function actingUserWithInvitation(): array
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        return [$user, $invitation];
    }

    public function test_user_can_create_a_guest(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();

        Livewire::test('pages::admin.guest-lists')
            ->set('name', 'Budi Santoso')
            ->set('phoneNumber', '6281234567890')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('guest_lists', [
            'invitation_id' => $invitation->id,
            'name' => 'Budi Santoso',
            'phone_number' => '6281234567890',
            'is_sent' => false,
        ]);
    }

    public function test_user_can_update_a_guest(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $guest = GuestList::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.guest-lists')
            ->call('edit', $guest->id)
            ->set('name', 'Budi Updated')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('guest_lists', [
            'id' => $guest->id,
            'name' => 'Budi Updated',
        ]);
    }

    public function test_user_can_toggle_guest_sent_status(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $guest = GuestList::factory()->create(['invitation_id' => $invitation->id, 'is_sent' => false]);

        Livewire::test('pages::admin.guest-lists')
            ->call('toggleSent', $guest->id);

        $this->assertDatabaseHas('guest_lists', [
            'id' => $guest->id,
            'is_sent' => true,
        ]);
    }

    public function test_user_can_delete_a_guest(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $guest = GuestList::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.guest-lists')
            ->call('delete', $guest->id);

        $this->assertDatabaseMissing('guest_lists', ['id' => $guest->id]);
    }

    public function test_required_fields_are_validated(): void
    {
        $this->actingUserWithInvitation();

        Livewire::test('pages::admin.guest-lists')
            ->call('save')
            ->assertHasErrors(['name', 'phoneNumber']);
    }
}
