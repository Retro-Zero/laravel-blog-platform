<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('dashboard.comments.update', $comment) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Comment')" />
                            <textarea id="content" name="content" rows="4" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>{{ old('content', $comment->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-600">
                                <strong>Post:</strong> {{ $comment->post->title }}<br>
                                <strong>Author:</strong> {{ $comment->user->name }}<br>
                                <strong>Created:</strong> {{ $comment->created_at->format('M d, Y H:i') }}
                            </p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Update Comment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 