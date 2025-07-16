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
                        <a href="{{ route('posts.index') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative z-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="text-center">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-xl rounded-full px-6 py-3 mb-8 border border-white/20">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-white/80 text-sm font-medium">Join thousands of creators</span>
                    </div>
                    
                    <h1 class="text-6xl md:text-7xl font-bold text-white mb-8 leading-tight">
                        Share Your
                        <span class="bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Stories</span>
                        <br>With the World
                    </h1>
                    
                    <p class="text-2xl text-white/80 mb-12 max-w-3xl mx-auto font-light leading-relaxed">
                        Create, publish, and connect with readers worldwide. 
                        Your voice matters, and we're here to amplify it.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-6 justify-center mb-16">
                        <a href="{{ route('posts.index') }}" class="group bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-2xl py-5 px-10 text-lg shadow-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-purple-500/25">
                            <span class="flex items-center gap-3">
                                Explore Posts
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </a>
                        @guest
                            <a href="{{ route('register') }}" class="group bg-white/10 hover:bg-white/20 text-white font-bold rounded-2xl py-5 px-10 text-lg border-2 border-white/20 backdrop-blur-xl transition-all duration-300 transform hover:scale-105">
                                <span class="flex items-center gap-3">
                                    Start Writing
                                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </span>
                            </a>
                        @endguest
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-white mb-2">{{ number_format($stats['total_posts']) }}+</div>
                            <div class="text-white/60 text-sm">Published Posts</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-white mb-2">{{ number_format($stats['total_users']) }}+</div>
                            <div class="text-white/60 text-sm">Active Writers</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-white mb-2">{{ number_format($stats['total_comments']) }}+</div>
                            <div class="text-white/60 text-sm">Engaging Comments</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Posts Section -->
        @if($featuredPosts->count() > 0)
        <div class="relative z-10 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4">Featured Stories</h2>
                    <p class="text-xl text-white/60">Discover our most popular articles</p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    @foreach($featuredPosts as $index => $post)
                        <article class="group bg-white/10 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/20 hover:border-white/40 transition-all duration-500 transform hover:scale-105">
                            @if($post->featured_image)
                                <div class="relative h-64 overflow-hidden">
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                </div>
                            @else
                                <div class="relative h-64 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                                    <span class="text-white text-6xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                </div>
                            @endif
                            
                            <div class="p-8">
                                @if($post->category)
                                    <span class="inline-block px-4 py-2 text-xs font-semibold text-white rounded-full mb-4 bg-gradient-to-r from-purple-500 to-pink-500">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                
                                <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-purple-300 transition-colors">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                
                                <p class="text-white/70 mb-6 line-clamp-3 leading-relaxed">
                                    {{ $post->excerpt }}
                                </p>
                                
                                <div class="flex items-center justify-between text-sm text-white/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($post->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-white/70">{{ $post->user->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            {{ $post->view_count }}
                                        </span>
                                        <span class="flex items-center gap-1">
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
            </div>
        </div>
        @endif

        <!-- Features Section -->
        <div class="relative z-10 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4">Why Choose BlogVerse?</h2>
                    <p class="text-xl text-white/60">Everything you need to create amazing content</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 hover:border-white/40 transition-all duration-500 transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Rich Editor</h3>
                        <p class="text-white/70 leading-relaxed">Create beautiful content with our advanced rich text editor. Format text, add images, and create engaging posts with ease.</p>
                    </div>
                    
                    <div class="group bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 hover:border-white/40 transition-all duration-500 transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Community</h3>
                        <p class="text-white/70 leading-relaxed">Connect with readers through comments and discussions. Build a community around your content and engage with your audience.</p>
                    </div>
                    
                    <div class="group bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 hover:border-white/40 transition-all duration-500 transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Analytics</h3>
                        <p class="text-white/70 leading-relaxed">Track your post performance with detailed analytics. Understand what resonates with your audience and grow your reach.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Posts Section -->
        @if($latestPosts->count() > 0)
        <div class="relative z-10 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4">Latest Stories</h2>
                    <p class="text-xl text-white/60">Fresh content from our community</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestPosts as $post)
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
                            
                            <div class="p-6">
                                @if($post->category)
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full mb-3 bg-gradient-to-r from-purple-500 to-pink-500">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                
                                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-300 transition-colors">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                
                                <p class="text-white/70 mb-4 line-clamp-3 leading-relaxed">
                                    {{ $post->excerpt }}
                                </p>
                                
                                <div class="flex items-center justify-between text-sm text-white/50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($post->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-white/70">{{ $post->user->name }}</span>
                                    </div>
                                    <span class="text-white/50">{{ $post->created_at->format('M d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold rounded-2xl py-4 px-8 text-lg shadow-2xl transition-all duration-300 transform hover:scale-105">
                        View All Posts
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- CTA Section -->
        <div class="relative z-10 py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-gradient-to-r from-purple-600/20 to-pink-600/20 backdrop-blur-xl rounded-3xl p-12 border border-white/20">
                    <h2 class="text-4xl font-bold text-white mb-6">Ready to Share Your Story?</h2>
                    <p class="text-xl text-white/80 mb-8 leading-relaxed">
                        Join our community of writers and share your stories with the world. 
                        Create your account today and start your blogging journey.
                    </p>
                    @guest
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
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
