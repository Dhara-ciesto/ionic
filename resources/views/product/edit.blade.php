@extends('layouts.master')

@section('title')
    Product
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Edit Product
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 p-0">
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Select Category<span class="error">*</span></label>
                                            <select id="category_id" name="category_id" type="text"
                                                class="form-control select2" data-placeholder="Select Scent Type">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('scent_type_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Product Name<span class="error">*</span></label>
                                            <input id="product_name" name="product_name" type="text"
                                                value="{{ old('product_name', $product->product_name) }}"
                                                class="form-control" placeholder="Product Name">
                                            @error('product_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Photo<span class="error">*</span></label>
                                            <input id="photo" type="file" name="photo" accept="image/*"  class="form-control"
                                                placeholder="Campaign">{{ old('photo') }}</textarea>
                                            <small>File size maximum limit 5 MB.</small><br>
                                            @error('photo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if($product->file)
                                            <img src="{{ $product->file }}" height="100" width="100" style="align:right;" onerror="this.onerror=null;this.src='{{ asset("/images/placeholder.png") }}'">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Size<span class="error">*</span></label>
                                            <input id="size" name="size" type="text"
                                                value="{{ old('size',$product->size) }}" class="form-control"
                                                placeholder="Size">
                                            @error('size')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Pcs/Box<span class="error">*</span></label>
                                            <input id="pcs" name="pcs" type="number"
                                                value="{{ old('pcs', $product->pcs) }}" onchange="calculateqty()" class="form-control"
                                                placeholder="Pcs/Box">
                                            @error('pcs')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Box/case<span class="error">*</span></label>
                                            <input id="box" name="box" type="number"
                                                value="{{ old('box', $product->box) }}"  onchange="calculateqty()"class="form-control"
                                                placeholder="Box/case">
                                            @error('box')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Quantity/Cartoon<span class="error">*</span></label>
                                            <input id="qty" name="qty" type="number" readonly
                                                value="{{ old('qty', $product->qty) }}" class="form-control"
                                                placeholder="Quantity">
                                            @error('qty')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Cartoon<span class="error">*</span></label>
                                            <input id="cartoon" name="cartoon" type="number"
                                                value="{{ old('cartoon', $product->cartoon) }}" class="form-control"
                                                placeholder="Cartoon">
                                            @error('cartoon')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Finish<span class="error">*</span></label>
                                            <input id="finish" name="finish" type="text"
                                                value="{{ old('finish', $product->finish) }}" class="form-control"
                                                placeholder="Finish">
                                            @error('finish')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                 {{--<div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Price<span class="error">*</span></label>
                                            <input id="price" name="price" type="text"
                                                value="{{ old('price', $product->price) }}" class="form-control"
                                                placeholder="Price" autocomplete="off">
                                            @error('price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <div class="col-sm-11 pt-2">
                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-outline-danger waves-effect waves-light m-2">Save</button>
                                            <a href="{{ route('product.index') }}"
                                                class="btn btn-danger waves-effect waves-light">Cancel</a>
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
        function calculateqty(){
            var qty = $('#pcs').val()*$('#box').val();
            $('#qty').val(qty);
        }
    </script>
@endpush
