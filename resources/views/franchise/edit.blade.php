@extends('layouts.master')

@section('title') @lang('translation.Starter_Page') @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Franchise @endslot
@slot('title') Edit Franchise @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('franchise.update', ['id' => $franchise->id])}}">
                    @csrf
                    <input type="hidden" name="edit" value="{{$franchise->id}}">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Franchise Code</label>
                                <input name="franchise_code" id="franchise_code" type="text" value="{{old('franchise_code', $franchise->franchise_code)}}" class="form-control" placeholder="Franchise Code">
                                @error('franchise_code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Franchise Name</label>
                                <input name="franchise_name" id="franchise_name" type="text" value="{{old('franchise_name', $franchise->franchise_name)}}" class="form-control" placeholder="Franchise Name">
                                @error('franchise_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Phone No.</label>
                                <input name="phone_no" id="phone_no" type="text" value="{{old('phone_no', $franchise->phone_no)}}" class="form-control" placeholder="Phone No">
                                @error('phone_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Mobile No.</label>
                                <input name="mobile_no" id="mobile_no" type="text" value="{{old('mobile_no', $franchise->mobile_no)}}" class="form-control" placeholder="Mobile No">
                                @error('mobile_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">City</label>
                                <select class="form-select" name="city_id" id="city_id">
                                    <option value="">Select City</option>
                                    @foreach($cities as $value)
                                    <option value="{{$value->id}}" {{$value->id == old('city_id', $franchise->city_id) ? 'selected' : ''}}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Area</label>
                                <select class="form-select" name="area_id" id="area_id">
                                    <option value="">Select Area</option>
                                </select>
                                @error('area_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Pincode</label>
                                <input name="pincode" id="pincode" type="text" value="{{old('pincode', $franchise->pincode)}}" class="form-control" placeholder="pincode">
                                @error('pincode')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" aria-label="With textarea">{{old('address', $franchise->address)}}</textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Password</label>
                                <input name="password" id="password" type="password" value="{{old('password')}}" class="form-control" placeholder="password">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Password Confirmation</label>
                                <input name="password_confirmation" id="password_confirmation" type="password" value="{{old('password_confirmation')}}" class="form-control" placeholder="Password Confirmation">
                                @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" name="status" value="1" id="status_" {{$franchise->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        <a href="{{route('franchise.index')}}" class="btn btfranchise-secondary waves-effect waves-light">Cancel</a>
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
    $(document).ready(function() {
        // $('#address').summernote();
        $("#city_id").select2();
        $("#area_id").select2();
        $('#city_id').change();
    });


    // get area
    $(document).on('change', '#city_id', function(e) {
        let city_id = $(this).val();
        if (city_id) {
            $.ajax({
                url: "{{route('franchise.getArea')}}"
                , type: 'POST'
                , data: {
                    'city_id': city_id
                }
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    if (response.status) {
                        $('select[name="area_id"]').empty();
                        $('select[name="area_id"]').append('<option value="">Select Area</option>');
                        $.each(response.data, function(key, value) {
                            $('select[name="area_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            // $('select[name="area_id"]').append(`<option value="${value.id}" ${(() => {if(value.id == "{{old('area_id')}}") {
                            //     return `selected`
                            // }else {return ''}})()} >${value.name}</option>`);
                            if(value.id == @json(old('area_id', $franchise->area_id))) {
                                $('select[name="area_id"]').val(value.id);
                            }
                        });
                    }
                }
                , error: function(errorResponse) {
                    console.log(errorResponse);
                }
            });
        } else {
            $('select[name="area_id"]').empty();
            $('select[name="area_id"]').append('<option value="">Select Area</option>');
            $('#city_id').val('').trigger('change');
        }
    })

</script>
@endpush

