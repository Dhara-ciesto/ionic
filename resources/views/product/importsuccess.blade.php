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
                <div class="card-header">
                    <a href="{{ route('import.product') }}" class="btn btn-outline-danger float-end me-1">{{ __('Back') }}</a>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-5 p-0">
                            <table class="table mb-0 table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($all_products)
                                    @foreach ($all_products as $key => $product)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $product['product'] }}</td>
                                        <td>{{ $product['error'] }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection
