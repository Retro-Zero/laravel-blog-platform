<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'status',
        'parent_id',
        'is_approved',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_approved' => 'boolean',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    public function approve()
    {
        $this->update(['is_approved' => true, 'status' => 'approved']);
    }

    public function disapprove()
    {
        $this->update(['is_approved' => false, 'status' => 'rejected']);
    }

    public function isApproved()
    {
        return $this->is_approved === true;
    }

    public function isPending()
    {
        return $this->is_approved === false;
    }

    public function getAuthorNameAttribute()
    {
        return $this->user ? $this->user->name : 'Anonymous';
    }

    public function getExcerptAttribute()
    {
        if (!$this->content) return null;
        return strlen($this->content) > 100
            ? substr($this->content, 0, 97) . '...'
            : $this->content;
    }
}
