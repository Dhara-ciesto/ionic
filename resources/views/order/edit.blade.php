@extends('layouts.master')

@section('title') Product @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Edit Product @endslot
@endcomponent
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-5">
                <form method="POST" action="{{route('product.update', ['id' => $product->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5 p-0">
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Product Name<span class="error">*</span></label>
                                        <input id="product_name" name="product_name" type="text" value="{{old('product_name', $product->product_name)}}" class="form-control" placeholder="Product Name">
                                        @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Quantity<span class="error">*</span></label>
                                        <input id="qty" name="qty" type="text" value="{{old('qty',$product->qty)}}" class="form-control" placeholder="Quantity">
                                        @error('qty')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11 pt-2">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-outline-danger waves-effect waves-light m-2">Save</button>
                                        <a href="{{route('product.index')}}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
     $(document).ready(function() {
        $('.select2').select2({
            allowClear: true,
            width: '100%',
            placeholder: "Select an attribute"
        });
     });
</script>
@endpush
