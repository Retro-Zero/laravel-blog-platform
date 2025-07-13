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
                {!! nl2br(e($post->content)) !!}
            </div>

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