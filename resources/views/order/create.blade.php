@extends('layouts.master')

@section('title')
    Estimate
@endsection
<style>
    /* .select2-container .select2-selection--multiple .select2-selection__choice {
        padding: 0px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding-left: 25px !important;
    } */
</style>
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Estimate
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 p-0">
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Buyer name<span class="error">*</span></label>
                                            <input id="buyer_name" name="buyer_name" type="text"
                                                value="{{ old('product_name') }}" class="form-control"
                                                placeholder="Buyer Name">
                                            @error('buyer_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Village name<span class="error">*</span></label>
                                            <input id="village_name" name="village_name" type="text"
                                                value="{{ old('village_name') }}" class="form-control"
                                                placeholder="Village Name">
                                            @error('village_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name"> Date<span class="error">*</span></label>
                                            <input id="date" name="date" type="date" value="{{ old('date') }}"
                                                class="form-control"">
                                            @error('date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 p-0">
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Car No<span class="error">*</span></label>
                                            <input id="car_no" name="car_no" type="text" value="{{ old('car_no') }}"
                                                class="form-control" placeholder="Car Number">
                                            @error('car_no')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name"> Transport name<span class="error">*</span></label>
                                            <input id="transport_name" name="transport_name" type="text"
                                                value="{{ old('transport_name') }}" class="form-control"
                                                placeholder="Car Number">
                                            @error('transport_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 p-0 mt-4">
                                <div class='repeater'>
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <div class="">
                                                        <div class="mb-2">
                                                            <label for="brand_name"> Product<span
                                                                    class="error">*</span></label>
                                                            <select class="form-select select2" name="product"
                                                                data-placeholder="Select Product" required>
                                                                <option value="">Select Product</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}"
                                                                        {{ $product->id == old('product') ? 'selected' : '' }}>
                                                                        {{ $product->product_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('product')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="">
                                                        <div class="col-sm-11">
                                                            <div class="mb-2">

                                                                <label for="brand_name">Quantity<span
                                                                        class="error">*</span></label>
                                                                <input id="qty" name="qty" type="number" required
                                                                    value="{{ old('qty') }}" class="form-control"
                                                                    placeholder="Quantity" autocomplete="off">
                                                                @error('qty')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <input data-repeater-delete type="button" value="Delete" /> --}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="">
                                                        <div class="col-sm-11">
                                                            <div class="mb-2">
                                                                <label for="brand_name">Rate<span
                                                                        class="error">*</span></label>
                                                                <input id="rate" name="rate"  step="any" type="number" 
                                                                    value="{{ old('rate') }}" class="form-control"
                                                                    placeholder="Rate" autocomplete="off">
                                                                @error('rate')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <input data-repeater-delete type="button" value="Delete" /> --}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="">
                                                        <div class="col-sm-11">
                                                            <div class="mb-2">
                                                                <label for="brand_name">MRP<span
                                                                        class="error">*</span></label>
                                                                <input id="mrp" name="mrp"  step="any" type="number"
                                                                    value="{{ old('mrp') }}" class="form-control"
                                                                    placeholder="MRP" autocomplete="off">
                                                                @error('mrp')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <input data-repeater-delete type="button" value="Delete" /> --}}
                                                </div>
                                                <div class="form-group col-md-1 mt-4 pt-1">
                                                    <button data-repeater-delete type="button" value="Delete"
                                                        class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button data-repeater-create type="button" value="Add" id="add" class="btn btn-outline-success">Add</button>
                                </div>
                                {{-- <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name"> Product<span class="error">*</span></label>
                                            <select class="form-select select2" name="product[]" id="product" multiple
                                                data-placeholder="Select Product">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ $product->id == old('product') ? 'selected' : '' }}>
                                                        {{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">

                                            <label for="brand_name">Quantity<span class="error">*</span></label>
                                            <input id="qty" name="qty" type="text"
                                                value="{{ old('qty') }}" class="form-control" placeholder="Quantity"
                                                autocomplete="off">
                                            @error('qty')
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
                                            <a href="{{ route('order.index') }}"
                                                class="btn btn-danger waves-effect waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@push('js')
    {{-- public\assets\js\pages\form-repeater.int.js --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $("#add").click(function() {
            setTimeout(function() {

                $(document).find(".select2").select2({
                    placeholder: "Select a state",
                    // allowClear: true
                });

            }, 100);
        });
        $(document).ready(function() {
            // $('.select2').select2({
            //     width: '100%'
            //     //theme: "bootstrap"
            // });
            // $(".select2").select2({
            //     placeholder: "Select a state",
            //     allowClear: true
            // });

            // $('select').select2({
            //     width: '100%'
            //     //theme: "bootstrap"
            // });

        });
        $(document).ready(function() {
            $('.repeater').repeater({
                // (Optional)
                // start with an empty list of repeaters. Set your first (and only)
                // "data-repeater-item" with style="display:none;" and pass the
                // following configuration flag
                initEmpty: false,
                // (Optional)
                // "defaultValues" sets the values of added items.  The keys of
                // defaultValues refer to the value of the input's name attribute.
                // If a default value is not specified for an input, then it will
                // have its value cleared.
                // defaultValues: {
                //     // 'text-input': 'foo'
                // },
                // (Optional)
                // "show" is called just after an item is added.  The item is hidden
                // at this point.  If a show callback is not given the item will
                // have $(this).show() called on it.
                show: function() {
                    $(this).slideDown();
                    // $('.select2-container').remove();
                    // $(this).find(".select2-container").remove();
                    // $('.select2').select2({
                    //     placeholder: "placeholder text",
                    //     allowClear: true
                    // });
                    // $('.select2-container').css('width', '100%');

                },
                // (Optional)
                // "hide" is called when a user clicks on a data-repeater-delete
                // element.  The item is still visible.  "hide" is passed a function
                // as its first argument which will properly remove the item.
                // "hide" allows for a confirmation step, to send a delete request
                // to the server, etc.  If a hide callback is not given the item
                // will be deleted.
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                // (Optional)
                // You can use this if you need to manually re-index the list
                // for example if you are using a drag and drop library to reorder
                // list items.
                ready: function(setIndexes) {
                    // $(document).ready(function() {
                    //     $('select').select2({
                    //         width: '100%'
                    //         //theme: "bootstrap"
                    //     });
                    // });
                },
                // (Optional)
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            })
        });
    </script>
@endpush
