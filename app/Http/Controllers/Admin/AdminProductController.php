<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        // Using Livewire component for search functionality
        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'details' => 'required',
            'price' => 'required|numeric|min:0',
            'image_01' => 'nullable|image|max:2048',
            'image_02' => 'nullable|image|max:2048',
            'image_03' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['name', 'details', 'price']);

        foreach (['image_01', 'image_02', 'image_03'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                $filename = $file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');
                $data[$imageField] = $filename;
            }
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'details' => 'required',
            'price' => 'required|numeric|min:0',
            'image_01' => 'nullable|image|max:2048',
            'image_02' => 'nullable|image|max:2048',
            'image_03' => 'nullable|image|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $data = $request->only(['name', 'details', 'price']);

        foreach (['image_01', 'image_02', 'image_03'] as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($product->$imageField) {
                    Storage::disk('public')->delete('products/' . $product->$imageField);
                }
                $file = $request->file($imageField);
                $filename = $file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');
                $data[$imageField] = $filename;
            }
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        foreach (['image_01', 'image_02', 'image_03'] as $imageField) {
            if ($product->$imageField) {
                Storage::disk('public')->delete($product->$imageField);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
