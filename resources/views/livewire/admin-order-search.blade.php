<div>
    <!-- Search Box -->
    <div class="mb-6">
        <div class="relative">
            <input 
                type="text" 
                wire:model.live="search"
                placeholder="Cari pesanan (ID, nama, email, status)..." 
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
            <strong>Debug:</strong> Searching for: "{{ $search }}" | Found: {{ $lists->total() }} items
        </div>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($lists as $list)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $list->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $list->name }}</div>
                        <div class="text-sm text-gray-500">{{ $list->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        Rp {{ number_format($list->total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.pesens.updateStatus', $list->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="payment_status" onchange="this.form.submit()"
                                    class="text-sm rounded-full px-3 py-1 font-semibold border-0
                                    {{ $list->payment_status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $list->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $list->payment_status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                <option value="pending" {{ $list->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $list->payment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $list->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $list->placed_on->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.pesens.show', $list->id) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                        <a href="{{ route('admin.pesens.download-pdf', $list->id) }}" class="text-green-600 hover:text-green-900">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                        <form action="{{ route('admin.pesens.destroy', $list->id) }}" method="POST" class="inline" 
                              onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
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
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        @if($search)
                            Tidak ada pesanan ditemukan. <button wire:click="$set('search', '')" class="text-blue-600 hover:underline">Lihat semua pesanan</button>
                        @else
                            Belum ada pesanan
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $lists->links() }}
    </div>
</div>
