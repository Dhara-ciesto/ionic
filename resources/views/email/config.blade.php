@extends('layouts.master')

@section('title') Email Setting @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Masters @endslot
@slot('title') Email Setting @endslot
@endcomponent
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('email.config')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Unit">Mail Encryption<span class="error">*</span></label>
                                <input id="name" name="mail_encryption" type="text" value="{{old('mail_encryption',$emailconfig->mail_encryption)}}" class="form-control" placeholder="Mail Encryption">
                                @error('mail_encryption')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Unit">Mail From Address<span class="error">*</span></label>
                                <input id="mail_from_address" name="mail_from_address" type="text" value="{{old('mail_from_address',$emailconfig->mail_from_address)}}" class="form-control" placeholder="Mail From Address">
                                @error('mail_from_address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Unit">Mail Username<span class="error">*</span></label>
                                <input id="mail_username" name="mail_username" type="text" value="{{old('mail_username',$emailconfig->mail_username)}}" class="form-control" placeholder="Mail Username">
                                @error('mail_username')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Unit">Mail Password<span class="error">*</span></label>
                                <input id="mail_password" name="mail_password" type="text" value="{{old('mail_password',$emailconfig->mail_password)}}" class="form-control" placeholder="Mail Password">
                                @error('mail_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Unit">Mail Host<span class="error">*</span></label>
                                <input id="mail_host" name="mail_host" type="text" value="{{old('mail_host',$emailconfig->mail_host)}}" class="form-control" placeholder="Mail Host">
                                @error('mail_host')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Unit">Mail Port<span class="error">*</span></label>
                                <input id="name" name="mail_port" type="text" value="{{old('mail_port',$emailconfig->mail_port)}}" class="form-control" placeholder="Mail Port">
                                @error('mail_port')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Unit">Mail FROM NAME<span class="error">*</span></label>
                                <input id="name" name="mail_from_name" type="text" value="{{old('mail_from_name',$emailconfig->mail_from_name)}}" class="form-control" placeholder="Mail From Name">
                                @error('mail_from_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-outline-danger waves-effect waves-light">Save</button>
                        <a href="{{ URL::previous() }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
@if (\Session::has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: "{!! \Session::get('success') !!}"
            });
        </script>
    @endif
@endsection
