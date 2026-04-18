@extends('layouts.app')

@section('title', $product->name . ' - Media-Tech')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <nav class="text-sm">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-sky-600">Beranda</a>
                <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-sky-600">Belanja</a>
                <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                <span class="text-gray-800">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div>
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-4">
                    @if($product->image_01)
                    <img id="main-image" src="{{ asset('storage/products/' . $product->image_01) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                    @else
                    <div class="w-full h-96 flex items-center justify-center bg-gray-100">
                        <i class="fas fa-image text-9xl text-gray-300"></i>
                    </div>
                    @endif
                </div>

                <!-- Thumbnail Images -->
                @if($product->image_01 || $product->image_02 || $product->image_03)
                <div class="grid grid-cols-3 gap-4">
                    @if($product->image_01)
                    <div class="cursor-pointer border-2 border-sky-500 rounded-lg overflow-hidden thumbnail-image" data-image="{{ asset('storage/products/' . $product->image_01) }}">
                        <img src="{{ asset('storage/products/' . $product->image_01) }}" alt="{{ $product->name }}" class="w-full h-24 object-cover">
                    </div>
                    @endif

                    @if($product->image_02)
                    <div class="cursor-pointer border-2 border-gray-200 hover:border-sky-500 rounded-lg overflow-hidden thumbnail-image" data-image="{{ asset('storage/products/' . $product->image_02) }}">
                        <img src="{{ asset('storage/products/' . $product->image_02) }}" alt="{{ $product->name }}" class="w-full h-24 object-cover">
                    </div>
                    @endif

                    @if($product->image_03)
                    <div class="cursor-pointer border-2 border-gray-200 hover:border-sky-500 rounded-lg overflow-hidden thumbnail-image" data-image="{{ asset('storage/products/' . $product->image_03) }}">
                        <img src="{{ asset('storage/products/' . $product->image_03) }}" alt="{{ $product->name }}" class="w-full h-24 object-cover">
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Product Details -->
            <div>
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div>
                        <a href="{{ url()->previous() ?? route('products.index') }}"
                            class="inline-flex items-center mb-4 text-gray-600 hover:text-blue-600 transition font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>

                    <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $product->name }}</h1>

                    <div class="mb-6">
                        <span class="text-4xl font-bold text-sky-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <div class="mb-6 border-t border-b border-gray-200 py-4">
                        <h3 class="font-semibold text-lg mb-2 text-gray-800">Deskripsi Produk</h3>
                        <p class="text-gray-600 whitespace-pre-line">{{ $product->details }}</p>
                    </div>

                    @auth
                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <div class="flex items-center space-x-4 mb-4">
                            <label class="font-semibold text-gray-700">Jumlah:</label>
                            <input type="number" name="quantity" value="1" min="1" max="10"
                                class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500">
                        </div>
                        <button type="submit" class="w-full bg-sky-500 text-white px-6 py-3 rounded-lg hover:bg-sky-600 transition font-semibold mb-3">
                            <i class="fas fa-cart-plus mr-2"></i> Tambah ke Keranjang
                        </button>
                    </form>

                    <!-- Add to Wishlist -->
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full border-2 border-red-500 text-red-500 px-6 py-3 rounded-lg hover:bg-red-500 hover:text-white transition font-semibold">
                            <i class="fas fa-heart mr-2"></i> Tambah ke Wishlist
                        </button>
                    </form>
                    @else
                    <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-lg">
                        <i class="fas fa-info-circle mr-2"></i>
                        Silakan <a href="{{ route('login') }}" class="font-semibold underline">login</a> untuk membeli produk ini.
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbnail-image');

            thumbnails.forEach(function(thumbnail) {
                thumbnail.addEventListener('click', function() {
                    const imageSrc = this.getAttribute('data-image');
                    document.getElementById('main-image').src = imageSrc;

                    thumbnails.forEach(t => {
                        t.classList.remove('border-sky-500');
                        t.classList.add('border-gray-200');
                    });

                    this.classList.remove('border-gray-200');
                    this.classList.add('border-sky-500');
                });
            });
        });
    </script>
</div>
@endsection