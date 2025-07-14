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
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-blue-700 px-4 py-2 rounded-full text-base font-semibold transition-colors">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-xl text-base font-semibold shadow transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 px-4 py-2 rounded-full text-base font-semibold transition-colors">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-xl text-base font-semibold shadow transition-all">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl p-12 text-center flex flex-col items-center animate-fade-in-up">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow mb-6 animate-bounce-slow">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="4" y="4" width="16" height="16" rx="4" fill="currentColor" class="text-blue-100"/>
                            <path d="M8 8h8M8 12h5M8 16h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Welcome to <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Blog Platform</span>
                    </h1>
                    <p class="text-2xl text-gray-700 mb-10 max-w-2xl mx-auto font-medium">
                        Discover, write, and connect with a world of stories. <br class="hidden md:block"> Elevate your voice on a platform built for creators.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('posts.index') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-xl py-4 px-10 text-lg shadow-lg transition-all transform hover:-translate-y-1">
                            Explore Posts
                        </a>
                        @guest
                            <a href="{{ route('register') }}" class="bg-white/90 hover:bg-gray-50 text-blue-600 font-bold rounded-xl py-4 px-10 text-lg border-2 border-blue-600 shadow transition-all transform hover:-translate-y-1">
                                Get Started
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
            <!-- Decorative Blobs -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-40 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Features Section -->
        <div class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Why Choose Our Platform?</h2>
                    <p class="text-2xl text-gray-600 font-medium">Everything you need to create and share amazing content</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="text-center p-10 rounded-3xl bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg hover:shadow-2xl transition-all">
                        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Rich Text Editor</h3>
                        <p class="text-gray-600 text-lg">Create beautiful content with our advanced rich text editor. Format text, add images, and create engaging posts.</p>
                    </div>
                    <div class="text-center p-10 rounded-3xl bg-gradient-to-br from-purple-50 to-purple-100 shadow-lg hover:shadow-2xl transition-all">
                        <div class="w-16 h-16 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Community Engagement</h3>
                        <p class="text-gray-600 text-lg">Connect with readers through comments and discussions. Build a community around your content.</p>
                    </div>
                    <div class="text-center p-10 rounded-3xl bg-gradient-to-br from-green-50 to-green-100 shadow-lg hover:shadow-2xl transition-all">
                        <div class="w-16 h-16 bg-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Analytics & Insights</h3>
                        <p class="text-gray-600 text-lg">Track your post performance with detailed analytics. Understand what resonates with your audience.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Posts Section -->
        @if(isset($latestPosts) && $latestPosts->count() > 0)
        <div class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Latest Posts</h2>
                    <p class="text-2xl text-gray-600 font-medium">Discover our most recent articles</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($latestPosts as $post)
                        <article class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                    <span class="text-white text-3xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="p-6">
                                @if($post->category)
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full mb-3" style="background-color: {{ $post->category->color }}">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                    <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition-colors duration-200">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $post->excerpt }}
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <span class="mr-4">{{ $post->user->name }}</span>
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="mr-2">👁️ {{ $post->view_count }}</span>
                                        <span>📖 {{ $post->reading_time }} min</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    <a href="{{ route('posts.index') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl py-3 px-8 text-lg shadow transition-all">
                        View All Posts
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- CTA Section -->
        <div class="py-24 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-extrabold text-white mb-6">Ready to Start Writing?</h2>
                <p class="text-2xl text-blue-100 mb-8 max-w-2xl mx-auto font-medium">
                    Join our community of writers and share your stories with the world. 
                    Create your account today and start your blogging journey.
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
                    <h3 class="text-2xl font-bold mb-4">Blog Platform</h3>
                    <p class="text-gray-400 mb-8">Share your stories, connect with readers, and build your audience.</p>
                    <div class="flex justify-center space-x-6">
                        <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-white transition-colors">Blog</a>
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Sign In</a>
                            <a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Sign Up</a>
                        @endguest
                    </div>
                    <div class="mt-8 pt-8 border-t border-gray-800">
                        <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Blog Platform. All rights reserved.</p>
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
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 1.2s cubic-bezier(0.23, 1, 0.32, 1);
        }
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 2.5s infinite;
        }
    </style>
</x-guest-layout>
