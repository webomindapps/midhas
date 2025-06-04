<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = request()->discount;
        return [
            'code' => 'required|unique:discounts,code,' . $id,
            'type' => 'required',
            'value' => 'required',
            'coupon_type' => 'required',
            'limit' => 'nullable|integer',
            'expiry_date' => 'nullable|date',
            'applicable_for' => 'required',
            'sku' => 'nullable'
        ];
    }
}
