<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $id = request()->sliders;
        $required = $id ? 'nullable' : 'required';
        return [
            'category_id' => 'required',
            'position' => 'nullable|numeric',
            'status' => 'nullable',
            'url' => 'nullable|string',
            'slider_image' => 'image',

        ];
    }
}
