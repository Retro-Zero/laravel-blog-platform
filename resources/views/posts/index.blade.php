<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute top-40 left-40 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-50 bg-white/10 backdrop-blur-xl border-b border-white/20 sticky top-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-white tracking-tight">BlogVerse</a>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('welcome') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Home</a>
                        <a href="{{ route('posts.index') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header Section -->
        <div class="relative z-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="text-center">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-xl rounded-full px-6 py-3 mb-8 border border-white/20">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-white/80 text-sm font-medium">Discover amazing stories</span>
                    </div>
                    
                    <h1 class="text-6xl md:text-7xl font-bold text-white mb-8 leading-tight">
                        Explore Our
                        <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Blog Posts</span>
                    </h1>
                    
                    <p class="text-2xl text-white/80 mb-12 max-w-3xl mx-auto font-light leading-relaxed">
                        Discover insightful articles, stories, and perspectives from our community of writers.
                    </p>
                </div>
            </div>
        </div>

        <!-- Posts Section -->
        <div class="relative z-10 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($posts as $post)
                            <article class="group bg-white/10 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/20 hover:border-white/40 transition-all duration-500 transform hover:scale-105">
                                @if($post->featured_image)
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                    </div>
                                @else
                                    <div class="relative h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                                        <span class="text-white text-4xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                    </div>
                                @endif
                                
                                <div class="p-8">
                                    @if($post->category)
                                        <span class="inline-block px-4 py-2 text-xs font-semibold text-white rounded-full mb-4 bg-gradient-to-r from-purple-500 to-pink-500">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    
                                    <h2 class="text-xl font-bold text-white mb-4 group-hover:text-purple-300 transition-colors">
                                        <a href="{{ route('posts.show', $post) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    
                                    <p class="text-white/70 mb-6 line-clamp-3 leading-relaxed">
                                        {{ $post->excerpt }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm text-white/50">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                {{ substr($post->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-white/80">{{ $post->user->name }}</div>
                                                <div class="text-xs text-white/50">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <span class="flex items-center gap-1 bg-white/10 px-3 py-1 rounded-full">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                {{ $post->view_count }}
                                            </span>
                                            <span class="flex items-center gap-1 bg-white/10 px-3 py-1 rounded-full">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20">
                            {{ $posts->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-20">
                        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-12 max-w-2xl mx-auto border border-white/20">
                            <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">No Posts Yet</h3>
                            <p class="text-white/70 mb-8 text-lg max-w-md mx-auto">
                                We're working on creating amazing content for you. Check back soon for our latest articles!
                            </p>
                            @auth
                                <a href="{{ route('dashboard.posts.create') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-2xl py-4 px-8 text-lg shadow-2xl transition-all duration-300 transform hover:scale-105">
                                    Create Your First Post
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-2xl py-4 px-8 text-lg shadow-2xl transition-all duration-300 transform hover:scale-105">
                                    Join Our Community
                                </a>
                            @endauth
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- CTA Section -->
        <div class="relative z-10 py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-gradient-to-r from-purple-600/20 to-pink-600/20 backdrop-blur-xl rounded-3xl p-12 border border-white/20">
                    <h2 class="text-4xl font-bold text-white mb-6">Ready to Share Your Story?</h2>
                    <p class="text-xl text-white/80 mb-8 leading-relaxed">
                        Join our community of writers and start creating amazing content that inspires and educates.
                    </p>
                    @guest
                        <div class="flex flex-col sm:flex-row gap-6 justify-center">
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold rounded-2xl py-4 px-8 text-lg transition-all duration-300 transform hover:scale-105 shadow-2xl">
                                Get Started Free
                            </a>
                            <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 text-white font-semibold rounded-2xl py-4 px-8 text-lg border-2 border-white/20 backdrop-blur-xl transition-all duration-300 transform hover:scale-105">
                                Sign In
                            </a>
                        </div>
                    @else
                        <a href="{{ route('dashboard.posts.create') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold rounded-2xl py-4 px-8 text-lg transition-all duration-300 transform hover:scale-105 shadow-2xl">
                            Create Your First Post
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="relative z-10 bg-black/20 backdrop-blur-xl border-t border-white/20 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white">BlogVerse</h3>
                    </div>
                    <p class="text-white/60 mb-8 max-w-2xl mx-auto">Share your stories, connect with readers, and build your audience. Your voice matters, and we're here to amplify it.</p>
                    <div class="flex justify-center space-x-8 mb-8">
                        <a href="{{ route('welcome') }}" class="text-white/60 hover:text-white transition-colors duration-300">Home</a>
                        <a href="{{ route('posts.index') }}" class="text-white/60 hover:text-white transition-colors duration-300">Blog</a>
                        @guest
                            <a href="{{ route('login') }}" class="text-white/60 hover:text-white transition-colors duration-300">Sign In</a>
                            <a href="{{ route('register') }}" class="text-white/60 hover:text-white transition-colors duration-300">Sign Up</a>
                        @endguest
                    </div>
                    <div class="border-t border-white/20 pt-8">
                        <p class="text-white/40 text-sm">&copy; {{ date('Y') }} BlogVerse. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-guest-layout> 