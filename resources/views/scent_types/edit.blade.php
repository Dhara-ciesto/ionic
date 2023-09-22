@extends('layouts.master')

@section('title') Scent Types @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Masters @endslot
@slot('title') Edit Scent Type @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('scent_types.update', ['id' => $scent_type->id])}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="brand_name">Scent Type<span class="error">*</span></label>
                                <input id="name" name="name" type="text" value="{{old('name', $scent_type->name)}}" class="form-control" placeholder="Name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-outline-danger waves-effect waves-light">Update</button>
                        <a href="{{route('scent_types.index')}}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
