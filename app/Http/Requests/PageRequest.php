<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        $id = request()->pages;
        $required = $id ? 'nullable' : 'required';
        return [
            'title' => 'required',
            'slug' => 'required|unique:pages,slug,' . $id,
            'position' => 'nullable|numeric',
            'description' => 'required|string',
            'status' => 'nullable',
            
        ];
    }
}
