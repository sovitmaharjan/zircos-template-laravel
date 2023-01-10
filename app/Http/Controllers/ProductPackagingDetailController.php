<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPackagingDetail\CreateProductPackagingDetailRequest;
use App\Models\PackageType;
use App\Models\ProductPackagingDetail;
use Exception;

class ProductPackagingDetailController extends Controller
{
    public function index()
    {
        $data['product_packaging_detail'] = ProductPackagingDetail::orderBy('updated_at', 'desc')->get();
        return view('product-packaging-detail.index', $data);
    }

    public function create()
    {
        $data['product'] = ProductPackagingDetail::distinct()->get(['product_code']);
        $data['package_type'] = PackageType::orderBy('package_name', 'asc')->get();
        return view('product-packaging-detail.create', $data);
    }

    public function store(CreateProductPackagingDetailRequest $request)
    {
        try {
            $product_packaging_detail = ProductPackagingDetail::where([
                'product_code' => $request->product_code,
                'product_variant_code' => $request->product_variant_code
            ])->first();
            if ($product_packaging_detail) {
                $product_packaging_detail->update([
                    'micro_unit_code' => $request->micro_unit_code,
                    'unit_code' => $request->unit_code,
                    'macro_unit_code' => $request->macro_unit_code,
                    'super_unit_code' => $request->super_unit_code,
                    'micro_to_unit_value' => $request->micro_to_unit_value,
                    'unit_to_macro_value' => $request->unit_to_macro_value,
                    'macro_to_super_value' => $request->macro_to_super_value,
                ]);
                return redirect()->route('product-packaging-detail.index')->with('success', 'Product packaging detail has been updated');
            } else {
                $package_code = 'PPD' . (substr(ProductPackagingDetail::latest()->first()->product_packaging_detail_code, 3) + 1);
                ProductPackagingDetail::create([
                    'product_packaging_detail_code' => $package_code,
                    'product_code' => $request->product_code,
                    'product_variant_code' => $request->product_variant_code,
                    'micro_unit_code' => $request->micro_unit_code,
                    'unit_code' => $request->unit_code,
                    'macro_unit_code' => $request->macro_unit_code,
                    'super_unit_code' => $request->super_unit_code,
                    'micro_to_unit_value' => $request->micro_to_unit_value,
                    'unit_to_macro_value' => $request->unit_to_macro_value,
                    'macro_to_super_value' => $request->macro_to_super_value,
                    'created_by' => 1, // authentication not implemented for now 
                    'updated_by' => 1, // authentication not implemented for now
                ]);
                return back()->with('success', 'Product packaging detail has been created');
            }
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(ProductPackagingDetail $product_packaging_detail)
    {
        $data['product'] = ProductPackagingDetail::distinct()->get(['product_code']);
        $data['package_type'] = PackageType::orderBy('package_name', 'asc')->get();
        $data['product_packaging_detail'] = $product_packaging_detail;
        return view('product-packaging-detail.edit', $data);
    }

    public function destroy(ProductPackagingDetail $product_packaging_detail)
    {
        try {
            $product_packaging_detail->delete();
            return back()->with('success', 'Product packaging detail has been deleted');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
