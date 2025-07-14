<x-guest-layout>
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-900">{{ config('app.name', 'Laravel Blog') }}</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8">
            <h2 class="text-3xl font-bold mb-1">Sign In</h2>
            <p class="text-gray-400 mb-8 text-sm">to your account</p>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email') }}" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none pr-32" />
                    <a href="{{ route('password.request') }}" class="absolute right-3 top-9 text-sm text-blue-600 hover:underline font-medium">Forgot Password?</a>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Sign Up Button -->
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 text-base mt-2">Sign Up</button>
            </form>
            <div class="text-center mt-6 text-sm text-gray-400">
                Not a member yet? <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">Sign Up</a>
            </div>
                    </div>
        </div>
</x-guest-layout>