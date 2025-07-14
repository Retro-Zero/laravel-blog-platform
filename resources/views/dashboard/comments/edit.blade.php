<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Comment') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        Edit <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Comment</span>
                    </h1>
                    <p class="text-xl text-gray-600">Update your comment content</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('dashboard.comments.update', $comment) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Comment Info -->
                        <div class="bg-gray-50 rounded-xl p-6 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Comment Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700">Post:</span>
                                    <p class="text-gray-900">{{ $comment->post->title }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Author:</span>
                                    <p class="text-gray-900">{{ $comment->user->name }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Created:</span>
                                    <p class="text-gray-900">{{ $comment->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comment Content -->
                        <div class="mb-8">
                            <x-input-label for="content" :value="__('Comment Content')" class="text-lg font-semibold text-gray-900 mb-2" />
                            <x-quill-editor 
                                name="content" 
                                :value="old('content', $comment->content)" 
                                placeholder="Write your comment here..."
                                height="200px"
                                required
                            />
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end pt-6 border-t border-gray-200">
                            <x-secondary-button type="button" onclick="window.history.back()" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors mr-4">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors">
                                {{ __('Update Comment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 