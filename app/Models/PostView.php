<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostView extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'post_id',
        'user_id',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the post that owns the view.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user that made the view.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
