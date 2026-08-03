<?php

namespace Tests\Feature\Admin;

use App\Models\BrideGroom;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BrideGroomCrudTest extends TestCase
{
    use RefreshDatabase;

    private function actingUserWithInvitation(): array
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        return [$user, $invitation];
    }

    public function test_user_can_create_a_bride_groom(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();

        Livewire::test('pages::admin.bride-groom')
            ->set('type', 'bride')
            ->set('fullName', 'Sari Ayu')
            ->set('nickname', 'Sari')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('bride_grooms', [
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sari Ayu',
            'nickname' => 'Sari',
        ]);
    }

    public function test_user_can_update_a_bride_groom(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $brideGroom = BrideGroom::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.bride-groom')
            ->call('edit', $brideGroom->id)
            ->set('nickname', 'Sari Cantik')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('bride_grooms', [
            'id' => $brideGroom->id,
            'nickname' => 'Sari Cantik',
        ]);
    }

    public function test_user_can_delete_a_bride_groom(): void
    {
        [, $invitation] = $this->actingUserWithInvitation();
        $brideGroom = BrideGroom::factory()->create(['invitation_id' => $invitation->id]);

        Livewire::test('pages::admin.bride-groom')
            ->call('delete', $brideGroom->id);

        $this->assertDatabaseMissing('bride_grooms', ['id' => $brideGroom->id]);
    }

    public function test_required_fields_are_validated(): void
    {
        $this->actingUserWithInvitation();

        Livewire::test('pages::admin.bride-groom')
            ->set('type', 'invalid')
            ->set('fullName', '')
            ->set('nickname', '')
            ->call('save')
            ->assertHasErrors(['fullName', 'nickname', 'type']);
    }

    public function test_bride_grooms_are_scoped_to_users_invitation(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        $otherInvitation = Invitation::factory()->create(['user_id' => $otherUser->id]);

        $brideGroom = BrideGroom::factory()->create(['invitation_id' => $invitation->id]);
        $otherBrideGroom = BrideGroom::factory()->create(['invitation_id' => $otherInvitation->id]);

        $this->actingAs($user);

        try {
            Livewire::test('pages::admin.bride-groom')
                ->call('delete', $otherBrideGroom->id);

            $this->fail('Deleting another user\'s record should throw a ModelNotFoundException.');
        } catch (ModelNotFoundException) {
            // Expected: the record belongs to another invitation.
        }

        $this->assertDatabaseHas('bride_grooms', ['id' => $otherBrideGroom->id]);
        $this->assertDatabaseHas('bride_grooms', ['id' => $brideGroom->id]);
    }
}
