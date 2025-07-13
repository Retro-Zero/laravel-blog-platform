<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_own_comments_in_dashboard()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($user)
            ->get('/dashboard/comments');

        $response->assertStatus(200);
        $response->assertSee(Str::limit($comment->content, 60));
    }

    public function test_user_cannot_view_other_users_comments_in_dashboard()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user2->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user2->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($user1)
            ->get('/dashboard/comments');

        $response->assertStatus(200);
        $response->assertDontSee($comment->content);
    }

    public function test_user_can_create_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->post('/dashboard/comments', [
                'content' => 'Test comment content',
                'post_id' => $post->id
            ]);

        $response->assertRedirect('/dashboard/comments');
        $this->assertDatabaseHas('comments', [
            'content' => 'Test comment content',
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);
    }

    public function test_user_can_update_own_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($user)
            ->put("/dashboard/comments/{$comment->id}", [
                'content' => 'Updated comment content'
            ]);

        $response->assertRedirect('/dashboard/comments');
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'content' => 'Updated comment content'
        ]);
    }

    public function test_user_cannot_update_other_users_comment()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user2->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user2->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($user1)
            ->put("/dashboard/comments/{$comment->id}", [
                'content' => 'Updated comment content'
            ]);

        $response->assertStatus(403);
    }

    public function test_user_can_delete_own_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($user)
            ->delete("/dashboard/comments/{$comment->id}");

        $response->assertRedirect('/dashboard/comments');
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_user_cannot_delete_other_users_comment()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user2->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user2->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($user1)
            ->delete("/dashboard/comments/{$comment->id}");

        $response->assertStatus(403);
    }

    public function test_comment_creation_requires_authentication()
    {
        $post = Post::factory()->create();

        $response = $this->post('/dashboard/comments', [
            'content' => 'Test comment',
            'post_id' => $post->id
        ]);

        $response->assertRedirect('/login');
    }

    public function test_comment_update_requires_authentication()
    {
        $comment = Comment::factory()->create();

        $response = $this->put("/dashboard/comments/{$comment->id}", [
            'content' => 'Updated comment'
        ]);

        $response->assertRedirect('/login');
    }

    public function test_comment_deletion_requires_authentication()
    {
        $comment = Comment::factory()->create();

        $response = $this->delete("/dashboard/comments/{$comment->id}");

        $response->assertRedirect('/login');
    }

    public function test_comment_validation()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->post('/dashboard/comments', [
                'content' => '',
                'post_id' => $post->id
            ]);

        $response->assertSessionHasErrors(['content']);
    }
} 