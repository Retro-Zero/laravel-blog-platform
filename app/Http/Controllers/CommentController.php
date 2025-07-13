<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    // Dashboard: List comments for the user's posts
    public function index(): View
    {
        $comments = Comment::whereHas('post', function ($q) {
            $q->where('user_id', auth()->id());
        })->with(['user', 'post'])->latest()->paginate(15);
        return view('dashboard.comments.index', compact('comments'));
    }

    // Dashboard: Store a new comment (on own post or as reply)
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'approved';
        $validated['is_approved'] = true;
        Comment::create($validated);
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment added!');
    }

    // Dashboard: Edit a comment (only own comment)
    public function edit(Comment $comment): View
    {
        $this->authorize('update', $comment);
        return view('dashboard.comments.edit', compact('comment'));
    }

    // Dashboard: Update a comment (only own comment)
    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $this->authorize('update', $comment);
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        $comment->update($validated);
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment updated!');
    }

    // Dashboard: Delete a comment (only own comment or post owner)
    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment deleted!');
    }
}
