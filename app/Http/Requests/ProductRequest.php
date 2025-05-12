<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = request()->product;
        $required = $id ? 'nullable' : 'required';

        return [
            'product_type_id' => 'nullable',
            'title' => 'required',
            'sku' => 'required|unique:products,sku,' . $id,
            'slug' => 'required|unique:products,slug,' . $id,
            'upc_code' => 'nullable',
            'brand_id' => 'nullable',
            'ehf_category' => 'nullable',
            'order_type' => 'nullable',
            'tax_id' => 'nullable',
            'selling_price' => 'required',
            'msrp' => 'required',
            'instore_price' => 'nullable',
            'rebate' => 'nullable',
            'thumbnail' => $required . '|image',
            'e_manual' => 'nullable',
            'total_stock' => 'nullable',
            'product_details' => 'nullable',
            'product_description' => 'nullable',
            'payment_security' => 'nullable',
            'categories'  => 'nullable|array',
            'amount'  => 'nullable|array',
            'start_date' => 'nullable|array',
            'end_date' => 'nullable|array',
            'product_images' => 'nullable|array',
            'stores' => 'nullable|array',
            'stock'  => 'nullable|array',
            'specification_value' => 'nullable|array',
            'manual_name' => 'nullable|array',
            'manual_file_name' => 'nullable|array',
            'manual_file_link' => 'nullable|array',


            'product_category_id' => 'nullable|array',
            'product_package_ids' => 'nullable|array',
            'product_sku' => 'nullable|array',
            'product_msrp' => 'nullable|array',
            'product_id' => 'nullable|array',
            'product_selling_price' => 'nullable|array',
            'is_taxable' => 'nullable|boolean',

            // product filters
            'color' => 'nullable',
            'size' => 'nullable',
            'material' => 'nullable',
            'style' => 'nullable',
            'no_of_drawers' => 'nullable',
            'no_of_doors' => 'nullable',
            'no_of_hooks' => 'nullable',
            'no_of_shelves' => 'nullable',
            'assembly' => 'nullable',
            'upholstery_material' => 'nullable',
        ];
    }
}
