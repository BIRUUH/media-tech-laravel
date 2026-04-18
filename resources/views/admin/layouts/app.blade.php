<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Media-Tech')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-600 text-white w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl">
                        MT
                    </div>
                    <span class="text-xl font-bold">Admin Panel</span>
                </div>
            </div>

            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.products.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-box"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pesens.list') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messages.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.messages.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-envelope"></i>
                            <span>Pesan</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-700">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition w-full">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ Auth::guard('admin')->user()->name }}</span>
                        <a href="{{ route('home') }}" target="_blank" class="text-blue-600 hover:text-blue-700">
                            <i class="fas fa-external-link-alt mr-2"></i>Lihat Situs
                        </a>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="mx-6 mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mx-6 mt-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 5000);
    </script>
    @livewireScripts
    @vite(['resources/js/app.js'])
</body>
</html>