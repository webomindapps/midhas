<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Category;

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
}
