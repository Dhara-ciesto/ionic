@extends('layouts.master')

@section('title') Change Password @endsection


@section('content')
@component('components.breadcrumb')
@slot('li_1') Admin @endslot
@slot('title') Change Password @endslot

@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">Meta Data</h4>
                    <p class="card-title-desc">Fill all information below</p> --}}
                <form method="POST" action="{{route('user.change_password.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password">Old Password</label>
                                <input id="old_password" name="old_password" type="password" class="form-control" placeholder="Enter you old password">
                                @error('old_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm your password">
                                @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
@if(Session::has('success'))
<script>
    const Toast = Swal.mixin({
        toast: true
        , position: 'top-end'
        , showConfirmButton: false
        , timer: 3000
        , timerProgressBar: true
        , didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success'
        , title: "{{Session::get('success')}}"
    });

</script>
@endif
@endsection

