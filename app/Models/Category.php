<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'color' => 'string',
    ];

    /**
     * Boot the model and add event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from name if not provided
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        // Update slug when name changes
        static::updating(function ($category) {
            if ($category->isDirty('name') && !$category->isDirty('slug')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get the posts for the category.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the published posts for the category.
     */
    public function publishedPosts(): HasMany
    {
        return $this->hasMany(Post::class)->published();
    }

    /**
     * Scope a query to only include categories with posts.
     */
    public function scopeWithPosts(Builder $query): void
    {
        $query->has('posts');
    }

    /**
     * Scope a query to only include categories with published posts.
     */
    public function scopeWithPublishedPosts(Builder $query): void
    {
        $query->has('publishedPosts');
    }

    /**
     * Scope a query to search categories by name or description.
     */
    public function scopeSearch(Builder $query, string $search): void
    {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Scope a query to order categories by name.
     */
    public function scopeOrderByName(Builder $query): void
    {
        $query->orderBy('name');
    }

    /**
     * Scope a query to order categories by post count.
     */
    public function scopeOrderByPostCount(Builder $query): void
    {
        $query->withCount('posts')->orderBy('posts_count', 'desc');
    }

    /**
     * Get the posts count for the category.
     */
    public function getPostsCountAttribute(): int
    {
        return $this->posts()->count();
    }

    /**
     * Get the published posts count for the category.
     */
    public function getPublishedPostsCountAttribute(): int
    {
        return $this->publishedPosts()->count();
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the URL for the category.
     */
    public function getUrlAttribute(): string
    {
        return route('categories.show', $this->slug);
    }

    /**
     * Get the color with fallback to default.
     */
    public function getColorAttribute($value): string
    {
        return $value ?: '#3B82F6';
    }

    /**
     * Get the description with fallback.
     */
    public function getDescriptionAttribute($value): string
    {
        if ($value) {
            return $value;
        }

        return "Posts in the {$this->name} category.";
    }
}
