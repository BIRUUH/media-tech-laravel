@extends('admin.layouts.app')

@section('title', 'Kelola Produk - Admin Media-Tech')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white/10 to-blue-100">
    @section('page-title', 'Kelola Produk')
    
    @section('content')
    @livewire('admin-product-search')
</div>
@endsection