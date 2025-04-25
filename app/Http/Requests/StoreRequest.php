<?php

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $requiredType = request()->store ? 'nullable' : 'required';
        $store = Store::find(request()->store);

        return [
            'name' => 'required',
            'email' => 'required|unique:admins,email,' . $store?->admin?->id,
            'phone' => 'required',
            'password' => $requiredType . '|confirmed',
            'manager_name' => 'required',
            'location' => 'required',
            'address' => 'required',
            'map_link' => 'required',
            'working_hours' => 'nullable',
            'video' => 'nullable',
            'video_link' => 'nullable',
            'store_image' => 'nullable|image',
            'store_image_link' => 'nullable',
            'customer_care' => 'nullable',
            'delivery_enquiries' => 'nullable',
            'sales_info' => 'nullable'
        ];
    }
}
