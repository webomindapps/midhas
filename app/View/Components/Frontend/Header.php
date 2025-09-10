<?php

namespace App\View\Components\Frontend;

use Closure;
use App\Facades\Midhas;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product\Product;

class Header extends Component
{
    public Collection $categories;
     public $isnew; 

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Midhas::getCategories('root', false);
         $this->isnew = Product::with('images')
            ->where('is_new', 1)
            ->where('status', 1)
            ->get(); // 👈 Assign to class property
    }
  
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('frontend.layouts.header', [
            'categories' => $this->categories,
            'isnew'=>$this->isnew,
        ]);
    }
}
