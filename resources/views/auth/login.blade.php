@extends('layouts.app')

@section('content')
<section class="flex items-center justify-center py-20 bg-[#0d1117]">
    <div class="w-full max-w-md bg-[#161b22] border border-[#30363d] rounded-2xl shadow-lg p-8">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-[#8b949e]">Login to continue reading your favorite series 🌿</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
        
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-[#c9d1d9] mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full bg-[#0d1117] border border-[#30363d] text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="you@example.com" required>
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-[#c9d1d9] mb-1">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full bg-[#0d1117] border border-[#30363d] text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="••••••••" required>
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-[#8b949e]">
                    <input type="checkbox" class="rounded border-[#30363d] bg-[#0d1117]">
                    Remember me
                </label>
                <a href="#" class="text-blue-500 hover:underline">Forgot password?</a>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2 transition">
                Login
            </button>
        </form>

        <!-- Divider -->
        <div class="my-6 flex items-center justify-center text-[#8b949e] text-sm">
            <span class="border-t border-[#30363d] w-1/4"></span>
            <span class="px-2">or</span>
            <span class="border-t border-[#30363d] w-1/4"></span>
        </div>

        <!-- Social Login (opsional) -->
        <div class="space-y-3">
            <button class="w-full flex items-center justify-center gap-2 border border-[#30363d] text-[#c9d1d9] rounded-lg py-2 hover:bg-[#21262d] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21.35 11.1h-9.17v2.91h5.56a5.03 5.03 0 0 1-2.17 3.3v2.75h3.5a9 9 0 0 0 2.28-9.13z" fill="#4285F4"/>
                    <path d="M12.18 21a8.9 8.9 0 0 0 6.18-2.22l-3.5-2.75a5.6 5.6 0 0 1-8.28-2.94H3.01v2.82A9 9 0 0 0 12.18 21z" fill="#34A853"/>
                    <path d="M7.88 13.09a5.42 5.42 0 0 1 0-3.45V6.82H3.01a9 9 0 0 0 0 8.36l4.87-2.09z" fill="#FBBC05"/>
                    <path d="M12.18 4.56a4.87 4.87 0 0 1 3.44 1.35l2.56-2.56A8.9 8.9 0 0 0 3.01 6.82l4.87 2.82a5.57 5.57 0 0 1 4.3-5.08z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </button>
        </div>

        <!-- Register -->
        <p class="text-center text-sm text-[#8b949e] mt-6">
            Don’t have an account?
            <a href="#" class="text-blue-500 hover:underline">Sign up</a>
        </p>
    </div>
</section>
@endsection
