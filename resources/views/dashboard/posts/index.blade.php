<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Posts') }}
            </h2>
            <a href="{{ route('dashboard.posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                Create New Post
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        My <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Posts</span>
                    </h1>
                    <p class="text-xl text-gray-600">Manage and organize your blog content</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if($posts->count() > 0)
                <!-- Posts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                    <span class="text-white text-4xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <!-- Status Badge -->
                                <div class="flex items-center justify-between mb-4">
                                    <span id="status-badge-{{ $post->id }}" class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($post->status === 'published') bg-green-100 text-green-800
                                        @elseif($post->status === 'draft') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                    @if($post->category)
                                        <span class="px-3 py-1 text-xs font-semibold text-white rounded-full" style="background-color: {{ $post->category->color }}">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Post Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                                
                                <!-- Post Excerpt -->
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $post->excerpt }}
                                </p>
                                
                                <!-- Post Stats -->
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ $post->unique_view_count }} views
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ $post->comments()->count() }} comments
                                        </span>
                                    </div>
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('dashboard.posts.edit', $post) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl transition-colors text-sm">
                                        Edit Post
                                    </a>
                                    <button type="button" 
                                            onclick="showDeleteConfirm(() => { document.getElementById('delete-form-{{ $post->id }}').submit(); })" 
                                            class="text-red-600 hover:text-red-700 font-medium text-sm">
                                        Delete
                                    </button>
                                    <form id="delete-form-{{ $post->id }}" action="{{ route('dashboard.posts.destroy', $post) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" id="publish-toggle-{{ $post->id }}"
                                        data-url="{{ route('dashboard.posts.toggle-publish', $post) }}"
                                        class="ml-2 px-4 py-2 rounded-xl font-semibold text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400
                                        @if($post->status === 'published') bg-green-100 text-green-800 hover:bg-green-200 @else bg-gray-100 text-gray-700 hover:bg-gray-200 @endif"
                                        onclick="togglePublish({{ $post->id }})">
                                        <span class="toggle-label">{{ $post->status === 'published' ? 'Unpublish' : 'Publish' }}</span>
                                        <span class="toggle-spinner hidden ml-2 w-4 h-4 border-2 border-blue-400 border-t-transparent rounded-full animate-spin"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No posts yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Start your blogging journey by creating your first post. Share your thoughts, stories, and ideas with the world.
                    </p>
                    <a href="{{ route('dashboard.posts.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors text-lg">
                        Create Your First Post
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        function togglePublish(postId) {
            const btn = document.getElementById('publish-toggle-' + postId);
            const url = btn.dataset.url;
            const label = btn.querySelector('.toggle-label');
            const spinner = btn.querySelector('.toggle-spinner');
            btn.disabled = true;
            spinner.classList.remove('hidden');
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                    'Accept': 'application/json',
                },
            })
            .then(async res => {
                let data;
                try { data = await res.json(); } catch (e) { data = {}; }
                console.log('Toggle publish response:', res.status, data);
                if (res.ok && (data.status === 'published' || data.status === 'draft')) {
                    if (data.status === 'published') {
                        btn.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                        btn.classList.add('bg-green-100', 'text-green-800', 'hover:bg-green-200');
                        label.textContent = 'Unpublish';
                        // Update status badge
                        const badge = document.getElementById('status-badge-' + postId);
                        if (badge) {
                            badge.textContent = 'Published';
                            badge.className = 'px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                        }
                        Swal.fire({ icon: 'success', title: 'Post Published', text: 'Your post is now live!', timer: 1500, showConfirmButton: false });
                    } else {
                        btn.classList.remove('bg-green-100', 'text-green-800', 'hover:bg-green-200');
                        btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                        label.textContent = 'Publish';
                        // Update status badge
                        const badge = document.getElementById('status-badge-' + postId);
                        if (badge) {
                            badge.textContent = 'Draft';
                            badge.className = 'px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800';
                        }
                        Swal.fire({ icon: 'info', title: 'Post Unpublished', text: 'Your post is now a draft.', timer: 1500, showConfirmButton: false });
                    }
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: data.error || 'Failed to update status.' });
                }
            })
            .catch((err) => { 
                console.error('Toggle publish fetch error:', err);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to update status.' }); 
            })
            .finally(() => {
                btn.disabled = false;
                spinner.classList.add('hidden');
            });
        }

        function showDeleteConfirm(onConfirm) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    onConfirm();
                }
            });
        }
    </script>
</x-app-layout> 