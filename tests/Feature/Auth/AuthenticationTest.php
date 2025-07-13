<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_dashboard_posts_requires_authentication(): void
    {
        $response = $this->get('/dashboard/posts');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_can_access_dashboard_posts(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard/posts');

        $response->assertStatus(200);
    }

    public function test_public_posts_are_accessible_without_authentication(): void
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    public function test_users_can_only_see_their_own_posts_in_dashboard(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create posts for both users
        $user1Post = \App\Models\Post::factory()->create(['user_id' => $user1->id]);
        $user2Post = \App\Models\Post::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->get('/dashboard/posts');

        $response->assertStatus(200);
        $response->assertSee($user1Post->title);
        $response->assertDontSee($user2Post->title);
    }
}
