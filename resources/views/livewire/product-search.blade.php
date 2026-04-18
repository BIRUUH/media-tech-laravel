<div class="min-h-screen bg-gradient-to-br from-blue-500 via-white to-blue-100 pb-10">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl text-white font-bold mb-4">Semua Produk</h1>

            <!-- Search Box -->
            <div class="relative">
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Cari produk..." 
                    class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                
                @if($search)
                <button 
                    wire:click="$set('search', '')"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
                @endif
            </div>

            <!-- Debug Info -->
            @if($search)
            <div class="mt-2 p-2 bg-yellow-100 border border-yellow-400 rounded text-sm">
                <strong>Debug:</strong> Searching for: "{{ $search }}" | Found: {{ is_array($products) ? count($products) : $products->total() }} items
            </div>
            @endif
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-[0_10px_25px_-5px_rgba(37,32,255,0.6)] hover:-translate-y-1">
                <div class="relative h-48 bg-white flex items-center justify-center">
                    @if($product->image_01)
                    <img src="{{ asset('/storage/products/' . $product->image_01) }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain mx-auto my-auto">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                    </div>
                    @endif
                    @auth
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        <button type="submit" class="bg-white text-red-500 w-10 h-10 rounded-full hover:bg-red-500 hover:text-white transition border border-red-600 flex items-center justify-center">
                            <i class="fas fa-heart"></i>
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 text-gray-800 truncate">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ Str::limit($product->details, 60) }}</p>
                    <p class="text-blue-600 font-bold text-xl mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex space-x-2">
                        <a href="{{ route('products.show', $product->id) }}" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-center font-medium">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                        @auth
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition font-medium">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-12">
                <i class="fas fa-box-open text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-500">Tidak ada produk ditemukan</p>
                @if($search)
                <button wire:click="$set('search', '')" class="text-blue-600 hover:underline mt-2 inline-block">
                    Lihat semua produk
                </button>
                @endif
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
