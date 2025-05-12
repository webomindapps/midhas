<?php

namespace App\View\Components;

use App\Models\Brand;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Request; // important

class ProductFilter extends Component
{
    public $currentCategory;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $slug = Request::segment(1);

        $this->currentCategory = Category::where('slug', $slug)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-filter', [
            'currentCategory' => $this->currentCategory
        ]);
    }
}
