<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-900">{{ config('app.name', 'Laravel Blog') }}</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Post Content -->
        <div class="py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover">
                    @else
                        <div class="w-full h-64 md:h-96 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-6xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <div class="p-8">
                        <!-- Post Header -->
                        <header class="mb-8">
                            @if($post->category)
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-white rounded-full mb-4" style="background-color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                                {{ $post->title }}
                            </h1>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-lg font-bold mr-4">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $post->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $post->created_at->format('F d, Y') }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ $post->view_count }} views
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $post->reading_time }} min read
                                    </span>
                                </div>
                            </div>
                            
                            @if($post->excerpt)
                                <p class="text-lg text-gray-600 italic border-l-4 border-blue-500 pl-4">
                                    {{ $post->excerpt }}
                                </p>
                            @endif
                        </header>
                        
                        <!-- Post Content -->
                        <div class="prose prose-lg max-w-none">
                            {!! $post->content !!}
                        </div>
                        
                        <!-- Post Footer -->
                        <footer class="mt-12 pt-8 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-500">Share this post:</span>
                                    <div class="flex space-x-2">
                                        <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="w-8 h-8 bg-blue-800 text-white rounded-full flex items-center justify-center hover:bg-blue-900 transition-colors">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                    ← Back to Blog
                                </a>
                            </div>
                        </footer>
                    </div>
                </article>
                
                <!-- Comments Section -->
                @if($post->comments->count() > 0)
                <div class="mt-12 bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Comments ({{ $post->comments->count() }})</h3>
                    
                    <div class="space-y-6">
                        @foreach($post->comments as $comment)
                            <div class="border-b border-gray-200 pb-6 last:border-b-0">
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="prose prose-sm max-w-none">
                                            {!! $comment->content !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Comment Form -->
                @auth
                <div class="mt-8 bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Leave a Comment</h3>
                    
                    <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                        @csrf
                        <div class="mb-6">
                            <x-quill-editor 
                                name="content" 
                                :value="old('content')" 
                                placeholder="Share your thoughts..."
                                height="200px"
                                required
                            />
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 px-8 transition-colors">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="mt-8 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Join the Discussion</h3>
                    <p class="text-gray-600 mb-6">Sign in to leave a comment and join the conversation.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 px-8 transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-white hover:bg-gray-50 text-blue-600 font-semibold rounded-xl py-3 px-8 border-2 border-blue-600 transition-colors">
                            Sign Up
                        </a>
                    </div>
                </div>
                @endauth
            </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <div class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Related Posts</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            @if($relatedPost->featured_image)
                                <img src="{{ $relatedPost->featured_image }}" alt="{{ $relatedPost->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                    <span class="text-white text-3xl font-bold">{{ substr($relatedPost->title, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                @if($relatedPost->category)
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full mb-3" style="background-color: {{ $relatedPost->category->color }}">
                                        {{ $relatedPost->category->name }}
                                    </span>
                                @endif
                                
                                <h3 class="text-lg font-bold text-gray-900 mb-3">
                                    <a href="{{ route('posts.show', $relatedPost) }}" class="hover:text-blue-600 transition-colors duration-200">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>
                                
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $relatedPost->excerpt }}
                                </p>
                                
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>{{ $relatedPost->user->name }}</span>
                                    <span>{{ $relatedPost->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h3 class="text-2xl font-bold mb-4">{{ config('app.name', 'Laravel Blog') }}</h3>
                    <p class="text-gray-400 mb-8">Share your stories, connect with readers, and build your audience.</p>
                    <div class="flex justify-center space-x-6">
                        <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-white transition-colors">Home</a>
                        <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-white transition-colors">Blog</a>
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Sign In</a>
                            <a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Sign Up</a>
                        @endguest
                    </div>
                    <div class="mt-8 pt-8 border-t border-gray-800">
                        <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel Blog') }}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-guest-layout> 