<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form action="{{ route('signup') }}" method="POST" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-4">Create Account</h2>

        <input type="text" name="username" placeholder="Username" class="w-full mb-3 p-2 border rounded">
        <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded">
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded">

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Sign Up</button>
        <p class="mt-3 text-sm text-center">Already have an account? <a href="{{ route('signin.form') }}" class="text-blue-600">Sign In</a></p>
    </form>
</body>
</html>
