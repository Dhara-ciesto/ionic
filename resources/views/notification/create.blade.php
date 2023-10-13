@extends('layouts.master')

@section('title')
    Notification
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Notification
        @endslot
        @slot('title')
            Add Notification
        @endslot
    @endcomponent

@section('css')
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="card-title-desc">Fill all information below</p>
                <form method="POST" action="{{ route('notification.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-6">
                            <div class="mb-3">
                                <label for="Title">Title<span class="error">*</span></label>
                                <input id="title" name="title" type="text" value="{{ old('title') }}"
                                    class="form-control" placeholder="Title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 col-md-8 col-lg-6">
                            <div class="mb-2">
                                <label for="brand_name">Select Users<span class="error">*</span></label>
                                <select id="user_ids" name="user_ids[]" class="form-control select2"
                                    data-placeholder="Select User" multiple>
                                    <option disabled>Select User</option>
                                    <option value="all" {{ old('user_ids') == 'all' ? 'selected' : '' }}>Select All
                                    </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_ids') == $user->id ? 'selected' : '' }}>{{  $user->username.' - '. $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_ids')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 col-md-8 col-lg-6">
                            <div class="mb-3">
                                <label for="Message">Message<span class="error">*</span></label>
                                <textarea id="message" name="message" type="text" class="form-control" placeholder="Message">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="form-group">
                                <div class="mb-3">
                                        <label for="Campaign">Send Date<span class="error">*</span></label>
                                        <input id="send_date" name="send_date" type="text" autocomplete="off"
                                            value="{{ old('send_date') }}" class="form-control datepicker"
                                            placeholder="Send Date">
                                            @error('send_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="form-group">
                                <div class="mb-3">
                                    <div class="form-group" id="timepicker-input-group1">
                                        <label for="Campaign">Send Time<span class="error">*</span></label>
                                        <input id="timepicker" type="text" name="send_time" value="{{ old('send_time') }}" class="form-control"
                                            data-provide="timepicker">
                                            @error('send_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex col-sm-7 flex-wrap gap-2 float-end">
                        <button type="submit" class="btn btn-outline-success waves-effect waves-light">Save</button>
                        <a href="{{ route('notification.index') }}"
                            class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script>
    $('.select2').select2({
        width: '100%'
        //theme: "bootstrap"
    });
    $(".datepicker").datepicker({
        format: 'dd-mm-yyyy',
        altFormat : 'yyyy-mm-dd',
        autoclose: true,
        closeOnDateSelect: true
    });
    $("#timepicker").timepicker({
        icons: {
            up: "mdi mdi-chevron-up",
            down: "mdi mdi-chevron-down"
        },
        appendWidgetTo: "#timepicker-input-group1"
    });
</script>
<!-- owl.carousel js -->
{{-- <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script> --}}
<!-- auth-2-carousel init -->
{{-- <script src="{{ URL::asset('/assets/js/pages/auth-2-carousel.init.js') }}"></script> --}}
@endsection
