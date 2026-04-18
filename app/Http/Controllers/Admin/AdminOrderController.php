<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminOrderController extends Controller
{
    public function list()
    {
        // Using Livewire component for search functionality
        return view('admin.pesens.list');
    }

    public function show($id)
    {
        $list = Order::with('user')->findOrFail($id);

        $products = collect(); // default Collection kosong

        if ($list->total_products) {
            $items = explode(',', $list->total_products);
            $productNames = [];

            foreach ($items as $item) {
                $item = trim($item);
                preg_match('/\((\d+)\)\s*$/', $item, $qtyMatch);
                $qty = isset($qtyMatch[1]) ? (int)$qtyMatch[1] : 1;
                $name = trim(preg_replace('/\s*\(\d+\)\s*$/', '', $item));

                if ($name) {
                    $productNames[] = ['name' => $name, 'qty' => $qty];
                }
            }

            // collect() di sini memastikan hasilnya Laravel Collection
            $products = collect($productNames)->map(function ($item) {
                $product = \App\Models\Product::where('name', 'LIKE', '%' . $item['name'] . '%')->first();
                return [
                    'name'     => $item['name'],
                    'qty'      => $item['qty'],
                    'image_01' => $product?->image_01 ?? null,
                    'image_02' => $product?->image_02 ?? null,
                    'price'    => $product?->price ?? null,
                    'found'    => $product !== null,
                ];
            });
        }

        return view('admin.pesens.show', compact('list', 'products'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan diperbarui');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.pesens.list')
            ->with('success', 'Pesanan berhasil dihapus');
    }

    public function downloadPdf($id)
    {
        $order = Order::findOrFail($id);

        $pdf = Pdf::loadView('orders.invoice-pdf', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Nota Pembayaran-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
}
