<header class="bg-gradient-to-r from-blue-500 via-purple-500 to-blue-600 shadow-lg rounded-b-3xl px-4 sm:px-8 py-4 mb-8">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo & Project Name -->
        <div class="flex items-center gap-3">
            <!-- SVG Blog Logo -->
            <div class="w-10 h-10 bg-white/80 rounded-full flex items-center justify-center shadow">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="4" y="4" width="16" height="16" rx="4" fill="currentColor" class="text-blue-100"/>
                    <path d="M8 8h8M8 12h5M8 16h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight drop-shadow">Blog Platform</span>
        </div>
        <!-- Navigation -->
        <nav class="hidden md:flex items-center gap-2">
            <a href="{{ route('welcome') }}" class="px-4 py-2 rounded-full font-semibold text-white/90 hover:bg-white/20 transition @if(request()->routeIs('welcome')) underline underline-offset-4 @endif">Home</a>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full font-semibold text-white/90 hover:bg-white/20 transition @if(request()->routeIs('dashboard')) underline underline-offset-4 @endif">Dashboard</a>
            <a href="{{ route('dashboard.posts.index') }}" class="px-4 py-2 rounded-full font-semibold text-white/90 hover:bg-white/20 transition @if(request()->routeIs('dashboard.posts.*')) underline underline-offset-4 @endif">My Posts</a>
            <a href="{{ route('dashboard.comments.index') }}" class="px-4 py-2 rounded-full font-semibold text-white/90 hover:bg-white/20 transition @if(request()->routeIs('dashboard.comments.*')) underline underline-offset-4 @endif">Comments</a>
            <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-full font-semibold text-white/90 hover:bg-white/20 transition @if(request()->routeIs('profile.edit')) underline underline-offset-4 @endif">Profile</a>
        </nav>
        <!-- User Avatar Dropdown -->
        <div class="relative group ml-4">
            <button class="w-10 h-10 rounded-full bg-white/80 flex items-center justify-center font-bold text-blue-700 text-lg shadow">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </button>
            <div class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg py-2 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-opacity z-50">
                <div class="px-4 py-2 text-gray-700 font-semibold border-b">{{ Auth::user()->name }}</div>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-600 hover:bg-blue-50">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">Logout</button>
                </form>
            </div>
        </div>
        <!-- Mobile Nav Toggle (optional) -->
        <div class="md:hidden ml-2">
            <!-- Hamburger menu could go here if you want to expand for mobile -->
        </div>
    </div>
</header> 