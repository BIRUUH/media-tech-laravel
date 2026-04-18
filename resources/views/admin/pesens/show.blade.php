@extends('admin.layouts.app')

@section('title', 'Detail Pesanan - Admin Media-Tech')
@section('page-title', 'Detail Pesanan #' . $list->id)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- ===================== --}}
    {{-- Informasi Pesanan     --}}
    {{-- ===================== --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Informasi Pesanan</h2>
        <div class="space-y-3">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">Order ID:</span>
                <span class="font-semibold">#{{ $list->id }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">Tanggal:</span>
                <span>{{ \Carbon\Carbon::parse($list->placed_on)->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">Status:</span>
                <span class="px-3 py-1 rounded-full text-sm font-semibold
                    {{ $list->payment_status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $list->payment_status == 'pending'   ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $list->payment_status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ ucfirst($list->payment_status) }}
                </span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600 font-medium">Metode Pembayaran:</span>
                <span>{{ $list->method }}</span>
            </div>
            <div class="flex justify-between pt-2">
                <span class="text-gray-600 font-medium text-lg">Total:</span>
                <span class="font-bold text-xl text-blue-600">
                    Rp {{ number_format($list->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

    {{-- ======================== --}}
    {{-- Informasi Pelanggan      --}}
    {{-- ======================== --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Informasi Pelanggan</h2>
        <div class="space-y-3">
            <div>
                <span class="text-gray-600 font-medium">Nama:</span>
                <p class="text-gray-900">{{ $list->name }}</p>
            </div>
            <div>
                <span class="text-gray-600 font-medium">Email:</span>
                <p class="text-gray-900">{{ $list->email }}</p>
            </div>
            <div>
                <span class="text-gray-600 font-medium">Nomor HP:</span>
                <p class="text-gray-900">{{ $list->number }}</p>
            </div>
            <div>
                <span class="text-gray-600 font-medium">Alamat Pengiriman:</span>
                <p class="text-gray-900">{{ $list->address }}</p>
            </div>
        </div>
    </div>

    {{-- ======================== --}}
    {{-- Produk yang Dipesan      --}}
    {{-- ======================== --}}
    <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-5">Produk yang Dipesan</h2>

        @if(!empty($products) && count($products) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
            <div class="flex items-center gap-4 border border-gray-200 rounded-xl p-3 hover:shadow-md transition bg-gray-50">

                {{-- Gambar Produk --}}
                <div class="flex-shrink-0 w-20 h-20">
                    @if($product['image_01'])
                    <img
                        src="{{ asset('storage/products/' . $product['image_01']) }}"
                        alt="{{ $product['name'] }}"
                        class="w-20 h-20 object-cover rounded-lg border border-gray-200"
                        onerror="this.onerror=null; this.src='https://placehold.co/80x80?text=No+Image'">
                    @else
                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex flex-col items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                        <span class="text-xs text-gray-400 mt-1">No Image</span>
                    </div>
                    @endif
                </div>

                {{-- Detail Produk --}}
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800 text-sm leading-tight truncate">
                        {{ $product['name'] }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Jumlah: <span class="font-bold text-gray-700">{{ $product['qty'] }}</span>
                    </p>
                    @if($product['price'])
                    <p class="text-sm text-blue-600 font-semibold mt-1">
                        Rp {{ number_format($product['price'], 0, ',', '.') }}
                    </p>
                    @endif
                    @if(!$product['found'])
                    <span class="inline-block mt-1 text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">
                        Produk tidak ditemukan
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Info string asli --}}
        <p class="text-xs text-gray-400 mt-4 border-t pt-3">
            <span class="font-medium">Raw data:</span> {{ $list->total_products }}
        </p>

        @else
        {{-- Fallback jika gagal parse --}}
        <div class="flex items-center gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-xl"></i>
            <div>
                <p class="text-gray-700 font-medium">{{ $list->total_products }}</p>
                <p class="text-xs text-gray-400 mt-1">Data produk tidak dapat diurai</p>
            </div>
        </div>
        @endif
    </div>

    {{-- ======================== --}}
    {{-- Update Status & Kembali  --}}
    {{-- ======================== --}}
    <div class="md:col-span-2 flex items-stretch space-x-4">
        <form action="{{ route('admin.pesens.updateStatus', $list->id) }}" method="POST" class="flex-1 mb-0">
            @csrf
            @method('PUT')
            <div class="flex items-center space-x-2">
                <select name="payment_status" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="pending" {{ $list->payment_status == 'pending'   ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $list->payment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $list->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 h-10 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </div>
        </form>
        <a href="{{ route('admin.pesens.list') }}"
            class="bg-gray-300 text-gray-800 px-6 h-10 rounded-lg hover:bg-gray-400 transition flex items-center justify-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- ======================== --}}
    {{-- Download PDF             --}}
    {{-- ======================== --}}
    <div class="md:col-span-2">
        <a href="{{ route('admin.pesens.download-pdf', $list->id) }}"
            class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition inline-flex items-center justify-center w-full gap-2">
            <i class="fas fa-file-pdf"></i> Download Nota PDF
        </a>
    </div>

</div>
@endsection