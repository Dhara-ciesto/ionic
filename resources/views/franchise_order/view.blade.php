@extends('layouts.master')

@section('title') Franchise Order @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Franchise Order @endslot
@endcomponent

<style>
    /* .iimg{
        display: none;
    } */
    #tbl-head td{
        padding-right: 32px;
    }
    @media print {

        #user_table td {
            padding: 0%;
        }
        .iimg{
            display: block !important;
        }
        .img{
            margin-bottom: 52%;
        }
        .card-header{
            display: none;
        }
        .card{
            box-shadow: none;
        }
    * {
        -webkit-print-color-adjust: exact; !important
    }
}
/* @media print { */

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.js">
</script>
<div class="row" id="card">
    <div class="col-md-12">
        <span class="logo-lg">
        </span>
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                    {{-- <button onclick="printJS({printable: ['card'], type: 'html', showModal:true, header:'Tira', imageStyle: 'width:50%;margin-bottom:20px;' });" class="btn btn-success me-1" ><i class="fa fa-print"></i></button> --}}
                </div>
                <a href="{{route('franchise_order.index')}}" class="btn btn-primary float-end me-2">{{__('Back')}}</a>
            </div>
            <div class="card-body">
                @if ($orderMaster)
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <table id="tbl-head">
                            <tr>
                                <td style="width: 20%">
                                    <img id="logo"  src="{{ URL::asset ('/assets/images/logo.png') }}" alt="" height="50" class="iimg">
                                </td>
                                <td>
                                    <b>Order No.:</b> {{$orderMaster->order_no}}
                                </td>
                                <td>
                                    <b>Franchise :</b> {{$orderMaster->franchise->franchise_name}}
                                </td>
                                <td>
                                    <b >Date:</b> {{$orderMaster->date}}
                                </td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                </div>
                            </div>
                            {{-- <div class="logo logo-light"> --}}
                                {{-- <div class="bg"></div> --}}
                                {{-- <span class="logo-lg">
                                </span> --}}
                                {{-- </div> --}}
                            </div>

                            <div class="col-md-4" >
                                {{-- <p class="float-end">
                            </p> --}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" id="tblData">
                    <table class="table mb-0" id="user_table" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                {{-- <th>Item Type</th>
                                <th>Price</th> --}}
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orderMaster && $orderMaster->orderChild)
                                @foreach ($orderMaster->orderChild as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if ($item->item_type == 'bakery')
                                                {{$item->bakery->name}}
                                            @elseif($item->item_type == 'kitchen')
                                                {{$item->kitchen->name}}
                                            @endif
                                        {{-- <td>{{$item->item_type}}</td>
                                        <td>{{$item->price}}</td> --}}
                                        <td>{{$item->quantity}}</td>
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td><b>Total Price</b></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>{{$orderMaster->total_price}}</b></td>
                                    <td></td>
                                </tr> --}}
                            @else
                            <tr>
                                <td colspan="4" class="text-center">No data found</td>

                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let $table = $('#user_table');

    window.tableFilterStripHtml = function(value) {
        return value.replace(/<[^>]+>/g, '').trim();
    }

</script>

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
