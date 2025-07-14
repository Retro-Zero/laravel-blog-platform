<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Header Section -->
        <div class="bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        Create <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">New Post</span>
                    </h1>
                    <p class="text-xl text-gray-600">Share your thoughts and stories with the world</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 gap-8">
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" class="text-lg font-semibold text-gray-900 mb-2" />
                                <x-text-input id="title" class="block w-full text-lg" type="text" name="title" :value="old('title')" required autofocus placeholder="Enter your post title..." />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Content -->
                            <div>
                                <x-input-label for="content" :value="__('Content')" class="text-lg font-semibold text-gray-900 mb-2" />
                                <x-quill-editor 
                                    name="content" 
                                    :value="old('content')" 
                                    placeholder="Write your post content here..."
                                    height="400px"
                                    required
                                />
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <!-- Two Column Layout for smaller fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Category -->
                                <div>
                                    <x-input-label for="category_id" :value="__('Category')" class="text-lg font-semibold text-gray-900 mb-2" />
                                    <select id="category_id" name="category_id" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-base">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                <!-- Status -->
                                <div>
                                    <x-input-label for="status" :value="__('Status')" class="text-lg font-semibold text-gray-900 mb-2" />
                                    <select id="status" name="status" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-base">
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Excerpt -->
                            <div>
                                <x-input-label for="excerpt" :value="__('Excerpt')" class="text-lg font-semibold text-gray-900 mb-2" />
                                <textarea id="excerpt" name="excerpt" rows="3" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-base" placeholder="Write a brief summary of your post...">{{ old('excerpt') }}</textarea>
                                <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
                            </div>

                            <!-- Featured Image -->
                            <div>
                                <x-input-label for="featured_image" :value="__('Featured Image')" class="text-lg font-semibold text-gray-900 mb-2" />
                                
                                <!-- Image Upload Tabs -->
                                <div class="mb-4">
                                    <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
                                        <button type="button" id="url-tab" class="flex-1 py-2 px-4 text-sm font-medium rounded-md bg-white text-gray-900 shadow-sm transition-colors" onclick="switchImageTab('url')">
                                            Image URL
                                        </button>
                                        <button type="button" id="upload-tab" class="flex-1 py-2 px-4 text-sm font-medium rounded-md text-gray-600 hover:text-gray-900 transition-colors" onclick="switchImageTab('upload')">
                                            Upload Image
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- URL Input -->
                                <div id="url-input" class="mb-4">
                                    <x-text-input id="featured_image" class="block w-full text-base" type="url" name="featured_image" :value="old('featured_image')" placeholder="https://example.com/image.jpg" />
                                    <p class="text-sm text-gray-500 mt-1">Enter a direct URL to an image</p>
                                </div>
                                
                                <!-- File Upload -->
                                <div id="upload-input" class="mb-4 hidden">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="featured_image_file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500">
                                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                                </p>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 2MB</p>
                                            </div>
                                            <input id="featured_image_file" name="featured_image_file" type="file" class="hidden" accept="image/*" />
                                        </label>
                                    </div>
                                    <div id="image-preview" class="mt-4 hidden">
                                        <img id="preview-img" src="" alt="Preview" class="max-w-full h-32 object-cover rounded-lg border border-gray-200">
                                    </div>
                                </div>
                                
                                <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                                <x-input-error :messages="$errors->get('featured_image_file')" class="mt-2" />
                            </div>

                            <!-- SEO Section -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>
                                <div class="grid grid-cols-1 gap-6">
                                    <!-- Meta Title -->
                                    <div>
                                        <x-input-label for="meta_title" :value="__('Meta Title (SEO)')" class="text-base font-semibold text-gray-900 mb-2" />
                                        <x-text-input id="meta_title" class="block w-full text-base" type="text" name="meta_title" :value="old('meta_title')" placeholder="SEO-optimized title for search engines..." />
                                        <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                                    </div>

                                    <!-- Meta Description -->
                                    <div>
                                        <x-input-label for="meta_description" :value="__('Meta Description (SEO)')" class="text-base font-semibold text-gray-900 mb-2" />
                                        <textarea id="meta_description" name="meta_description" rows="2" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-base" placeholder="Brief description for search engine results...">{{ old('meta_description') }}</textarea>
                                        <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('dashboard.posts.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-colors mr-4">
                                Cancel
                            </a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors">
                                {{ __('Create Post') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchImageTab(tab) {
            const urlTab = document.getElementById('url-tab');
            const uploadTab = document.getElementById('upload-tab');
            const urlInput = document.getElementById('url-input');
            const uploadInput = document.getElementById('upload-input');
            
            if (tab === 'url') {
                urlTab.className = 'flex-1 py-2 px-4 text-sm font-medium rounded-md bg-white text-gray-900 shadow-sm transition-colors';
                uploadTab.className = 'flex-1 py-2 px-4 text-sm font-medium rounded-md text-gray-600 hover:text-gray-900 transition-colors';
                urlInput.classList.remove('hidden');
                uploadInput.classList.add('hidden');
            } else {
                uploadTab.className = 'flex-1 py-2 px-4 text-sm font-medium rounded-md bg-white text-gray-900 shadow-sm transition-colors';
                urlTab.className = 'flex-1 py-2 px-4 text-sm font-medium rounded-md text-gray-600 hover:text-gray-900 transition-colors';
                uploadInput.classList.remove('hidden');
                urlInput.classList.add('hidden');
            }
        }

        // File upload preview
        document.getElementById('featured_image_file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });

        // Drag and drop functionality
        const dropZone = document.querySelector('label[for="featured_image_file"]');
        const fileInput = document.getElementById('featured_image_file');

        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('bg-blue-50', 'border-blue-300');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropZone.classList.remove('bg-blue-50', 'border-blue-300');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('bg-blue-50', 'border-blue-300');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout> 