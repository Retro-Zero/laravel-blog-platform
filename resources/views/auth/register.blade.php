<x-guest-layout>
    <!-- Navigation -->
    <nav class="bg-white/60 backdrop-blur-lg border-b border-gray-200 sticky top-0 z-50 shadow-lg rounded-b-3xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="4" y="4" width="16" height="16" rx="4" fill="currentColor" class="text-blue-100"/>
                            <path d="M8 8h8M8 12h5M8 16h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <a href="{{ route('welcome') }}" class="text-2xl font-extrabold text-gray-900 tracking-tight drop-shadow">Blog Platform</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('posts.index') }}" class="text-gray-700 hover:text-blue-700 px-4 py-2 rounded-full text-base font-semibold transition-colors">Blog</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-xl text-base font-semibold shadow transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 px-4 py-2 rounded-full text-base font-semibold transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-xl text-base font-semibold shadow transition-all">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl w-full max-w-md p-10 animate-fade-in-up">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow mb-4 animate-bounce-slow">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="4" y="4" width="16" height="16" rx="4" fill="currentColor" class="text-blue-100"/>
                        <path d="M8 8h8M8 12h5M8 16h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Sign Up</h2>
                <p class="text-gray-500 mb-2 text-base">Create your account</p>
            </div>
            <form method="POST" action="{{ route('register') }}" class="space-y-7">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{ old('name') }}" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autocomplete="username" value="{{ old('email') }}" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <!-- Register Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-xl py-3 text-lg shadow-lg transition-all transform hover:-translate-y-1">Sign Up</button>
            </form>
            <div class="text-center mt-8 text-base text-gray-500">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Sign In</a>
            </div>
        </div>
    </div>
    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 1.2s cubic-bezier(0.23, 1, 0.32, 1);
        }
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 2.5s infinite;
        }
    </style>
</x-guest-layout>
