<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl w-full max-w-md p-10 animate-fade-in-up">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow mb-4 animate-bounce-slow">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Reset Password</h2>
                <p class="text-gray-500 mb-2 text-base">Enter your new password</p>
            </div>
            
            <form method="POST" action="{{ route('password.store') }}" class="space-y-7">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email', $request->email) }}" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-3 text-base outline-none bg-white/80" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-xl py-3 text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    Reset Password
                </button>
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
