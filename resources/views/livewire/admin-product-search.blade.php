<div>
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Produk Baru
        </a>
        
        <!-- Search Box -->
        <div class="relative w-96">
            <input 
                type="text" 
                wire:model.live="search"
                placeholder="Cari produk..." 
                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            
            @if($search)
            <button 
                wire:click="$set('search', '')"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
            @endif
        </div>
    </div>

    <!-- Debug Info -->
    @if($search)
    <div class="mb-4 p-2 bg-yellow-100 border border-yellow-400 rounded text-sm">
        <strong>Debug:</strong> Searching for: "{{ $search }}" | Found: {{ is_object($products) ? $products->total() : count($products) }} items
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ is_object($product) ? $product->id : $product['id'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->image_01)
                        <img src="{{ asset('storage/products/' . $product->image_01) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                        @else
                        <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($product->details, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        @if($search)
                            Tidak ada produk ditemukan. <button wire:click="$set('search', '')" class="text-blue-600 hover:underline">Lihat semua produk</button>
                        @else
                            Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-blue-600 hover:underline">Tambah produk pertama</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        @if(is_object($products))
            {{ $products->links() }}
        @endif
    </div>
</div>
