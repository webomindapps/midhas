<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{


    public function __construct()
    {
        // Load only root categories with children and images
     
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('frontend.layouts.applayout');
    }
}
