<?php

namespace App\View\Components;

use App\Models\Product\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $products;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->products=Product::with('images','variants')
        ->where('status',1)
        ->get();   
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card', [
            'products' => $this->products
        ]);
    }
}
