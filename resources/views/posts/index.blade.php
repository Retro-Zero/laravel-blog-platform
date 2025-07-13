<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Blog Posts</h1>
                <p class="text-lg text-gray-600">Discover our latest articles and insights</p>
            </div>

            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                @if($post->category)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full mb-2" style="background-color: {{ $post->category->color }}">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                
                                <h2 class="text-xl font-bold text-gray-900 mb-2">
                                    <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition-colors duration-200">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                
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
                
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No published posts yet.</p>
                </div>
            @endif
        </div>
    </div>
</x-guest-layout> 