<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of published posts (public).
     */
    public function index(): View
    {
        $posts = Post::with(['user', 'category'])
            ->published()
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified published post (public).
     */
    public function show(Post $post): View
    {
        if (!$post->isPublished()) {
            abort(404);
        }

        $post->incrementViewCount();
        
        // Get related posts (same category, excluding current post)
        $relatedPosts = Post::with(['user', 'category'])
            ->published()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, function ($query) use ($post) {
                return $query->where('category_id', $post->category_id);
            })
            ->latest()
            ->limit(3)
            ->get();
        
        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Display a listing of user's posts (dashboard).
     */
    public function dashboardIndex(): View
    {
        $posts = auth()->user()->posts()
            ->with(['category'])
            ->latest()
            ->paginate(10);

        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:draft,published,archived',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'featured_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = $validated['status'] ?? 'draft';

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        // Handle file upload
        if ($request->hasFile('featured_image_file')) {
            $imagePath = $request->file('featured_image_file')->store('posts/images', 'public');
            $validated['featured_image'] = '/storage/' . $imagePath;
        }

        $post = Post::create($validated);

        return redirect()->route('dashboard.posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post): View
    {
        $this->authorize('update', $post);
        
        $categories = Category::orderBy('name')->get();
        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255|unique:posts,slug,' . $post->id,
            'content' => 'sometimes|required|string',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:draft,published,archived',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'featured_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Set published_at if status is published
        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        // Handle file upload
        if ($request->hasFile('featured_image_file')) {
            $imagePath = $request->file('featured_image_file')->store('posts/images', 'public');
            $validated['featured_image'] = '/storage/' . $imagePath;
        }

        $post->update($validated);

        return redirect()->route('dashboard.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('dashboard.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    /**
     * Toggle publish status via AJAX.
     */
    public function togglePublish(Post $post)
    {
        $this->authorize('update', $post);
        $user = auth()->user();
        if ($post->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($post->status === 'published') {
            $post->status = 'draft';
            $post->published_at = null;
        } else {
            $post->status = 'published';
            $post->published_at = now();
        }
        $post->save();
        return response()->json(['status' => $post->status]);
    }

    // API methods for JSON responses
    public function apiIndex()
    {
        return response()->json(Post::all());
    }

    public function apiShow(Post $post)
    {
        return response()->json($post);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:draft,published,archived',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $post = Post::create($validated);
        return response()->json($post, 201);
    }

    public function apiUpdate(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255|unique:posts,slug,' . $post->id,
            'content' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:draft,published,archived',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);
        $post->update($validated);
        return response()->json($post);
    }

    public function apiDestroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
