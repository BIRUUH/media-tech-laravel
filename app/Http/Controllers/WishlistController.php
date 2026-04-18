<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function add($productId)
    {
        $product = Product::findOrFail($productId);
        
        $exists = Wishlist::where('user_id', Auth::id())
                         ->where('pid', $productId)
                         ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'pid' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image_01
            ]);
            
            return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist');
        }

        return redirect()->back()->with('info', 'Produk sudah ada di wishlist');
    }

    public function remove($id)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())->findOrFail($id);
        $wishlistItem->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari wishlist');
    }
}