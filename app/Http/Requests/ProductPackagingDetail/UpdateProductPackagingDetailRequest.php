<?php

namespace App\Http\Requests\ProductPackagingDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductPackagingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
