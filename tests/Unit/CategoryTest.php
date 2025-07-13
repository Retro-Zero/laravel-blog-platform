<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_auto_generates_slug_from_name(): void
    {
        $category = Category::create([
            'name' => 'My Test Category',
        ]);

        $this->assertEquals('my-test-category', $category->slug);
    }

    public function test_has_posts_relationship(): void
    {
        $category = Category::factory()->create();
        Post::factory(3)->create(['category_id' => $category->id]);

        $this->assertEquals(3, $category->posts->count());
    }

    public function test_has_published_posts_relationship(): void
    {
        $category = Category::factory()->create();
        Post::factory()->create(['category_id' => $category->id, 'status' => 'draft']);
        Post::factory()->create(['category_id' => $category->id, 'status' => 'published', 'published_at' => now()]);

        $this->assertEquals(1, $category->publishedPosts->count());
    }

    public function test_uses_slug_as_route_key(): void
    {
        $category = Category::factory()->create(['slug' => 'test-category']);

        $this->assertEquals('slug', $category->getRouteKeyName());
    }

    public function test_has_default_color(): void
    {
        $category = Category::factory()->create(['color' => null]);

        $this->assertEquals('#3B82F6', $category->color);
    }
} 