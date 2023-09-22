@extends('layouts.master')

@section('title') @lang('translation.Starter_Page') @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Area @endslot
@slot('title') Edit Area @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('area.update', ['id' => $area->id])}}">
                    @csrf
                    <input type="hidden" name="edit" value="{{$area->id}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Name</label>
                                <input id="name" name="name" type="text" value="{{old('name', $area->name)}}" class="form-control" placeholder="Name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">City</label>
                                <select class="form-select" name="city_id" id="city_id" aria-label="Default select example">
                                    <option value="">Select City</option>
                                    @foreach($cities as $key => $value)
                                    <option value="{{$value->id}}" {{$area->city_id == $value->id ? 'selected' : ''}} >{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" name="status" value="1" id="status_" {{$area->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        <a href="{{route('area.index')}}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
