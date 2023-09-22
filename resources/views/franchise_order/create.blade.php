@extends('layouts.master')

@section('title') @lang('translation.Starter_Page') @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Franchise Order @endslot
@slot('title') Add Franchise Order @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('franchise_order.store')}}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <select class="form-select" name="franchise_id" id="franchise_id">
                                    <option value="">Select franchise</option>
                                    @foreach ($franchises as $item)
                                        <option value="{{$item->id}}">{{$item->franchise_code}}-{{$item->franchise_name}}</option>
                                    @endforeach
                                </select>
                                @error('franchise_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <input name="date" id="date" type="text" value="{{old('date')}}" class="form-control" placeholder="dd-mm-yyyy">
                                @error('date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <select class="form-select" name="f_items" id="f_items">
                                    <option value="bakery">Bakery</option>
                                    <option value="kitchen">kitchen</option>
                                </select>
                                @error('f_items')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="col-md-6 hide" id="bakery">
                            <h3>Bakery</h3>
                            <div class="table-responsive">
                                <table class="table mb-0" id="user_table">
                                    <thead>
                                        <tr>
                                            <td>Item</td>
                                            <td>Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($bakeries)
                                            @foreach ($bakeries as $item)
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td><input type="number" name="items['bakery'][{{$item->id}}]" value="0" class="form-control"></td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 hide" id="kitchen" style="display: none">
                            <h3>Kitchen</h3>
                            <div class="table-responsive">
                                <table class="table mb-0" id="user_table">
                                    <thead>
                                        <tr>
                                            <td>Item</td>
                                            <td>Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($kitchens)
                                        @foreach ($kitchens as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td><input type="number" name="items['kitchen'][{{$item->id}}]" value="0" class="form-control"></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script>
    $(document).on('change', '#f_items', function(e) {
        console.log($(this).val());
        $('.hide').hide();
        $('#'+$(this).val()).show();
    })

    $(document).ready(function() {
        $( "#date" ).datepicker();
        $( "#anim" ).on( "change", function() {
            $( "#date" ).datepicker( "option", "showAnim", $( this ).val() );
        });

    });

</script>
@endpush
