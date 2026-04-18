@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin Media-Tech')
@section('page-title', 'Dashboard')

<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p>
                </div>
                <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Pesanan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalOrders }}</p>
                </div>
                <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pendingOrders }}</p>
                </div>
                <div class="bg-yellow-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total User</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                </div>
                <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pesan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalMessages }}</p>
                </div>
                <div class="bg-red-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-2xl text-red-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <a href="{{ route('admin.products.create') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus text-xl text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Tambah Produk Baru</h3>
                    <p class="text-gray-500 text-sm">Tambah produk ke katalog</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.pesens.list') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-xl text-green-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Kelola Pesanan</h3>
                    <p class="text-gray-500 text-sm">Lihat dan kelola pesanan</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.messages.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center space-x-4">
                <div class="bg-red-100 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-comments text-xl text-red-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Lihat Pesan</h3>
                    <p class="text-gray-500 text-sm">Pesan dari pelanggan</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Welcome Message -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-md p-8 text-white">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::guard('admin')->user()->name }}!</h2>
        <p class="text-blue-100">Anda dapat mengelola toko anda dengan mudah melalui panel admin website ini.</p>
    </div>
</div>
@endsection