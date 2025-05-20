<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Pages;
use App\Models\Category;
use App\Models\Store;
use App\Models\Variant;

class Midhas extends Controller
{
    public function getStatus()
    {
        return [
            ['label' => 'Active', 'value' => 1],
            ['label' => 'In-Active', 'value' => 0],
        ];
    }

    public function upload($file, $folder): string
    {
        return $file->store($folder, 'public');
    }

    public function addSeo($model, $data, $id = null)
    {
        if ($id) {
            return $model->seo ? $model->seo()->update($data) : $model->seo()->create($data);
        }
        return $model->seo()->create($data);
    }

    public function getCategories($type = null, $dropdown = true, $id = null)
    {
        $query = Category::where('status', true);

        if ($id) {
            $query->where('id', '!=', $id);
        }

        switch ($type) {
            case "root":
                $query->whereNull('parent_id')->orderBy('position', 'asc')->get();
                break;
            default:
                $query->orderBy('position', 'asc')->get();
        }

        if ($dropdown) {
            return $query->orderBy('position', 'asc')->get()->map(function ($query) {
                return [
                    'label' => $query->name,
                    'value' => $query->id,
                    'children' => $query->children
                ];
            });
        }

        return $query->orderBy('position', 'asc')->get();
    }
    public function getAction($code, $route, $item, $additional = [])
    {
        switch ($code) {

            case "simple":
                $view = '<li><a href="' . $route . '" class="dropdown-item">
                            <i class="' . $additional['icon'] . '"></i>
                            ' . $additional['label'] . '
                        </a></li>';
                break;

            case "active":
                $view = '<li><a class="dropdown-item singleItem" data-type="2" data-id="' . $item->id . '" data-value="1">
                            <i class="fas fa-check-circle"></i>
                            Active
                        </a></li>';
                break;
            case "inactive":
                $view = '<li><a class="dropdown-item singleItem" data-type="2" data-id="' . $item->id . '" data-value="0">
                            <i class="fas fa-file-exclamation"></i>
                            InActive
                        </a></li>';
                break;
            case "delete":
                $view = '<li><a class="dropdown-item singleItem" data-type="1" data-id="' . $item->id . '">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a></li>';
                break;

            case "edit":
                $view = '<li><a class="dropdown-item" href="' . $route . '">
                            <i class="fas fa-pencil"></i>
                            Edit
                        </a></li>';
                break;
            case "view":
                $view = '<li><a class="dropdown-item" href="' . $route . '">
                            <i class="far fa-eye"></i>
                            View
                        </a></li>';
                break;
            case "inventory":
                $view = '<li><a class="dropdown-item" href="' . $route . '">
                            <i class="fas fa-inventory"></i>
                            Inventory
                        </a></li>';
                break;

            case "more_info":
                $view = '<li><a class="dropdown-item" href="' . $route . '">
                                <i class="fa fa-info-circle"></i>
                                More Info
                            </a></li>';
                break;

            default:
                $view = '<li><a class="dropdown-item ' . $code . '" data-item="' . $item . '" data-type="info" data-id="' . $item->id . '">
                            <i class="fa fa-info-circle"></i>
                            More Info
                        </a></li>';
        }

        return $view;
    }
    public function getBrands($dropdown = true)
    {
        $query = Brand::where('status', true);

        if ($dropdown) {
            return $query->get()->map(function ($query) {
                return [
                    'label' => $query->name,
                    'value' => $query->id
                ];
            });
        }

        return $query->orderBy('position', 'asc')->get();
    }
    public function getOrderType()
    {
        return [
            ['label' => 'Enquiry', 'value' => 1],
            ['label' => 'Add To Cart', 'value' => 2],
        ];
    }
    public function getVariants($dropdown = true)
    {
        $query = Variant::query();
        if ($dropdown) {
            return $query->get()->map(function ($query) {
                return [
                    'label' => $query->name,
                    'value' => $query->id
                ];
            });
        }
        return $query->get();
    }
    public function getStore($dropdown = true)
    {
        $query = Store::where('status', true);

        $query->orderBy('name', 'asc');
        if ($dropdown) {
            return $query->get()->map(function ($query) {
                return [
                    'label' => $query->name,
                    'value' => $query->id
                ];
            });
        }

        return $query->get();
    }
    public function getCategoriesBasedOnProduct($product)
    {
        return $product
            ->categories()
            ->get()
            ->pluck('id')
            ->toArray();
    }
    public function getAllCategories()
    {
        $categories = Category::where('status', true)
            ->whereNull('parent_id')
            ->get(['id', 'name']);

        return $categories->map(function ($category) {
            return [
                'label' => $category->name,
                'value' => $category->id,
            ];
        })->toArray();
    }
    public function getType()
    {
        return [
            ['label' => 'One', 'value' => 1],
            ['label' => 'Two', 'value' => 2],
            ['label' => 'Three', 'value' => 3],

        ];
    }
    public function pages()
    {
        return Pages::orderBy('position', 'asc')->get();
    }
    public function formatPrice($value)
    {
        return number_format((float)$value, 2);
    }
}
