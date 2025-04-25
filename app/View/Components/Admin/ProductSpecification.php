<?php

namespace App\View\Components\Admin;

use App\Models\Specification;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductSpecification extends Component
{
    public $specifications;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->specifications = Specification::where('status', 1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.product-specification');
    }
}
