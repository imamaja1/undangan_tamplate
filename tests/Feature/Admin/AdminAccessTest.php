<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $routes = [
            'admin.invitation',
            'admin.bride-groom',
            'admin.love-story',
            'admin.events',
            'admin.gallery',
            'admin.gifts',
            'admin.guest-lists',
            'admin.rsvps',
            'admin.wa-configs',
        ];

        foreach ($routes as $route) {
            $this->get(route($route))->assertRedirect(route('login'));
        }
    }

    public function test_authenticated_users_can_visit_admin_pages(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $routes = [
            'admin.invitation',
            'admin.bride-groom',
            'admin.love-story',
            'admin.events',
            'admin.gallery',
            'admin.gifts',
            'admin.guest-lists',
            'admin.rsvps',
            'admin.wa-configs',
        ];

        foreach ($routes as $route) {
            $this->get(route($route))->assertOk();
        }
    }
}
