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
            'title' => 'Orders',
            'icon' => 'fal fa-cart-plus',
            'route' => 'admin.orders.index',
            'isSubMenu' => false,
            'name' => 'orders',
        ],
        [
            'title' => 'Enquiries',
            'icon' => 'fal fa-user-headset',
            'isSubMenu' => true,
            'name' => 'enquiries',
             'subMenus' => [
                [
                    'title' => 'Enquiry',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.enquiries.index',

                ],
                [
                    'title' => 'Ask a Question',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.askquestions.index',
                ],
                 [
                    'title' => 'Tell a Friend',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.tellafriend.index',
                ],
            ],
        ],
        [
            'title' => 'Reviews',
            'icon' => 'fas fa-comments',
            'route' => 'admin.reviews.index',
            'isSubMenu' => false,
            'name' => 'reviews',
        ],
        [
            'title' => 'Offers',
            'icon' => 'fas fa-percent',
            'isSubMenu' => true,
            'name' => 'offers',
            'subMenus' => [
                [
                    'title' => 'Discounts',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.discounts.index',
                ],
            ]
        ],
        [
            'title' => 'Newsletters',
            'icon' => 'fas fa-newspaper',
            'route' => 'admin.newsletters.index',
            'isSubMenu' => false,
            'name' => 'newsletters',
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
                [
                    'title' => 'Delivery City',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.settings.delivery-city.index',
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
                    'title' => 'Blogs',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.cms.blogs.index',
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
