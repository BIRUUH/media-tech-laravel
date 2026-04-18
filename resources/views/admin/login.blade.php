<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Media-Tech</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="bg-blue-600 text-white w-16 h-16 rounded-lg flex items-center justify-center font-bold text-3xl mx-auto">
                    MT
                </div>
                <h2 class="mt-6 text-3xl font-bold text-white">
                    Admin Login
                </h2>
                <p class="mt-2 text-gray-400">Media-Tech Administration Panel</p>
            </div>

            <!-- Login Form -->
            <div class="bg-gray-800 py-8 px-6 shadow-lg rounded-lg border border-gray-700">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300">Username</label>
                            <input id="name" name="name" type="text" required 
                                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            <input id="password" name="password" type="password" required 
                                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('password')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" 
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-sign-in-alt mr-2 mt-1"></i> Login KUY
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-gray-300">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>