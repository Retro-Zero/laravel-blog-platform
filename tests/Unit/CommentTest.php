<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_comment_belongs_to_user()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $comment->user);
        $this->assertEquals($user->id, $comment->user->id);
    }

    public function test_comment_belongs_to_post()
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['post_id' => $post->id]);

        $this->assertInstanceOf(Post::class, $comment->post);
        $this->assertEquals($post->id, $comment->post->id);
    }

    public function test_user_has_many_comments()
    {
        $user = User::factory()->create();
        $comments = Comment::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->comments);
        $this->assertInstanceOf(Comment::class, $user->comments->first());
    }

    public function test_post_has_many_comments()
    {
        $post = Post::factory()->create();
        $comments = Comment::factory()->count(3)->create(['post_id' => $post->id]);

        $this->assertCount(3, $post->comments);
        $this->assertInstanceOf(Comment::class, $post->comments->first());
    }

    public function test_comment_fillable_fields()
    {
        $comment = new Comment();
        $fillable = $comment->getFillable();

        $this->assertContains('content', $fillable);
        $this->assertContains('user_id', $fillable);
        $this->assertContains('post_id', $fillable);
    }

    public function test_comment_casts()
    {
        $comment = new Comment();
        $casts = $comment->getCasts();

        $this->assertArrayHasKey('created_at', $casts);
        $this->assertArrayHasKey('updated_at', $casts);
        $this->assertEquals('datetime', $casts['created_at']);
        $this->assertEquals('datetime', $casts['updated_at']);
    }

    public function test_comment_scope_approved()
    {
        $approvedComment = Comment::factory()->create(['is_approved' => true]);
        $pendingComment = Comment::factory()->create(['is_approved' => false]);

        $approvedComments = Comment::approved()->get();

        $this->assertTrue($approvedComments->contains($approvedComment));
        $this->assertFalse($approvedComments->contains($pendingComment));
    }

    public function test_comment_scope_pending()
    {
        $approvedComment = Comment::factory()->create(['is_approved' => true]);
        $pendingComment = Comment::factory()->create(['is_approved' => false]);

        $pendingComments = Comment::pending()->get();

        $this->assertFalse($pendingComments->contains($approvedComment));
        $this->assertTrue($pendingComments->contains($pendingComment));
    }

    public function test_comment_default_is_approved_is_false()
    {
        $comment = Comment::factory()->create();

        $this->assertFalse($comment->is_approved);
    }

    public function test_comment_can_be_approved()
    {
        $comment = Comment::factory()->create(['is_approved' => false]);

        $comment->approve();

        $this->assertTrue($comment->fresh()->is_approved);
    }

    public function test_comment_can_be_disapproved()
    {
        $comment = Comment::factory()->create(['is_approved' => true]);

        $comment->disapprove();

        $this->assertFalse($comment->fresh()->is_approved);
    }

    public function test_comment_is_approved_method()
    {
        $approvedComment = Comment::factory()->create(['is_approved' => true]);
        $pendingComment = Comment::factory()->create(['is_approved' => false]);

        $this->assertTrue($approvedComment->isApproved());
        $this->assertFalse($pendingComment->isApproved());
    }

    public function test_comment_is_pending_method()
    {
        $approvedComment = Comment::factory()->create(['is_approved' => true]);
        $pendingComment = Comment::factory()->create(['is_approved' => false]);

        $this->assertFalse($approvedComment->isPending());
        $this->assertTrue($pendingComment->isPending());
    }

    public function test_comment_has_author_name()
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->assertEquals('John Doe', $comment->author_name);
    }

    public function test_comment_has_author_name_with_anonymous_user()
    {
        $comment = Comment::factory()->create(['user_id' => null]);

        $this->assertEquals('Anonymous', $comment->author_name);
    }

    public function test_comment_has_excerpt()
    {
        $longContent = 'This is a very long comment content that should be truncated when displayed as an excerpt. It contains more than 100 characters to test the excerpt functionality properly.';
        $comment = Comment::factory()->create(['content' => $longContent]);

        $excerpt = $comment->excerpt;

        $this->assertLessThanOrEqual(100, strlen($excerpt));
        $this->assertStringContainsString('...', $excerpt);
    }

    public function test_comment_excerpt_for_short_content()
    {
        $shortContent = 'Short comment';
        $comment = Comment::factory()->create(['content' => $shortContent]);

        $excerpt = $comment->excerpt;

        $this->assertEquals($shortContent, $excerpt);
        $this->assertStringNotContainsString('...', $excerpt);
    }
} 