<x-guest-layout>
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8">
        <h2 class="text-3xl font-bold mb-1">Forgot Password?</h2>
        <p class="text-gray-400 mb-8 text-sm">Enter your email to reset your password</p>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email') }}" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Send Button -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 text-base mt-2">Send Password Reset Link</button>
        </form>
        <div class="text-center mt-6 text-sm text-gray-400">
            Remember your password? <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Sign In</a>
        </div>
    </div>
</x-guest-layout>
