@extends('layouts.app')

@section('title', 'Keranjang - Media-Tech')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-white">Keranjang Belanja</h1>
            <p class="text-white mt-1">Kelola produk yang akan Anda beli</p>
        </div>


    <div class="max-w-7xl mx-auto px-4 py-8">
        @if($cartItems->isEmpty())
        <div class="text-center py-16 bg-white rounded-lg shadow-sm">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-xl mb-4">Keranjang Anda masih kosong</p>
            <a href="{{ route('products.index') }}" class="bg-sky-500 text-white px-6 py-3 rounded-lg hover:bg-sky-600 transition inline-block">
                <i class="fas fa-shopping-bag mr-2"></i> Mulai Belanja
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 flex items-center space-x-4">
                    <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                        @if($item->image)
                        <img src="{{ asset('storage/products/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-image text-3xl text-gray-300"></i>
                        </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h3 class="font-semibold text-lg mb-1 text-gray-800">{{ $item->name }}</h3>
                        <p class="text-sky-600 font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Quantity -->
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="10"
                                class="w-16 px-2 py-1 border border-gray-300 rounded text-center focus:outline-none focus:ring-2 focus:ring-sky-500"
                                onchange="this.form.submit()">
                        </form>

                        <!-- Subtotal -->
                        <div class="w-32 text-right">
                            <p class="font-semibold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>

                        <!-- Remove Button -->
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 p-2" onclick="return confirm('Hapus produk ini dari keranjang?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-20">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Ringkasan Pesanan</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $cartItems->count() }} item)</span>
                            <span class="font-semibold text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkir</span>
                            <span class="font-semibold text-green-600">Gratis</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span class="text-lg font-bold text-sky-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('orders.checkout') }}" class="block w-full bg-sky-500 text-white text-center px-6 py-3 rounded-lg hover:bg-sky-600 transition font-semibold mb-3">
                        <i class="fas fa-shopping-cart mr-2"></i> Checkout
                    </a>
                    <a href="{{ route('products.index') }}" class="block w-full text-center text-sky-600 hover:underline">
                        <i class="fas fa-arrow-left mr-2"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection