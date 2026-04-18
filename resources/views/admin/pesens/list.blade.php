@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan - Admin Media-Tech')
@section('page-title', 'Kelola Pesanan')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100">
    @section('content')
    @livewire('admin-order-search')
</div>
@endsection