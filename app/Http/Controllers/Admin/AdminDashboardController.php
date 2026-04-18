<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Message;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalMessages = Message::count();
        $pendingOrders = Order::where('payment_status', 'pending')->count();
        
        return view('admin.dashboard', compact(
            'totalProducts', 'totalOrders', 'totalUsers', 
            'totalMessages', 'pendingOrders'
        ));
    }
}