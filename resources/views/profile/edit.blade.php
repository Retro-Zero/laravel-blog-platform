<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 rounded-3xl shadow-2xl p-10">
                <div class="flex flex-col items-center mb-10">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-lg mb-4">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M6 20c0-2.21 3.134-4 6-4s6 1.79 6 4" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Profile</h1>
                    <p class="text-gray-500 text-lg">Manage your account information and security</p>
                </div>
                <div class="space-y-10">
                    <div class="p-6 bg-white rounded-2xl shadow border border-gray-100">
                        <h2 class="text-xl font-bold text-blue-700 mb-4">Profile Information</h2>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <div class="border-t border-dashed border-blue-100"></div>
                    <div class="p-6 bg-white rounded-2xl shadow border border-gray-100">
                        <h2 class="text-xl font-bold text-purple-700 mb-4">Update Password</h2>
                        @include('profile.partials.update-password-form')
                    </div>
                    <div class="border-t border-dashed border-blue-100"></div>
                    <div class="p-6 bg-white rounded-2xl shadow border border-gray-100">
                        <h2 class="text-xl font-bold text-red-600 mb-4">Delete Account</h2>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
