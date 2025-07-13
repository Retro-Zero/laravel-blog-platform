<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments on My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($comments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('posts.show', $comment->post) }}" class="text-blue-600 hover:underline">{{ $comment->post->title }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $comment->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ Str::limit($comment->content, 60) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($comment->status === 'approved') bg-green-100 text-green-800
                                                    @elseif($comment->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($comment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $comment->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @can('update', $comment)
                                                    <a href="{{ route('dashboard.comments.edit', $comment) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                @endcan
                                                @can('delete', $comment)
                                                    <button type="button" 
                                                            onclick="showDeleteConfirm(() => { document.getElementById('delete-form-{{ $comment->id }}').submit(); })" 
                                                            class="text-red-600 hover:text-red-900">
                                                        Delete
                                                    </button>
                                                    <form id="delete-form-{{ $comment->id }}" action="{{ route('dashboard.comments.destroy', $comment) }}" method="POST" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $comments->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No comments yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 