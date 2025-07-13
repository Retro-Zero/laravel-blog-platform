<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_auto_generates_slug_from_title(): void
    {
        $post = Post::create([
            'title' => 'My Test Post',
            'content' => 'Content here',
            'user_id' => User::factory()->create()->id,
        ]);

        $this->assertEquals('my-test-post', $post->slug);
    }

    public function test_published_scope_works(): void
    {
        Post::factory()->create(['status' => 'draft']);
        Post::factory()->create(['status' => 'published', 'published_at' => now()]);
        Post::factory()->create(['status' => 'archived']);

        $publishedPosts = Post::published()->get();

        $this->assertEquals(1, $publishedPosts->count());
        $this->assertEquals('published', $publishedPosts->first()->status);
    }

    public function test_can_publish_post(): void
    {
        $post = Post::factory()->create(['status' => 'draft']);

        $post->publish();

        $this->assertEquals('published', $post->fresh()->status);
        $this->assertNotNull($post->fresh()->published_at);
    }

    public function test_can_increment_view_count(): void
    {
        $post = Post::factory()->create(['view_count' => 5]);

        $post->incrementViewCount();

        $this->assertEquals(6, $post->fresh()->view_count);
    }

    public function test_has_user_relationship(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $post->user);
        $this->assertEquals($user->id, $post->user->id);
    }

    public function test_has_category_relationship(): void
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Category::class, $post->category);
        $this->assertEquals($category->id, $post->category->id);
    }

    public function test_uses_slug_as_route_key(): void
    {
        $post = Post::factory()->create(['slug' => 'test-post']);

        $this->assertEquals('slug', $post->getRouteKeyName());
    }

    public function test_reading_time_calculation(): void
    {
        $post = Post::factory()->create([
            'content' => str_repeat('word ', 400) // 400 words
        ]);

        $this->assertEquals(2, $post->reading_time); // 400 words / 200 wpm = 2 minutes
    }
} 