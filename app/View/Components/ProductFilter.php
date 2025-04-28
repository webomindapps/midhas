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
    public $brands;
    public $categories;
    public $subcategories;
    public $currentCategory;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->brands = Brand::where('status', 1)->get();

        $this->categories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('name', 'asc')
            ->get();

        $slug = Request::segment(1);

        $this->currentCategory = Category::where('slug', $slug)->first();

        if ($this->currentCategory) {
            if ($this->currentCategory->parent_id == null) {
                $this->subcategories = $this->currentCategory->children()->where('status', 1)->orderBy('name')->get();
            } else {

                $this->subcategories = Category::where('parent_id', $this->currentCategory->parent_id)
                    ->where('status', 1)
                    ->orderBy('name')
                    ->get();
            }
        } else {

            $this->subcategories = Category::where('status', 1)
                ->whereNotNull('parent_id')
                ->orderBy('name', 'asc')
                ->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-filter', [
            'brands' => $this->brands,
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'currentCategory' => $this->currentCategory
        ]);
    }
}
