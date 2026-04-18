@extends('layouts.app')

@section('title', 'Pesanan Saya - Media-Tech')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-white">Pesanan Saya</h1>

        @if($orders->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-box text-6xl text-gray-400 mb-4"></i>
            <p class="text-gray-500 text-xl mb-4">Anda belum memiliki pesanan</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition inline-block">
                Mulai Belanja
            </a>
        </div>
        @else
        <div class="space-y-6">
            @foreach($orders as $order)
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-semibold text-lg">Order #{{ $order->id }}</h3>
                        <p class="text-gray-600 text-sm">{{ $order->placed_on->format('d M Y') }}</p>
                    </div>
                    <span class="px-4 py-1 rounded-full text-sm font-semibold
                    {{ $order->payment_status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $order->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $order->payment_status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>

                <div class="border-t border-b py-4 mb-4">
                    <p class="text-gray-700"><strong>Nama:</strong> {{ $order->name }}</p>
                    <p class="text-gray-700"><strong>Email:</strong> {{ $order->email }}</p>
                    <p class="text-gray-700"><strong>No. HP:</strong> {{ $order->number }}</p>
                    <p class="text-gray-700"><strong>Alamat:</strong> {{ $order->address }}</p>
                    <p class="text-gray-700"><strong>Metode Pembayaran:</strong> {{ $order->method }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-2"><strong>Produk:</strong></p>
                    <p class="text-gray-600">{{ $order->total_products }}</p>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold text-blue-600">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                    <div class="flex gap-2">
                        <a href="{{ route('orders.show', $order->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition inline-flex items-center">
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        </a>
                        <a href="{{ route('orders.download-pdf', $order->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition inline-flex items-center">
                            <i class="fas fa-file-pdf mr-2"></i> Download Nota
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection