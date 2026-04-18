<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;

class CartWishlistComposer
{
    public function compose(View $view)
    {
        $cartCount = 0;
        $wishlistCount = 0;

        if (Auth::check()) {
            $cartCount = Cart::where('user_id', Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        }

        $view->with('cartCount', $cartCount);
        $view->with('wishlistCount', $wishlistCount);
    }
}