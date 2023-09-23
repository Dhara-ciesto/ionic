@extends('layouts.master')

@section('title')
    Product
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Bulk Import Product
        @endslot
    @endcomponent
    {{-- {{ dd($row) }} --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header float-start">
                </div>
                <div class="card-body p-5">
                    <a href="{{ route('export.productdemo') }}"><button class="btn btn-outline-warning" type="button">{{ __('Export Demo') }}</button></a>
                    <br>   <br>
                    <form method="post" action="{{ route('import.excel.product') }}" class=""
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row ps-2">
                            <div class="col-md-5 p-0">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <input type="file" name="products" class="form-control"
                                        accept=".csv"
                                            required>
                                        {{-- <label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label> --}}
                                    </div>
                                    {{-- <button  class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Import')}}</button> --}}
                                    <div class="text-right float-end">
                                        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-save"></i>
                                            {{ __('Import') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection
