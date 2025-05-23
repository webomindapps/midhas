<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $menus = [
        [
            'title' => 'Dashboard',
            'icon' => 'bx bx-grid-alt',
            'route' => 'admin.dashboard',
            'isSubMenu' => false,
            'name' => 'dashboard',
        ],
        [
            'title' => 'Category',
            'icon' => 'fal fa-clipboard-list',
            'route' => 'admin.categories.index',
            'isSubMenu' => false,
            'name' => 'category',
        ],
        [
            'title' => 'Products',
            'icon' => 'fal fa-box-full',
            'route' => 'admin.products.index',
            'isSubMenu' => false,
            'name' => 'products',
        ],
        [
            'title' => 'Customer Master',
            'icon' => 'fal fa-clipboard-list',
            'route' => 'admin.customers.index',
            'isSubMenu' => false,
            'name' => 'customers',
        ],
        [
            'title' => 'Stores',
            'icon' => 'fal fa-store',
            'route' => 'admin.stores.index',
            'isSubMenu' => false,
            'name' => 'stores',
        ],
        [
            'title' => 'Masters',
            'icon' => 'fal fa-sitemap',
            'isSubMenu' => true,
            'name' => 'masters',
            'subMenus' => [
                [
                    'title' => 'Brands',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.masters.brands.index',
                ],
                [
                    'title' => 'Specification',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.masters.specifications.index',
                ],
            ],
        ],
        [
            'title' => 'Settings',
            'icon' => 'fal fa-cogs',
            'isSubMenu' => true,
            'name' => 'settings',
            'subMenus' => [
                [
                    'title' => 'Filters',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.settings.filters.index',
                ],
            ]
        ],
        [
            'title' => 'CMS',
            'icon' => 'fal fa-sitemap',
            'isSubMenu' => true,
            'name' => 'cms',
            'subMenus' => [
                [
                    'title' => 'Banners',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.cms.banners.index',
                ],
                [
                    'title' => 'Pages',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.cms.pages.index',
                ],
                [
                    'title' => 'Sliders',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.cms.sliders.index',
                ],
            ],
        ],
    ];

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar');
    }
}
