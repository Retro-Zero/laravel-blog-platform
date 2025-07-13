<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'user_id',
        'category_id',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'view_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
        'view_count' => 'integer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'meta_title',
        'meta_description',
    ];

    /**
     * Boot the model and add event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from title if not provided
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        // Update slug when title changes
        static::updating(function ($post) {
            if ($post->isDirty('title') && !$post->isDirty('slug')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')
              ->whereNotNull('published_at')
              ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft posts.
     */
    public function scopeDraft(Builder $query): void
    {
        $query->where('status', 'draft');
    }

    /**
     * Scope a query to only include archived posts.
     */
    public function scopeArchived(Builder $query): void
    {
        $query->where('status', 'archived');
    }

    /**
     * Scope a query to only include posts by a specific user.
     */
    public function scopeByUser(Builder $query, int $userId): void
    {
        $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include posts in a specific category.
     */
    public function scopeByCategory(Builder $query, int $categoryId): void
    {
        $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to search posts by title or content.
     */
    public function scopeSearch(Builder $query, string $search): void
    {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%");
        });
    }

    /**
     * Scope a query to order posts by most recent.
     */
    public function scopeLatest(Builder $query): void
    {
        $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope a query to order posts by most viewed.
     */
    public function scopeMostViewed(Builder $query): void
    {
        $query->orderBy('view_count', 'desc');
    }

    /**
     * Check if the post is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' && 
               $this->published_at && 
               $this->published_at->isPast();
    }

    /**
     * Check if the post is draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if the post is archived.
     */
    public function isArchived(): bool
    {
        return $this->status === 'archived';
    }

    /**
     * Publish the post.
     */
    public function publish(): void
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    /**
     * Unpublish the post (make it draft).
     */
    public function unpublish(): void
    {
        $this->update([
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    /**
     * Archive the post.
     */
    public function archive(): void
    {
        $this->update(['status' => 'archived']);
    }

    /**
     * Increment the view count.
     */
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    /**
     * Get the reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $wordsPerMinute = 200;
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, round($wordCount / $wordsPerMinute));
    }

    /**
     * Get the excerpt with fallback to content.
     */
    public function getExcerptAttribute($value): string
    {
        if ($value) {
            return $value;
        }

        // Generate excerpt from content if not set
        $content = strip_tags($this->content);
        return Str::limit($content, 150);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the URL for the post.
     */
    public function getUrlAttribute(): string
    {
        return route('posts.show', $this->slug);
    }

    /**
     * Get the featured image URL with fallback.
     */
    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            return $this->featured_image;
        }

        // Return a default image URL
        return 'https://via.placeholder.com/800x400/3B82F6/FFFFFF?text=' . urlencode($this->title);
    }
}
