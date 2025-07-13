<x-guest-layout>
    <article class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <header class="mb-8">
                @if($post->category)
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-white rounded-full mb-4" style="background-color: {{ $post->category->color }}">
                        {{ $post->category->name }}
                    </span>
                @endif
                
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
                
                <div class="flex items-center text-gray-600 mb-6">
                    <span class="mr-4">By {{ $post->user->name }}</span>
                    <span class="mr-4">{{ $post->published_at->format('F d, Y') }}</span>
                    <span class="mr-4">👁️ {{ $post->view_count }} views</span>
                    <span>📖 {{ $post->reading_time }} min read</span>
                </div>
                
                @if($post->excerpt)
                    <p class="text-xl text-gray-600 leading-relaxed">{{ $post->excerpt }}</p>
                @endif
            </header>

            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="mb-8">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
            @endif

            <!-- Content -->
            <div class="prose prose-lg max-w-none">
                {!! $post->content !!}
            </div>

            <!-- Comments Section -->
            <section class="mt-12">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>
                @auth
                    <form action="{{ route('dashboard.comments.store') }}" method="POST" class="mb-8">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-4">
                            <textarea name="content" rows="3" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Add a comment..." required>{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                        <x-primary-button>{{ __('Post Comment') }}</x-primary-button>
                    </form>
                @else
                    <p class="mb-8 text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">log in</a> to comment.</p>
                @endauth

                @if($post->comments()->approved()->count() > 0)
                    <div class="space-y-6">
                        @foreach($post->comments()->approved()->latest()->get() as $comment)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <span class="font-semibold text-gray-800 mr-2">{{ $comment->user->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-gray-700">{{ $comment->content }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No comments yet.</p>
                @endif
            </section>

            <!-- Footer -->
            <footer class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-gray-600">Written by {{ $post->user->name }}</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800">
                            ← Back to Posts
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </article>
</x-guest-layout> 