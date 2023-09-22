@extends('layouts.master')

@section('title') Campaign @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Masters  @endslot
@slot('title') Add Campaign @endslot
@endcomponent

@section('css')
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="card-title-desc">Fill all information below</p>
                <form method="POST" action="{{route('campaign.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Campaign">Campaign<span class="error">*</span></label>
                                <input id="name" name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Campaign">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Campaign">Description</label>
                                <textarea id="description" name="description" type="text" class="form-control" placeholder="Description">{{old('description')}}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Campaign">Start Date</label>
                                <input id="start_date" name="start_date" type="text" autocomplete="off" value="{{old('start_date')}}" class="form-control datepicker" placeholder="Start Date">
                                @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Campaign">End Date</label>
                                <input id="end_date" name="end_date" type="text" autocomplete="off" value="{{old('end_date')}}" class="form-control datepicker" placeholder="End Date">
                                @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-outline-danger waves-effect waves-light">Save</button>
                        <a href="{{route('campaign.index')}}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
$( ".datepicker" ).datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    closeOnDateSelect: true
});
</script>
<!-- owl.carousel js -->
{{-- <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script> --}}
<!-- auth-2-carousel init -->
{{-- <script src="{{ URL::asset('/assets/js/pages/auth-2-carousel.init.js') }}"></script> --}}
@endsection
