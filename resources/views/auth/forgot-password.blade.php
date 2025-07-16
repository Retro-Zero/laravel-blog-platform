<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute top-40 left-40 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-50 bg-white/10 backdrop-blur-xl border-b border-white/20 sticky top-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-white tracking-tight">BlogVerse</a>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('posts.index') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white/80 hover:text-white px-4 py-2 rounded-xl text-base font-medium transition-all duration-300 hover:bg-white/10">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex items-center justify-center min-h-screen relative z-10">
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl w-full max-w-md p-10 border border-white/20 animate-fade-in-up">
                <div class="flex flex-col items-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg mb-4 animate-bounce-slow">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-1">Forgot Password?</h2>
                    <p class="text-white/60 mb-2 text-base">Enter your email to reset your password</p>
                </div>
                
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-500/20 backdrop-blur-xl border border-green-500/30 rounded-xl text-green-300 font-medium text-sm">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}" class="space-y-7">
                    @csrf
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white/80 mb-2">Email</label>
                        <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email') }}" 
                               class="w-full rounded-xl border border-white/20 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 px-4 py-3 text-base outline-none bg-white/10 text-white placeholder-white/50 backdrop-blur-xl transition-all duration-300" 
                               placeholder="Enter your email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Send Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl py-3 text-lg shadow-2xl transition-all duration-300 transform hover:scale-105">Send Password Reset Link</button>
                </form>
                <div class="text-center mt-8 text-base text-white/60">
                    Remember your password? <a href="{{ route('login') }}" class="text-purple-300 font-bold hover:text-purple-200 transition-colors">Sign In</a>
                </div>
            </div>
        </div>
        
        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
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
    </div>
</x-guest-layout>
