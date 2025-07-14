<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Navigation -->
        <nav class="bg-white/60 backdrop-blur-lg border-b border-gray-200 sticky top-0 z-50 shadow-lg rounded-b-3xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="4" y="4" width="16" height="16" rx="4" fill="currentColor" class="text-blue-100"/>
                                <path d="M8 8h8M8 12h5M8 16h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight drop-shadow">Blog Platform</h1>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-xl text-sm font-medium transition-all hover:bg-white/50">Home</a>
                        <a href="{{ route('posts.index') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-xl text-sm font-medium transition-all hover:bg-white/50">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-xl text-sm font-medium transition-all hover:bg-white/50">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-white/80 hover:bg-white text-blue-600 px-6 py-3 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl p-12 text-center flex flex-col items-center animate-fade-in-up">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow mb-6 animate-bounce-slow">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Discover Amazing
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Blog Posts</span>
                    </h1>
                    <p class="text-2xl text-gray-700 mb-10 max-w-2xl mx-auto font-medium">
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
                            <article class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group">
                                @if($post->featured_image)
                                    <div class="relative overflow-hidden">
                                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 flex items-center justify-center relative overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
                                        <span class="text-white text-5xl font-bold relative z-10">{{ substr($post->title, 0, 1) }}</span>
                                    </div>
                                @endif
                                
                                <div class="p-8">
                                    @if($post->category)
                                        <span class="inline-block px-4 py-2 text-xs font-bold text-white rounded-full mb-4 shadow-lg" style="background: linear-gradient(135deg, {{ $post->category->color }}, {{ $post->category->color }}dd)">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    
                                    <h2 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                                        <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition-colors duration-200">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    
                                    <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                        {{ $post->excerpt }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3 shadow-lg">
                                                {{ substr($post->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $post->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <span class="flex items-center text-xs bg-blue-50 px-3 py-1 rounded-full">
                                                <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                {{ $post->unique_view_count }}
                                            </span>
                                            <span class="flex items-center text-xs bg-purple-50 px-3 py-1 rounded-full">
                                                <svg class="w-4 h-4 mr-1 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <div class="mt-16">
                        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-6">
                            {{ $posts->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-20">
                        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-12 max-w-2xl mx-auto">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-4">No Posts Yet</h3>
                            <p class="text-gray-600 mb-8 text-lg max-w-md mx-auto">
                                We're working on creating amazing content for you. Check back soon for our latest articles!
                            </p>
                            @auth
                                <a href="{{ route('dashboard.posts.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-xl py-4 px-8 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                                    Create Your First Post
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-xl py-4 px-8 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                                    Join Our Community
                                </a>
                            @endauth
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-24 bg-gradient-to-r from-blue-600 to-purple-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-4xl font-extrabold text-white mb-6">Ready to Share Your Story?</h2>
                <p class="text-2xl text-blue-100 mb-10 max-w-3xl mx-auto font-medium">
                    Join our community of writers and start creating amazing content that inspires and educates.
                </p>
                @guest
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-blue-600 font-bold rounded-xl py-4 px-8 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="bg-transparent hover:bg-white/10 text-white font-bold rounded-xl py-4 px-8 text-lg border-2 border-white transition-all transform hover:-translate-y-1">
                            Sign In
                        </a>
                    </div>
                @else
                    <a href="{{ route('dashboard.posts.create') }}" class="bg-white hover:bg-gray-100 text-blue-600 font-bold rounded-xl py-4 px-8 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                        Create Your First Post
                    </a>
                @endguest
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="4" y="4" width="16" height="16" rx="4" fill="currentColor" class="text-blue-100"/>
                                <path d="M8 8h8M8 12h5M8 16h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold">{{ config('app.name', 'Laravel Blog') }}</h3>
                    </div>
                    <p class="text-gray-400 mb-8 text-lg">Share your stories, connect with readers, and build your audience.</p>
                    <div class="flex justify-center space-x-8 mb-8">
                        <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-white transition-colors font-medium">Home</a>
                        <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-white transition-colors font-medium">Blog</a>
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors font-medium">Sign In</a>
                            <a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors font-medium">Sign Up</a>
                        @endguest
                    </div>
                    <div class="pt-8 border-t border-gray-800">
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
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        .animate-bounce-slow {
            animation: bounce 2s infinite;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-guest-layout> 