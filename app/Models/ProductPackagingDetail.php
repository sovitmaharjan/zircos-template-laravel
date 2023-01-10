<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPackagingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_packaging_detail_code',
        'product_code',
        'product_variant_code',
        'micro_unit_code',
        'unit_code',
        'macro_unit_code',
        'super_unit_code',
        'micro_to_unit_value',
        'unit_to_macro_value',
        'macro_to_super_value',
        'created_by',
        'updated_by'
    ];
}
