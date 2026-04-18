@extends('layouts.app')

@section('title', 'Wishlist - Media-Tech')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-3xl text-white font-bold">Wishlist Saya</h1>
        <p class="text-white mt-1">Produk yang Anda sukai</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        @if($wishlistItems->isEmpty())
        <div class="text-center py-16 bg-white rounded-lg shadow-sm">
            <i class="fas fa-heart text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-xl mb-4">Wishlist Anda masih kosong</p>
            <a href="{{ route('products.index') }}" class="bg-sky-500 text-white px-6 py-3 rounded-lg hover:bg-sky-600 transition inline-block">
                <i class="fas fa-shopping-bag mr-2"></i> Mulai Belanja
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="relative h-48 bg-gray-100">
                    @if($item->image)
                    <img src="{{ asset('storage/products/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-image text-6xl text-gray-300"></i>
                    </div>
                    @endif

                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-white text-red-500 w-10 h-10 rounded-full hover:bg-red-500 hover:text-white transition shadow-lg" onclick="return confirm('Hapus dari wishlist?')">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                </div>

                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 text-gray-800 truncate">{{ $item->name }}</h3>
                    <p class="text-sky-600 font-bold text-xl mb-4">Rp {{ number_format($item->price, 0, ',', '.') }}</p>

                    <div class="flex space-x-2">
                        <a href="{{ route('products.show', $item->pid) }}" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-center font-medium">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                        <form action="{{ route('cart.add', $item->pid) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition font-medium">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection