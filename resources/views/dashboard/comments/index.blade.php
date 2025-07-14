<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments on My Posts') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        My <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Comments</span>
                    </h1>
                    <p class="text-xl text-gray-600">Review and manage comments on your posts</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if($comments->count() > 0)
                <!-- Comments Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($comments as $comment)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                            <div class="p-6">
                                <!-- Comment Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($comment->status === 'approved') bg-green-100 text-green-800
                                        @elseif($comment->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($comment->status) }}
                                    </span>
                                </div>
                                
                                <!-- Comment Content -->
                                <div class="mb-4">
                                    <p class="text-gray-700 line-clamp-3">{{ $comment->content }}</p>
                                </div>
                                
                                <!-- Post Link -->
                                <div class="mb-4 p-3 bg-gray-50 rounded-xl">
                                    <p class="text-sm text-gray-600 mb-1">On post:</p>
                                    <a href="{{ route('posts.show', $comment->post) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                        {{ $comment->post->title }}
                                    </a>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        @can('update', $comment)
                                            <a href="{{ route('dashboard.comments.edit', $comment) }}" 
                                               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl transition-colors text-sm">
                                                Edit
                                            </a>
                                        @endcan
                                        @can('delete', $comment)
                                            <button type="button" 
                                                    onclick="showDeleteConfirm(() => { document.getElementById('delete-form-{{ $comment->id }}').submit(); })" 
                                                    class="text-red-600 hover:text-red-700 font-medium text-sm">
                                                Delete
                                            </button>
                                            <form id="delete-form-{{ $comment->id }}" action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                    </div>
                                    <a href="{{ route('posts.show', $comment->post) }}" class="text-gray-500 hover:text-gray-700 text-sm">
                                        View Post →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-12">
                    {{ $comments->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No comments yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        When readers comment on your posts, they'll appear here for you to review and manage.
                    </p>
                    <a href="{{ route('dashboard.posts.index') }}" 
                       class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors text-lg">
                        View My Posts
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout> 