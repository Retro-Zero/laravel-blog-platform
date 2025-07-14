<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Welcome Section -->
        <div class="bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        Welcome back, <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>!
                    </h1>
                    <p class="text-xl text-gray-600">Manage your blog content and track your progress</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Total Posts Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Posts</p>
                            <p class="text-3xl font-bold text-gray-900">{{ Auth::user()->posts()->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('dashboard.posts.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View all posts →</a>
                    </div>
                </div>

                <!-- Total Comments Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Comments</p>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ \App\Models\Comment::whereIn('post_id', Auth::user()->posts()->pluck('id'))->count() }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('dashboard.comments.index') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium">View all comments →</a>
                    </div>
                </div>

                <!-- Total Views Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Views</p>
                            <p class="text-3xl font-bold text-gray-900">{{ Auth::user()->posts()->get()->sum('unique_view_count') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-green-600 text-sm font-medium">Across all posts</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('dashboard.posts.create') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Create Post</p>
                            <p class="text-sm text-gray-600">Write a new article</p>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.posts.index') }}" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors">
                        <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">My Posts</p>
                            <p class="text-sm text-gray-600">Manage your articles</p>
                        </div>
                    </a>

                    <a href="{{ route('dashboard.comments.index') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors">
                        <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Comments</p>
                            <p class="text-sm text-gray-600">Review feedback</p>
                        </div>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-colors">
                        <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Profile</p>
                            <p class="text-sm text-gray-600">Update settings</p>
                        </div>
                    </a>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
