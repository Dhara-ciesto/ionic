@extends('layouts.master')

@section('title') Product Brand @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Masters @endslot
@slot('title') Edit Product Brand @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('product.brands.update', ['id' => $brand->id])}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="brand_name">Brand Name<span class="error">*</span></label>
                                <input id="name" name="name" type="text" value="{{old('name', $brand->name)}}" class="form-control" placeholder="Name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="hidden" name="status" value="Deactive">
                                <input class="form-check-input" type="checkbox" name="status" value="Active" id="status_" {{$brand->status == 'Active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_">
                                    Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-outline-danger waves-effect waves-light">Update</button>
                        <a href="{{route('product.brands.index')}}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
