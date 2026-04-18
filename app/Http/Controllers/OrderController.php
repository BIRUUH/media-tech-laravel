<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();
        
        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'number' => 'required|max:16',
            'email' => 'required|email|max:50',
            'method' => 'required|max:50',
            'address' => 'required|max:500'
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $totalProducts = $cartItems->map(function($item) {
            return $item->name . ' (' . $item->quantity . ')';
        })->implode(', ');

        $totalPrice = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'method' => $request->input('method'),
            'address' => $request->address,
            'total_products' => $totalProducts,
            'total_price' => $totalPrice,
            'placed_on' => now(),
            'payment_status' => 'pending'
        ]);

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat');
    }

    public function downloadPdf($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();
        
        $pdf = Pdf::loadView('orders.invoice-pdf', compact('order'))
                  ->setPaper('a4', 'portrait');
        
        return $pdf->download('Nota Pembayaran-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
}