<?php

namespace App\Http\Requests\ProductPackagingDetail;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductPackagingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_code' => 'required',
            'product_variant_code' => 'nullable',
            'micro_unit_code' => 'required',
            // 'unit_code' => 'required_with:micro_unit_code',
            // 'macro_unit_code' => 'required_with:unit_code',
            // 'super_unit_code' => 'required_with:macro_unit_code',
            'micro_to_unit_value' => 'nullable',
            'unit_to_macro_value' => 'nullable',
            'macro_to_super_value' => 'nullable'
        ];
    }
}
