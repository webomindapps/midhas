<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{

    public $categories;

    public function __construct()
    {
        // Load only root categories with children and images
        $this->categories = Category::with('children.children', 'image')
            ->where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('position', 'asc')
            ->get();
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('frontend.layouts.applayout', [
            'categories' => $this->categories
        ]);
    }
}
