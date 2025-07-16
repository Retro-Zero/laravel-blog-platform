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
                        <a href="{{ route('posts.index') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Post Content -->
        <div class="relative z-10 py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <article class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
                    @if($post->featured_image)
                        <div class="relative overflow-hidden">
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                    @else
                        <div class="w-full h-64 md:h-96 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20"></div>
                            <span class="text-white text-7xl font-bold relative z-10">{{ substr($post->title, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <div class="p-10">
                        <!-- Post Header -->
                        <header class="mb-10">
                            @if($post->category)
                                <span class="inline-block px-4 py-2 text-sm font-bold text-white rounded-full mb-6 shadow-lg bg-gradient-to-r from-purple-500 to-pink-500">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            
                            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                                {{ $post->title }}
                            </h1>
                            
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xl font-bold mr-5 shadow-lg">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-white text-lg">{{ $post->user->name }}</div>
                                        <div class="text-sm text-white/60">{{ $post->created_at->format('F d, Y') }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-6 text-sm text-white/60">
                                    <span class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-xl">
                                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ $post->view_count }} views
                                    </span>
                                    <span class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-xl">
                                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $post->reading_time }} min read
                                    </span>
                                </div>
                            </div>
                            
                            @if($post->excerpt)
                                <div class="bg-gradient-to-r from-purple-500/20 to-pink-500/20 backdrop-blur-xl rounded-2xl p-6 border border-white/20">
                                    <p class="text-lg text-white italic font-medium">
                                        {{ $post->excerpt }}
                                    </p>
                                </div>
                            @endif
                        </header>
                        
                        <!-- Post Content -->
                        <div class="prose prose-lg max-w-none prose-headings:text-white prose-p:text-white prose-a:text-purple-300 prose-strong:text-white prose-ul:text-white prose-ol:text-white prose-li:text-white prose-blockquote:text-white/90 prose-blockquote:border-purple-500 prose-code:text-purple-300 prose-pre:bg-white/10 prose-pre:border-white/20 [&_*]:text-white [&_p]:text-white [&_div]:text-white [&_span]:text-white">
                            {!! $post->content !!}
                        </div>
                        
                        <!-- Post Footer -->
                        <footer class="mt-12 pt-8 border-t border-white/20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-white/60 font-medium">Share this post:</span>
                                    <div class="flex space-x-3">
                                        <a href="#" class="w-10 h-10 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full flex items-center justify-center hover:shadow-lg transition-all transform hover:scale-105">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full flex items-center justify-center hover:shadow-lg transition-all transform hover:scale-105">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                            </svg>
                                        </a>
                                        <a href="#" class="w-10 h-10 bg-gradient-to-r from-green-600 to-blue-600 text-white rounded-full flex items-center justify-center hover:shadow-lg transition-all transform hover:scale-105">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <a href="{{ route('posts.index') }}" class="text-purple-300 hover:text-purple-200 font-bold transition-colors flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Back to Blog
                                </a>
                            </div>
                        </footer>
                    </div>
                </article>
                
                <!-- Comments Section -->
                @if($post->comments->count() > 0)
                <div class="mt-12 bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-10">
                    <h3 class="text-3xl font-bold text-white mb-8">Comments ({{ $post->comments->count() }})</h3>
                    
                    <div class="space-y-8">
                        @foreach($post->comments as $comment)
                            <div class="border-b border-white/20 pb-8 last:border-b-0">
                                <div class="flex items-start space-x-5">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-lg font-bold shadow-lg">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-3">
                                            <span class="font-bold text-white text-lg">{{ $comment->user->name }}</span>
                                            <span class="text-sm text-white/50 bg-white/10 px-3 py-1 rounded-full backdrop-blur-xl">{{ $comment->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="prose prose-sm max-w-none prose-p:text-white prose-a:text-purple-300 [&_*]:text-white [&_p]:text-white [&_div]:text-white [&_span]:text-white">
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
                <div class="mt-8 bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-10">
                    <h3 class="text-3xl font-bold text-white mb-8">Leave a Comment</h3>
                    
                    <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                        @csrf
                        <div class="mb-8">
                            <x-quill-editor 
                                name="content" 
                                :value="old('content')" 
                                placeholder="Share your thoughts..."
                                height="200px"
                                required
                            />
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl py-4 px-8 text-lg shadow-2xl transition-all duration-300 transform hover:scale-105">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="mt-8 bg-gradient-to-r from-purple-500/20 to-pink-500/20 backdrop-blur-xl rounded-3xl p-10 text-center border border-white/20">
                    <h3 class="text-2xl font-bold text-white mb-4">Join the Discussion</h3>
                    <p class="text-white mb-8 text-lg">Sign in to leave a comment and join the conversation.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl py-4 px-8 text-lg shadow-2xl transition-all duration-300 transform hover:scale-105">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl py-4 px-8 text-lg border-2 border-white/20 backdrop-blur-xl transition-all duration-300 transform hover:scale-105">
                            Sign Up
                        </a>
                    </div>
                </div>
                @endauth
            </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
        <div class="relative z-10 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-4">Related Posts</h2>
                    <p class="text-xl text-white/60">Discover more content you might enjoy</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:scale-105 group">
                            @if($relatedPost->featured_image)
                                <div class="relative overflow-hidden">
                                    <img src="{{ $relatedPost->featured_image }}" alt="{{ $relatedPost->title }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                </div>
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20"></div>
                                    <span class="text-white text-4xl font-bold relative z-10">{{ substr($relatedPost->title, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                @if($relatedPost->category)
                                    <span class="inline-block px-3 py-1 text-xs font-bold text-white rounded-full mb-3 shadow-lg bg-gradient-to-r from-purple-500 to-pink-500">
                                        {{ $relatedPost->category->name }}
                                    </span>
                                @endif
                                
                                <h3 class="text-lg font-bold text-white mb-3 group-hover:text-purple-300 transition-colors duration-300">
                                    <a href="{{ route('posts.show', $relatedPost) }}" class="hover:text-purple-300 transition-colors duration-200">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>
                                
                                <p class="text-white mb-4 line-clamp-3 leading-relaxed">
                                    {{ $relatedPost->excerpt }}
                                </p>
                                
                                <div class="flex items-center justify-between text-sm text-white/50">
                                    <span class="font-medium text-white/80">{{ $relatedPost->user->name }}</span>
                                    <span class="bg-white/10 px-3 py-1 rounded-full backdrop-blur-xl">{{ $relatedPost->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
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
            
            /* Force white text for Quill editor content */
            .prose [data-gramm="false"] {
                color: white !important;
            }
            .prose p {
                color: white !important;
            }
            .prose div {
                color: white !important;
            }
            .prose span {
                color: white !important;
            }
            .prose * {
                color: white !important;
            }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-guest-layout> 