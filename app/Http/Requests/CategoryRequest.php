<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = request()->category;
        $required = $id ? 'nullable' : 'required';
        return [
            'parent_id' => 'nullable',
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $id,
            'thumbnail' => 'image',
            'position' => 'nullable|numeric',
            'status' => 'nullable'
        ];
    }
}
