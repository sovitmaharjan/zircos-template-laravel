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
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="button-list m-b-0">
                            <a href="{{ route('product-packaging-detail.create') }}"
                                class="btn btn-success waves-effect w-md waves-light">Add</a>
                        </div>
                        <table id="datatable" class="table table-striped table-colored table-info">
                            <thead>
                                <tr>
                                    <th>S. N.</th>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th>Micro</th>
                                    <th>Unit</th>
                                    <th>Macro</th>
                                    <th>Super</th>
                                    <th>Micro to Unit</th>
                                    <th>Unit to Macro</th>
                                    <th>Macro to Super</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_packaging_detail as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->product_code }}</td>
                                        <td>{{ $value->product_variant_code }}</td>
                                        <td>{{ $value->micro_unit_code }}</td>
                                        <td>{{ $value->unit_code }}</td>
                                        <td>{{ $value->macro_unit_code }}</td>
                                        <td>{{ $value->super_unit_code }}</td>
                                        <td>{{ $value->micro_to_unit_value }}</td>
                                        <td>{{ $value->unit_to_macro_value }}</td>
                                        <td>{{ $value->macro_to_super_value }}</td>
                                        <td>
                                            <div class="button-list">
                                                <a href="{{ route('product-packaging-detail.edit', $value->id) }}"
                                                    class="btn btn-warning btn-xs waves-effect w-xs waves-light">Edit</a>
                                                <form method="post" action="{{ route('product-packaging-detail.destroy', $value->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-danger btn-xs waves-effect w-xs waves-light">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#datatable').dataTable();
    </script>
@endsection
