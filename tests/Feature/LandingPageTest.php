<?php

namespace Tests\Feature;

use App\Models\BrideGroom;
use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_without_invitation(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('You Are Invited');
        $response->assertSee('Open Invitation');
    }

    public function test_landing_page_shows_bride_and_groom_names(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Sarah Amelia');
        $response->assertSee('James Pratama');
    }

    public function test_landing_page_shows_countdown_for_main_event(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        Event::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'akad',
            'event_date' => now()->addDays(45)->format('Y-m-d'),
            'start_time' => '09:00',
            'is_main_event' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Days');
        $response->assertSee('Hours');
        $response->assertSee('Mins');
        $response->assertSee('countdown(');
    }

    public function test_landing_page_shows_opening_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Assalamu');
        $response->assertSee('Dengan memohon rahmat');
        $response->assertSee('Kepada Yth.');
        $response->assertSee('Mohon maaf apabila ada kesalahan penulisan nama/gelar');
    }

    public function test_landing_page_uses_guest_name_from_query(): void
    {
        $response = $this->get('/?to=Bapak Ahmad');

        $response->assertOk();
        $response->assertSee('Bapak Ahmad');
    }

    public function test_landing_page_shows_monogram_from_names(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('S & J');
    }

    public function test_landing_page_shows_bride_groom_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('id="bride-groom"', false);
        $response->assertSee('Putra dari');
        $response->assertSee('Putri dari');
    }

    public function test_landing_page_shows_bride_groom_names_and_parents(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
            'nickname' => 'Sarah',
            'father_name' => 'H. Ahmad',
            'mother_name' => 'Hj. Siti',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
            'nickname' => 'Muhammad',
            'father_name' => 'Yusuf',
            'mother_name' => 'Aminah',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Muhammad');
        $response->assertSee('Sarah');
        $response->assertSee('Bapak Yusuf & Ibu Aminah');
        $response->assertSee('Bapak H. Ahmad & Ibu Hj. Siti');
    }

    public function test_landing_page_shows_couple_portraits_in_bride_groom_section(): void
    {
        $user = User::factory()->create();
        $invitation = Invitation::factory()->create(['user_id' => $user->id]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'bride',
            'full_name' => 'Sarah Amelia',
            'photo_path' => 'bride-grooms/sarah.jpg',
        ]);
        BrideGroom::factory()->create([
            'invitation_id' => $invitation->id,
            'type' => 'groom',
            'full_name' => 'James Pratama',
            'photo_path' => 'bride-grooms/james.jpg',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('bride-grooms/sarah.jpg');
        $response->assertSee('bride-grooms/james.jpg');
        $response->assertSee('Foto mempelai wanita');
        $response->assertSee('Foto mempelai pria');
    }
}
