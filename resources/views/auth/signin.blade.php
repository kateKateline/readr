<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form action="{{ route('signin') }}" method="POST" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-4">Sign In</h2>

        @if(session('error'))
            <div class="text-red-500 text-sm mb-2">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="text-green-500 text-sm mb-2">{{ session('success') }}</div>
        @endif

        <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded">

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Sign In</button>
        <p class="mt-3 text-sm text-center">Don't have an account? <a href="{{ route('signup.form') }}" class="text-blue-600">Sign Up</a></p>
    </form>
</body>
</html>
