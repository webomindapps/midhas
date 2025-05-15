<?php

namespace App\View\Components\Frontend;

use Closure;
use App\Facades\Midhas;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class Header extends Component
{
    public Collection $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Midhas::getCategories('root', false);
    }
    protected function getCart()
    {
        $user = Auth::user();
        if ($user) {
            return Cart::with('items')->where('customer_id', $user->id)->latest()->first();
        }

        $cartId = session('cart_id');
        return Cart::with('items')->find($cartId);
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('frontend.layouts.header', [
            'categories' => $this->categories,
            'cart' => $this->getCart(),
        ]);
    }
}
