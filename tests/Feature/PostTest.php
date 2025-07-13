<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    public function test_can_list_all_posts(): void
    {
        Post::factory(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    public function test_can_create_post(): void
    {
        $postData = [
            'title' => 'Test Post',
            'content' => 'This is test content',
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'status' => 'draft',
        ];

        $response = $this->postJson('/api/posts', $postData);

        $response->assertStatus(201)
                ->assertJsonFragment(['title' => 'Test Post']);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_can_show_single_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->getJson("/api/posts/{$post->slug}");

        $response->assertStatus(200)
                ->assertJsonFragment(['id' => $post->id]);
    }

    public function test_can_update_post(): void
    {
        $post = Post::factory()->create();
        $updateData = [
            'title' => 'Updated Title',
            'content' => 'Updated content',
        ];

        $response = $this->putJson("/api/posts/{$post->slug}", $updateData);

        $response->assertStatus(200)
                ->assertJsonFragment(['title' => 'Updated Title']);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_can_delete_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson("/api/posts/{$post->slug}");

        $response->assertStatus(200)
                ->assertJsonFragment(['message' => 'Post deleted']);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_validates_required_fields_on_create(): void
    {
        $response = $this->postJson('/api/posts', []);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['title', 'content', 'user_id']);
    }

    public function test_validates_unique_slug(): void
    {
        $existingPost = Post::factory()->create(['slug' => 'test-post']);

        $response = $this->postJson('/api/posts', [
            'title' => 'Another Post',
            'content' => 'Content',
            'user_id' => $this->user->id,
            'slug' => 'test-post', // Duplicate slug
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['slug']);
    }

    public function test_auto_generates_slug_from_title(): void
    {
        $response = $this->postJson('/api/posts', [
            'title' => 'My Test Post Title',
            'content' => 'Content here',
            'user_id' => $this->user->id,
        ]);

        $response->assertStatus(201);
        
        $this->assertDatabaseHas('posts', [
            'slug' => 'my-test-post-title',
        ]);
    }

    public function test_can_publish_post(): void
    {
        $post = Post::factory()->create(['status' => 'draft']);

        $response = $this->putJson("/api/posts/{$post->slug}", [
            'status' => 'published',
        ]);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'status' => 'published',
        ]);
    }
} 