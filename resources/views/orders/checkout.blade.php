@extends('layouts.app')

@section('title', 'Checkout - Media-Tech')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>
        <form action="{{ route('orders.place') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Shipping Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">Informasi Pengiriman</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nomor HP</label>
                                <input type="text" name="number" required maxlength="16"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="08123456789">
                                @error('number')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                                <input type="email" name="email" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
                                <textarea name="address" rows="4" required maxlength="500"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Jalan, Nomor Rumah, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi"></textarea>
                                @error('address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Metode Pembayaran</label>
                                <select name="method" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="COD">COD (Cash on Delivery)</option>
                                    <option value="E-Wallet">E-Wallet (OVO/GoPay/Dana)</option>
                                </select>
                                @error('method')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                        <h2 class="text-xl font-bold mb-4">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4 mb-6">
                            @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $item->name }} ({{ $item->quantity }}x)</span>
                                <span class="font-semibold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-4 space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ongkir</span>
                                <span class="font-semibold">Gratis</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t">
                                <span class="text-lg font-bold">Total</span>
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Buat Pesanan
                        </button>
                        <a href="{{ route('cart.index') }}" class="block w-full text-center text-gray-600 mt-3 hover:underline">
                            Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection