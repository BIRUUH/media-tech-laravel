@extends('layouts.app')

@section('title', 'Detail Pesanan - Media-Tech')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-white hover:text-gray-700 transition font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pesanan Saya
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">Detail Pesanan #{{ $order->id }}</h1>
                        <p class="text-blue-100 mt-1">{{ $order->placed_on->format('d F Y, H:i') }} WIB</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ $order->payment_status == 'completed' ? 'bg-green-500 text-white' : '' }}
                    {{ $order->payment_status == 'pending' ? 'bg-yellow-400 text-gray-800' : '' }}
                    {{ $order->payment_status == 'cancelled' ? 'bg-red-500 text-white' : '' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <!-- Customer Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <h3 class="font-bold text-lg mb-3 text-gray-800">Informasi Penerima</h3>
                        <div class="space-y-2">
                            <div class="flex">
                                <span class="text-gray-600 w-24">Nama:</span>
                                <span class="font-semibold text-gray-800">{{ $order->name }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-600 w-24">Email:</span>
                                <span class="text-gray-800">{{ $order->email }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-600 w-24">No. HP:</span>
                                <span class="text-gray-800">{{ $order->number }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 rounded-lg p-4">
                        <h3 class="font-bold text-lg mb-3 text-gray-800">Informasi Pengiriman</h3>
                        <div class="space-y-2">
                            <div class="flex">
                                <span class="text-gray-600 w-32">Alamat:</span>
                                <span class="text-gray-800">{{ $order->address }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-600 w-32">Pembayaran:</span>
                                <span class="text-gray-800">{{ $order->method }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk yang dipesan -->
                <div class="mb-8">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Produk yang Dipesan</h3>
                    <div class="space-y-4">
                        @php
                        $products = explode(', ', $order->total_products);
                        $productsData = [];

                        foreach ($products as $productString) {
                        preg_match('/(.+?)\s*\((\d+)\)/', $productString, $matches);
                        if (count($matches) >= 3) {
                        $productName = trim($matches[1]);
                        $quantity = (int) $matches[2];

                        // Find product in database to get image
                        $product = \App\Models\Product::where('name', 'LIKE', '%' . $productName . '%')->first();

                        $productsData[] = [
                        'name' => $productName,
                        'quantity' => $quantity,
                        'image' => $product ? $product->image_01 : null,
                        'price' => $product ? $product->price : 0
                        ];
                        }
                        }
                        @endphp

                        @foreach($productsData as $index => $item)
                        <div class="flex items-center bg-gray-100 rounded-lg p-4 border border-gray-200">
                            <div class="w-20 h-20 bg-white rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                @if($item['image'])
                                <img src="{{ asset('storage/products/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-2xl text-gray-300"></i>
                                </div>
                                @endif
                            </div>

                            <div class="flex-1 ml-4">
                                <h4 class="font-semibold text-gray-800">{{ $item['name'] }}</h4>
                                <p class="text-gray-600 text-sm">Jumlah: {{ $item['quantity'] }} item</p>
                                @if($item['price'] > 0)
                                <p class="text-blue-600 font-semibold mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }} / item</p>
                                @endif
                            </div>

                            @if($item['price'] > 0)
                            <div class="text-right">
                                <p class="text-gray-600 text-sm">Subtotal</p>
                                <p class="font-bold text-lg text-gray-800">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Total -->
                <div class="border-t pt-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-bold text-gray-800">Total Pembayaran:</span>
                        <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('orders.download-pdf', $order->id) }}" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition text-center font-semibold inline-flex items-center justify-center">
                            <i class="fas fa-file-pdf mr-2"></i> Download Nota PDF
                        </a>
                        <a href="{{ route('orders.index') }}" class="flex-1 bg-gray-300 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-400 transition text-center font-semibold">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection