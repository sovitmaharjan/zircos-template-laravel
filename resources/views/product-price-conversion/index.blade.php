@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Product Price Conversion </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Zircos</a>
                            </li>
                            <li class="active">
                                Product Price Conversion
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
                                            <div class="col-md-2">
                                                <select class="form-control" name="product_code"
                                                    value="{{ old('product_code') }}" id="product_code" required="required">
                                                    <option value="">Select</option>
                                                    @foreach ($product as $item)
                                                        <option value="{{ $item->product_code }}">{{ $item->product_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="col-md-1 control-label">Variant</label>
                                            <div class="col-md-2">
                                                <select class="form-control" name="product_variant_code"
                                                    value="{{ old('product_variant_code') }}" id="product_variant_code">
                                                    <option value="">Select a product</option>
                                                </select>
                                            </div>
                                            <label class="col-md-1 control-label">Type</label>
                                            <div class="col-md-2">
                                                <select class="form-control" name="product_type" value="{{ old('product_type') }}" id="product_type" required="required">
                                                    <option value="">Select a product</option>
                                                </select>
                                            </div>
                                            <label class="col-md-1 control-label">Price</label>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" name="price" id="price"
                                                    value="{{ old('price') }}">
                                            </div>
                                        </div>
                                        <label class="col-md-7 control-label">Select a product to get it's available
                                            units</label>
                                        <label class="col-md-12 control-label"></label>
                                        <div class="form-group" id="hidden">
                                            <label class="col-md-1 control-label">Unit Prices</label>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="table-bordered">
                                                            <th width="75%">Unit</th>
                                                            <th width="25%">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
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
                                        </div> --}}

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
        $(document).on('change', '#product_code', function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('get-product-data') }}',
                data: {
                    'product_code': $(this).val()
                },
                success: function(data) {
                    if (data.data.variants.length > 0) {
                        var option = '<option value="">Select</option>';
                        $.each(data.data.variants, function(i, e) {
                            option += '<option value="' + e.product_variant_code + '">' + e
                                .product_variant_code + '</option>';
                        });
                        $('#product_variant_code').html(option);
                    } else {
                        var option = '<option value="">n/a</option>';
                        $('#product_variant_code').html(option);
                    }
                    var ppd = data.data.product_packaging_detail;
                    if (ppd) {
                        $('#tbody').html('');
                        var option = '<option value="">Select</option>';
                        if(ppd.micro_unit_code) {
                            option += '<option value="' + ppd.micro_unit_code + '">' + ppd.micro_unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.micro_unit_name + '</td><td id="micro_unit_td"></td></tr>');
                        };
                        if(ppd.unit_code) {
                            option += '<option value="' + ppd.unit_code + '">' + ppd.unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.unit_name + '</td><td id="unit_td"></td></tr>');
                        };
                        if(ppd.macro_unit_code) {
                            option += '<option value="' + ppd.macro_unit_code + '">' + ppd.macro_unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.macro_unit_name + '</td><td id="macro_unit_td"></td></tr>');
                        };
                        if(ppd.super_unit_code) {
                            option += '<option value="' + ppd.super_unit_code + '">' + ppd.super_unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.super_unit_name + '</td><td id="super_unit_td"></td></tr>');
                        };
                        if(!ppd.micro_unit_code && !ppd.unit_code && !ppd.macro_unit_code && !ppd.super_unit_code) {
                            $('#tbody').html('');
                            var option = '<option value="">n/a</option>';
                        }
                        $('#product_type').html(option);
                    } else {
                        $('#tbody').html('');
                        var option = '<option value="">n/a</option>';
                        $('#product_type').html(option);
                    }
                }
            })
        });

        $(document).on('change', '#product_variant_code', function() {
            $('#product_code').val() == '' ? toastr.error('Select a product first') : '';
            $.ajax({
                type: 'GET',
                url: '{{ route('get-product-data') }}',
                data: {
                    'product_code': $('#product_code').val(),
                    'product_variant_code': $(this).val()
                },
                success: function(data) {
                    var ppd = data.data.product_packaging_detail;
                    if (ppd) {
                        $('#tbody').html('');
                        var option = '<option value="">Select</option>';
                        if(ppd.micro_unit_code) {
                            option += '<option value="' + ppd.micro_unit_code + '">' + ppd.micro_unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.micro_unit_name + '</td><td id="micro_unit_td"></td></tr>');
                        };
                        if(ppd.unit_code) {
                            option += '<option value="' + ppd.unit_code + '">' + ppd.unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.unit_name + '</td><td id="unit_td"></td></tr>');
                        };
                        if(ppd.macro_unit_code) {
                            option += '<option value="' + ppd.macro_unit_code + '">' + ppd.macro_unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.macro_unit_name + '</td><td id="macro_unit_td"></td></tr>');
                        };
                        if(ppd.super_unit_code) {
                            option += '<option value="' + ppd.super_unit_code + '">' + ppd.super_unit_name + '</option>';
                            $('#tbody').append('<tr class="table-bordered"><td>' + ppd.super_unit_name + '</td><td id="super_unit_td"></td></tr>');
                        };
                        if(!ppd.micro_unit_code && !ppd.unit_code && !ppd.macro_unit_code && !ppd.super_unit_code) {
                            $('#tbody').html('');
                            var option = '<option value="">n/a</option>';
                        }
                    } else {
                        $('#tbody').html('');
                        var option = '<option value="">n/a</option>';
                    }
                    $('#product_type').html(option);
                }
            })
        });

        $(document).on('keyup', '#price', function() {
            var packageTypeValue = $('#product_type').val();
            packageTypeValue == '' ? toastr.error('Select a type first') : '';
            var price = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route('get-product-data') }}',
                data: {
                    'product_code': $('#product_code').val(),
                    'product_variant_code': $('#product_variant_code').val()
                },
                success: function(data) {
                    var ppd = data.data.product_packaging_detail;
                    if (ppd) {
                        var productType = '';
                        $.each(ppd, function(i, e) {
                            if(e == packageTypeValue){
                                productType = i;
                            }
                        });
                        if(productType == 'micro_unit_code') {
                            $('#micro_unit_td').html(parseInt(price).toFixed(2));
                            conversion = ppd.micro_to_unit_value ? price * ppd.micro_to_unit_value : 'n/a';
                            $('#unit_td').html(conversion.toFixed(2));
                            conversion = ppd.unit_to_macro_value ? price * ppd.micro_to_unit_value * ppd.unit_to_macro_value : 'n/a';
                            $('#macro_unit_td').html(conversion.toFixed(2));
                            conversion = ppd.macro_to_super_value ? price * ppd.micro_to_unit_value * ppd.unit_to_macro_value * ppd.macro_to_super_value : 'n/a';
                            $('#super_unit_td').html(conversion.toFixed(2));
                        }
                        if(productType == 'unit_code') {
                            conversion = ppd.micro_to_unit_value ? price / ppd.micro_to_unit_value : 'n/a';
                            $('#micro_unit_td').html(conversion.toFixed(2));
                            $('#unit_td').html(parseInt(price).toFixed(2));
                            conversion = ppd.unit_to_macro_value ? price * ppd.unit_to_macro_value : 'n/a';
                            $('#macro_unit_td').html(conversion.toFixed(2));
                            conversion = ppd.macro_to_super_value ? price * ppd.unit_to_macro_value * ppd.macro_to_super_value : 'n/a';
                            $('#super_unit_td').html(conversion.toFixed(2));
                        }
                        if(productType == 'macro_unit_code') {
                            conversion = ppd.micro_to_unit_value ? price / ppd.micro_to_unit_value / ppd.unit_to_macro_value : 'n/a';
                            $('#micro_unit_td').html(conversion.toFixed(2));
                            conversion = ppd.unit_to_macro_value ? price / ppd.unit_to_macro_value : 'n/a';
                            $('#unit_td').html(conversion.toFixed(2));
                            $('#macro_unit_td').html(parseInt(price).toFixed(2));
                            conversion = ppd.macro_to_super_value ? price * ppd.macro_to_super_value : 'n/a';
                            $('#super_unit_td').html(conversion.toFixed(2));
                        }
                        if(productType == 'super_unit_code') {
                            conversion = ppd.micro_to_unit_value ? price / ppd.micro_to_unit_value / ppd.unit_to_macro_value /ppd.macro_to_super_value : 'n/a';
                            $('#micro_unit_td').html(conversion.toFixed(2));
                            conversion = ppd.unit_to_macro_value ? price / ppd.unit_to_macro_value / ppd.macro_to_super_value : 'n/a';
                            $('#unit_td').html(conversion.toFixed(2));
                            conversion = ppd.macro_to_super_value ? price / ppd.macro_to_super_value : 'n/a';
                            $('#macro_unit_td').html(conversion.toFixed(2));
                            $('#super_unit_td').html(parseInt(price).toFixed(2));
                        }
                    } else {
                    }
                }
            })
        })

        $(document).on('change', '#product_type', function() {
            var packageTypeValue = $(this).val();
            var price = $('#price').val();
            $.ajax({
                type: 'GET',
                url: '{{ route('get-product-data') }}',
                data: {
                    'product_code': $('#product_code').val(),
                    'product_variant_code': $('#product_variant_code').val()
                },
                success: function(data) {
                    var ppd = data.data.product_packaging_detail;
                    if (ppd) {
                        var productType = '';
                        $.each(ppd, function(i, e) {
                            if(e == packageTypeValue){
                                productType = i;
                            }
                        });
                        if(price) {
                            if(productType == 'micro_unit_code') {
                                $('#micro_unit_td').html(parseInt(price).toFixed(2));
                                conversion = ppd.micro_to_unit_value ? price * ppd.micro_to_unit_value : 'n/a';
                                $('#unit_td').html(conversion.toFixed(2));
                                conversion = ppd.unit_to_macro_value ? price * ppd.micro_to_unit_value * ppd.unit_to_macro_value : 'n/a';
                                $('#macro_unit_td').html(conversion.toFixed(2));
                                conversion = ppd.macro_to_super_value ? price * ppd.micro_to_unit_value * ppd.unit_to_macro_value * ppd.macro_to_super_value : 'n/a';
                                $('#super_unit_td').html(conversion.toFixed(2));
                            }
                            if(productType == 'unit_code') {
                                conversion = ppd.micro_to_unit_value ? price / ppd.micro_to_unit_value : 'n/a';
                                $('#micro_unit_td').html(conversion.toFixed(2));
                                $('#unit_td').html(parseInt(price).toFixed(2));
                                conversion = ppd.unit_to_macro_value ? price * ppd.unit_to_macro_value : 'n/a';
                                $('#macro_unit_td').html(conversion.toFixed(2));
                                conversion = ppd.macro_to_super_value ? price * ppd.unit_to_macro_value * ppd.macro_to_super_value : 'n/a';
                                $('#super_unit_td').html(conversion.toFixed(2));
                            }
                            if(productType == 'macro_unit_code') {
                                conversion = ppd.micro_to_unit_value ? price / ppd.micro_to_unit_value / ppd.unit_to_macro_value : 'n/a';
                                $('#micro_unit_td').html(conversion.toFixed(2));
                                conversion = ppd.unit_to_macro_value ? price / ppd.unit_to_macro_value : 'n/a';
                                $('#unit_td').html(conversion.toFixed(2));
                                $('#macro_unit_td').html(parseInt(price).toFixed(2));
                                conversion = ppd.macro_to_super_value ? price * ppd.macro_to_super_value : 'n/a';
                                $('#super_unit_td').html(conversion.toFixed(2));
                            }
                            if(productType == 'super_unit_code') {
                                conversion = ppd.micro_to_unit_value ? price / ppd.micro_to_unit_value / ppd.unit_to_macro_value /ppd.macro_to_super_value : 'n/a';
                                $('#micro_unit_td').html(conversion.toFixed(2));
                                conversion = ppd.unit_to_macro_value ? price / ppd.unit_to_macro_value / ppd.macro_to_super_value : 'n/a';
                                $('#unit_td').html(conversion.toFixed(2));
                                conversion = ppd.macro_to_super_value ? price / ppd.macro_to_super_value : 'n/a';
                                $('#macro_unit_td').html(conversion.toFixed(2));
                                $('#super_unit_td').html(parseInt(price).toFixed(2));
                            }
                        }
                    }
                }
            })
        })
    </script>
@endsection
