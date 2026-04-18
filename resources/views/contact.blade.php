@extends('layouts.app')

@section('title', 'Hubungi Kami - Media-Tech')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white text-center mb-8">Hubungi Kami</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Contact Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Informasi Kontak</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-blue-600 text-xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-semibold">Alamat</h3>
                            <p class="text-gray-600">Jl. Teknologi No. 123, Jakarta, Indonesia</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-phone text-blue-600 text-xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-semibold">Telepon</h3>
                            <p class="text-gray-600">+62 123 4567 890</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-envelope text-blue-600 text-xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-semibold">Email</h3>
                            <p class="text-gray-600">info@mediatech.com</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-clock text-blue-600 text-xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-semibold">Jam Operasional</h3>
                            <p class="text-gray-600">Senin - Jumat: 09:00 - 18:00</p>
                            <p class="text-gray-600">Sabtu: 09:00 - 15:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Kirim Pesan</h2>
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                            <input type="text" name="name" required maxlength="100"
                                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" name="email" required maxlength="100"
                                value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor HP</label>
                            <input type="text" name="number" required maxlength="12"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="08123456789">
                            @error('number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Pesan</label>
                            <textarea name="message" rows="4" required maxlength="500"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Tulis pesan Anda di sini..."></textarea>
                            @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection