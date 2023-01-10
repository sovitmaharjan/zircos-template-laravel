@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Product Packaging Detail </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Zircos</a>
                            </li>
                            <li class="active">
                                Product Packaging Detail
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-color panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Fields with * are mendatory</h3>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    {{-- @php
                                    dd($errors)
                                @endphp --}}
                                    <form class="form-horizontal" method="post"
                                        action="{{ route('product-packaging-detail.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Product *</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="product_code"
                                                    value="{{ old('product_code') ?? $product_packaging_detail->product_code }}"
                                                    required="required" readonly="readonly">
                                            </div>
                                            <label class="col-md-1 control-label">Variant</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="product_variant_code"
                                                    value="{{ old('product_variant_code') ?? $product_packaging_detail->product_variant_code }}"
                                                    readonly="readonly">
                                            </div>
                                        </div>
                                        <label class="col-md-7 control-label">Conversion Unit (Select atleast 2 out of
                                            4)</label>
                                        <label class="col-md-12"></label>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Micro</label>
                                            <div class="col-md-2">
                                                <select class="form-control" name="micro_unit_code" id="micro" required="required">
                                                    <option value="">Select</option>
                                                    @foreach ($package_type as $item)
                                                        <option value="{{ $item->package_code }}"
                                                            @if (old('micro_unit_code')) @if (old('micro_unit_code') == $item->package_code)
                                                                selected="selected" @endif
                                                            @else
                                                                @if ($product_packaging_detail->micro_unit_code == $item->package_code) selected="selected" @endif
                                                            @endif
                                                        >{{ $item->package_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="col-md-1 control-label">Unit</label>
                                            <div class="col-md-2">
                                                <select class="form-control" name="unit_code" id="unit">
                                                    <option value="">Select</option>
                                                    @foreach ($package_type as $item)
                                                    <option value="{{ $item->package_code }}"
                                                        @if (old('unit_code')) @if (old('unit_code') == $item->package_code)
                                                            selected="selected" @endif
                                                        @else
                                                            @if ($product_packaging_detail->unit_code == $item->package_code) selected="selected" @endif
                                                        @endif
                                                    >{{ $item->package_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="col-md-1 control-label">Macro</label>
                                            <div class="col-md-2">
                                                <select class="form-control" name="macro_unit_code" id="macro">
                                                    <option value="">Select</option>
                                                    @foreach ($package_type as $item)
                                                    <option value="{{ $item->package_code }}"
                                                        @if (old('macro_unit_code')) @if (old('macro_unit_code') == $item->package_code)
                                                            selected="selected" @endif
                                                        @else
                                                            @if ($product_packaging_detail->macro_unit_code == $item->package_code) selected="selected" @endif
                                                        @endif
                                                    >{{ $item->package_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="col-md-1 control-label">Super</label>
                                            <div class="col-md-2">
                                                <select class="form-control" name="super_unit_code" id="super">
                                                    <option value="">Select</option>
                                                    @foreach ($package_type as $item)
                                                    <option value="{{ $item->package_code }}"
                                                        @if (old('super_unit_code')) @if (old('super_unit_code') == $item->package_code)
                                                            selected="selected" @endif
                                                        @else
                                                            @if ($product_packaging_detail->super_unit_code == $item->package_code) selected="selected" @endif
                                                        @endif
                                                    >{{ $item->package_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Unit Values</label>
                                            <div class="col-md-5">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="table-bordered">
                                                            <th width="75%">Conversion</th>
                                                            <th width="25%">Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @if ($product_packaging_detail->micro_to_unit_value)
                                                            <tr class=" table-bordered"><td>Micro to unit value</td><td> <input type="number" class="form-control" name="micro_to_unit_value" value="{{ $product_packaging_detail->micro_to_unit_value }}" required="required"></td></tr>
                                                        @endif
                                                        @if ($product_packaging_detail->unit_to_macro_value)
                                                            <tr class=" table-bordered"><td>Micro to unit value</td><td> <input type="number" class="form-control" name="unit_to_macro_value" value="{{ $product_packaging_detail->unit_to_macro_value }}" required="required"></td></tr>
                                                        @endif
                                                        @if ($product_packaging_detail->macro_to_super_value)
                                                            <tr class=" table-bordered"><td>Micro to unit value</td><td> <input type="number" class="form-control" name="macro_to_super_value" value="{{ $product_packaging_detail->macro_to_super_value }}" required="required"></td></tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-11 col-sm-offset-1">
                                                <button type="submit"
                                                    class="btn btn-success w-md waves-effect waves-light">
                                                    Save
                                                </button>
                                                <a href="{{ route('product-packaging-detail.create') }}">
                                                    <button type="button" class="btn btn-default w-md waves-effect m-l-5">
                                                        Cancel
                                                    </button>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('change', '#micro, #unit, #macro, #super', function() {
            count = 0;
            if ($('#micro').val() != "") {
                count = count + 1;
            }
            if ($('#unit').val() != "") {
                count = count + 1;
            }
            if ($('#macro').val() != "") {
                count = count + 1;
            }
            if ($('#super').val() != "") {
                count = count + 1;
            }
            console.log(count);
            if (count > 1) {
                $('#tbody').html('');
                if ($('#micro').val() && $('#unit').val()) {
                    $('#tbody').append(
                        '<tr class=" table-bordered"><td>Micro to unit value</td><td> <input type="number" class="form-control" name="micro_to_unit_value" required="required"></td></tr>'
                        )
                }
                if ($('#unit').val() && $('#macro').val()) {
                    $('#tbody').append(
                        '<tr class=" table-bordered"><td>Unit to macro value</td><td> <input type="number" class="form-control" name="unit_to_macro_value" required="required"></td></tr>'
                        )
                }
                if ($('#macro').val() && $('#super').val()) {
                    $('#tbody').append(
                        '<tr class=" table-bordered"><td>Macro to super value</td><td> <input type="number" class="form-control" name="macro_to_super_value" required="required"></td></tr>'
                        )
                }
                $('#hidden').removeAttr('hidden');
            }
        });
    </script>
@endsection
