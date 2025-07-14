<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl w-full max-w-md p-10 animate-fade-in-up">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow mb-4 animate-bounce-slow">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Forgot Password?</h2>
                <p class="text-gray-500 mb-2 text-base">Enter your email to reset your password</p>
            </div>
            
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 font-medium text-sm">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}" class="space-y-7">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email') }}" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Send Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-xl py-3 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">Send Password Reset Link</button>
            </form>
            <div class="text-center mt-8 text-base text-gray-500">
                Remember your password? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Sign In</a>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        .animate-bounce-slow {
            animation: bounce 2s infinite;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-guest-layout>
