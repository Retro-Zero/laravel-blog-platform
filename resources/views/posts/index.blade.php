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
                        <a href="{{ route('posts.index') }}" class="bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium">Blog</a>
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

        <!-- Header Section -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Discover Amazing
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Blog Posts</span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Explore our collection of insightful articles, stories, and perspectives from our community of writers.
                    </p>
                </div>
            </div>
        </div>

        <!-- Posts Section -->
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($posts as $post)
                            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                @if($post->featured_image)
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                        <span class="text-white text-4xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    @if($post->category)
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full mb-3" style="background-color: {{ $post->category->color }}">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    
                                    <h2 class="text-xl font-bold text-gray-900 mb-3">
                                        <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition-colors duration-200">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {{ $post->excerpt }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-3">
                                                {{ substr($post->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $post->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="flex items-center text-xs">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                {{ $post->unique_view_count }}
                                            </span>
                                            <span class="flex items-center text-xs">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $post->reading_time }} min
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">No Posts Yet</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            We're working on creating amazing content for you. Check back soon for our latest articles!
                        </p>
                        @auth
                            <a href="{{ route('dashboard.posts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 px-8 text-lg transition-colors">
                                Create Your First Post
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 px-8 text-lg transition-colors">
                                Join Our Community
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-6">Ready to Share Your Story?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Join our community of writers and start creating amazing content that inspires and educates.
                </p>
                @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-blue-600 font-semibold rounded-xl py-4 px-8 text-lg transition-colors">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="bg-transparent hover:bg-white/10 text-white font-semibold rounded-xl py-4 px-8 text-lg border-2 border-white transition-colors">
                            Sign In
                        </a>
                    </div>
                @else
                    <a href="{{ route('dashboard.posts.create') }}" class="bg-white hover:bg-gray-100 text-blue-600 font-semibold rounded-xl py-4 px-8 text-lg transition-colors">
                        Create Your First Post
                    </a>
                @endguest
            </div>
        </div>

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