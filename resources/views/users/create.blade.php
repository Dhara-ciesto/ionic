@extends('layouts.master')

@section('title')
    Manage Admin
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            User
        @endslot
        @slot('title')
            Add Admin
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Meta Data</h4>
                    <p class="card-title-desc">Fill all information below</p> --}}
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input id="username" name="username" type="text" value="{{ old('username') }}"
                                        class="form-control" placeholder="User name">
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="username">Whatsapp No</label>
                                    <input id="whatsapp_no" name="whatsapp_no" type="number"
                                        value="{{ old('whatsapp_no') }}" class="form-control" placeholder="Whatsapp No">
                                    @error('whatsapp_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="text" value="{{ old('email') }}"
                                        class="form-control" placeholder="Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select class="form-select" name="role" id="role">
                                    <option value="" disabled>Select Role</option>
                                    <option value="1"  selected>Admin</option>

                                </select>
                                @error('role')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="Password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password">Confirm Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" placeholder="Confirm your Password">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row float-end">
                            <div class="d-flex flex-wrap gap-2 ">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                <a href="{{ route('user.index') }}"
                                    class="btn btn-secondary waves-effect waves-light">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
