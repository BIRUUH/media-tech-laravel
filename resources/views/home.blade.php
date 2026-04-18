@extends('layouts.app')

@section('title', 'Media-Tech - Komponen IT Terlengkap')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4">Selamat Datang di Media-Tech</h1>
                <p class="text-xl mb-8">Komponen Laptop & Komputer Terlengkap dan Terpercaya</p>
                <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                    Belanja Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 ">
            <h2 class="text-3xl font-bold text-blue-600 text-center mb-8">Kategori Produk</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <i class="fas fa-laptop text-5xl text-blue-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-800">Laptop</h3>
                </div>
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <i class="fas fa-memory text-5xl text-blue-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-800">RAM</h3>
                </div>
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <i class="fas fa-hdd text-5xl text-blue-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-800">Storage</h3>
                </div>
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 text-center hover:shadow-lg transition cursor-pointer">
                    <i class="fas fa-microchip text-5xl text-blue-600 mb-4"></i>
                    <h3 class="font-semibold text-gray-800">Processor</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-blue-600 text-center mb-8">Produk Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-[0_10px_25px_-5px_rgba(37,32,255,0.6)] hover:-translate-y-1">
                    <div class="relative h-48 bg-white flex items-center justify-center">
                        @if(is_object($product) && $product->image_01)
                        <img src="{{ asset('storage/products/' . $product->image_01) }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain mx-auto my-auto">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-image text-6xl text-gray-400"></i>
                        </div>
                        @endif
                        @auth
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="absolute top-2 right-2">
                            @csrf
                            <button type="submit" class="bg-white text-red-500 w-10 h-10 rounded-full hover:bg-red-500 hover:text-white transition border border-red-600 flex items-center justify-center">
                                <i class="fas fa-heart"></i>
                            </button>
                        </form>
                        @endauth
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 text-gray-800 truncate">{{ $product->name }}</h3>
                        <p class="text-blue-600 font-bold text-xl mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $product->id) }}" class="flex-1 bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-center">
                                Detail
                            </a>
                            @auth
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center py-12">
                    <p class="text-gray-500">Belum ada produk tersedia</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition inline-block">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Kenapa memilih kami -->
    <section class="py-12 bg-white pb-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16">Kenapa Memilih Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shipping-fast text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold text-xl mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Produk dikirim dengan cepat dan aman</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-certificate text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold text-xl mb-2">Produk Original</h3>
                    <p class="text-gray-600">100% produk original bergaransi</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="font-semibold text-xl mb-2">Layanan 24/7</h3>
                    <p class="text-gray-600">Customer service siap membantu Anda</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection