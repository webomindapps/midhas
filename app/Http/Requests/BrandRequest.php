<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $id = request()->brand;
        $required = $id ? 'nullable' : 'required';
        return [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $id,
            'thumbnail' => 'image',
            'position' => 'nullable|numeric',
            'status' => 'nullable'
        ];
    }
}
