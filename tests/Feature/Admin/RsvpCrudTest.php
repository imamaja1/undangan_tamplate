<?php

namespace Tests\Feature\Admin;

use App\Models\Invitation;
use App\Models\Rsvp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RsvpCrudTest extends TestCase
{
    use RefreshDatabase;

    private function actingUserWithInvitation(): array
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        return [$user, $invitation];
    }

    public function test_user_can_create_an_rsvp(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();

        Livewire::test('pages::admin.rsvps')
            ->set('name', 'Citra Lestari')
            ->set('status', 'attending')
            ->set('pax', 2)
            ->set('message', 'Selamat menempuh hidup baru!')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('rsvps', [
            'invitation_id' => $invitation->id,
            'name' => 'Citra Lestari',
            'status' => 'attending',
            'pax' => 2,
        ]);
    }

    public function test_user_can_update_an_rsvp(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $rsvp = Rsvp::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.rsvps')
            ->call('edit', $rsvp->id)
            ->set('status', 'declined')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('rsvps', [
            'id' => $rsvp->id,
            'status' => 'declined',
        ]);
    }

    public function test_user_can_delete_an_rsvp(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $rsvp = Rsvp::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.rsvps')
            ->call('delete', $rsvp->id);

        $this->assertDatabaseMissing('rsvps', ['id' => $rsvp->id]);
    }

    public function test_required_fields_are_validated(): void
    {
        $this->actingUserWithInvitation();

        Livewire::test('pages::admin.rsvps')
            ->set('name', '')
            ->set('status', 'invalid')
            ->set('pax', 0)
            ->call('save')
            ->assertHasErrors(['name', 'status', 'pax']);
    }
}
