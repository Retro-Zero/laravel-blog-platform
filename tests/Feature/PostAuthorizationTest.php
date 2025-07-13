<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_edit_their_own_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/dashboard/posts/{$post->slug}/edit");

        $response->assertStatus(200);
    }

    public function test_user_cannot_edit_another_users_post(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->get("/dashboard/posts/{$post->slug}/edit");

        $response->assertStatus(403);
    }

    public function test_user_can_update_their_own_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/dashboard/posts/{$post->slug}", [
            'title' => 'Updated Title',
            'content' => 'Updated content',
        ]);

        $response->assertRedirect(route('dashboard.posts.index'));
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_user_cannot_update_another_users_post(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->put("/dashboard/posts/{$post->slug}", [
            'title' => 'Updated Title',
            'content' => 'Updated content',
        ]);

        $response->assertStatus(403);
    }

    public function test_user_can_delete_their_own_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/dashboard/posts/{$post->slug}");

        $response->assertRedirect(route('dashboard.posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_user_cannot_delete_another_users_post(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->delete("/dashboard/posts/{$post->slug}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function test_guest_cannot_access_dashboard_posts(): void
    {
        $post = Post::factory()->create();

        $response = $this->get("/dashboard/posts/{$post->slug}/edit");

        $response->assertRedirect('/login');
    }
} 