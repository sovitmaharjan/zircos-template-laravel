<?php

namespace App\Http\Controllers;

use App\Models\ProductPackagingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPriceConversionController extends Controller
{
    public function index()
    {
        $data['product'] = ProductPackagingDetail::distinct()->get(['product_code']); // product_code as product name, no product table created for now
        return view('product-price-conversion.index', $data);
    }

    public function getProductData(Request $request)
    {
        $product['product_packaging_detail'] = DB::table('product_packaging_details as ppd')->where([
            'product_code' => $request->product_code,
            'product_variant_code' => $request->product_variant_code
        ])->select(
            'ppd.*',
            DB::raw('(select package_name from package_types where package_code = ppd.micro_unit_code) micro_unit_name'),
            DB::raw('(select package_name from package_types where package_code = ppd.unit_code) unit_name'),
            DB::raw('(select package_name from package_types where package_code = ppd.macro_unit_code) macro_unit_name'),
            DB::raw('(select package_name from package_types where package_code = ppd.super_unit_code) super_unit_name'),
        )->first();
        $product['variants'] = ProductPackagingDetail::where('product_code', $request->product_code)->whereNotNull('product_variant_code')->distinct(['product_variant_code'])->get(['product_variant_code']);
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
