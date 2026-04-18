<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Media-Tech - Komponen IT Terlengkap')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="bg-sky-500 text-white w-10 h-10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-microchip text-xl"></i>
                        </div>
                        <span class="text-xl font-semibold text-gray-800">MediaTech</span>
                    </a>
                </div>

                <!-- Menu Tengah -->
                <div class="hidden md:flex space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-sky-50 hover:text-sky-600 {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600' : '' }}">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-sky-50 hover:text-sky-600 {{ request()->routeIs('products.*') ? 'bg-sky-50 text-sky-600' : '' }}">
                        <i class="fas fa-shopping-bag mr-2"></i>Belanja
                    </a>
                    <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-sky-50 hover:text-sky-600 {{ request()->routeIs('orders.*') ? 'bg-sky-50 text-sky-600' : '' }}">
                        <i class="fas fa-box mr-2"></i>Pesanan
                    </a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-sky-50 hover:text-sky-600 {{ request()->routeIs('contact') ? 'bg-sky-50 text-sky-600' : '' }}">
                        <i class="fas fa-envelope mr-2"></i>Hubungi Kami
                    </a>
                </div>

                <!-- Menu Kanan -->
                <div class="flex items-center space-x-3">
                    <!-- Search -->
                    <div class="hidden lg:block">
                        <form action="{{ route('products.index') }}" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Cari produk..."
                                class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                value="{{ request('search') }}">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </form>
                    </div>

                    @auth
                    <!-- Wishlist -->
                    <a href="{{ route('wishlist.index') }}" class="relative p-2 text-gray-600 hover:text-sky-600 hover:bg-sky-50 rounded-lg">
                        <i class="fas fa-heart text-xl"></i>
                        @if(isset($wishlistCount) && $wishlistCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $wishlistCount }}
                        </span>
                        @endif
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-sky-600 hover:bg-sky-50 rounded-lg">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-sky-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>
                    
                    <!-- Profile -->
                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = !open"
                            class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 focus:outline-none">
                            <i class="fas fa-user-circle text-2xl"></i>
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-box mr-2"></i> Pesanan Saya
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="bg-sky-500 text-white px-6 py-2 rounded-lg hover:bg-sky-600 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>


                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-700 p-2">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-sky-50 rounded-lg">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                <a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-sky-50 rounded-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>Belanja
                </a>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-sky-50 rounded-lg">
                    <i class="fas fa-box mr-2"></i>Pesanan
                </a>
                <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-sky-50 rounded-lg">
                    <i class="fas fa-envelope mr-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 my-4">
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg flex items-center justify-between" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <span class="text-green-800">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 my-4">
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg flex items-center justify-between" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                <span class="text-red-800">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="max-w-7xl mx-auto px-4 my-4">
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg flex items-center justify-between" role="alert">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-500 text-xl mr-3"></i>
                <span class="text-blue-800">{{ session('info') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-sky-500 w-10 h-10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <h3 class="text-xl font-bold">Media-Tech</h3>
                    </div>
                    <p class="text-gray-400">Toko komponen IT terlengkap dan terpercaya di Indonesia</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white">Belanja</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i>admin@mediatech.id.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 813 4463 5334</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Panglima Sudirman No.5 Pasuruan</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="bg-gray-700 hover:bg-sky-500 w-10 h-10 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-sky-500 w-10 h-10 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-sky-500 w-10 h-10 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 Media-Tech. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.remove();
            });
        }, 5000);
    </script>
    @livewireScripts
    @vite(['resources/js/app.js'])
</body>

</html>