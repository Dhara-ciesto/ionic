@extends('layouts.master')

@section('title') Order Report @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Order Report @endslot
@endcomponent

<style>

    .iimg{
        display: none;
    }
    @media print{
        /* table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group } */

        th{
            padding: 0%
        }
        .iimg{
            display: block;
        }
        .card-header{
            display: none;
        }
        .card-body{
            margin-top: 25px;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <span class="logo-lg">
            <img id="logo"  src="{{ URL::asset ('/assets/images/logo.png') }}" alt="" height="50" class="iimg">
        </span>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="date" id="date" >

                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="item_type" id="item_type" aria-label="Default select example">
                            <option value="">Select item type</option>
                            <option value="bakery">Bakery</option>
                            <option value="kitchen">Kitchen</option>
                        </select>

                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="franchise" id="franchise" aria-label="Default select example">
                            <option value="">Select Franchise</option>
                            <option value="all">All</option>
                            @foreach ($data['franchise'] as $franchise)
                            <option value="{{$franchise->id}}">{{$franchise->franchise_name}}</option>

                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-2">
                        <label for="">select only item</label>
                    <input type="checkbox" id="check_id" name="checked">

                    </div>
                    <div class="col-md-1">
                        <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success me-1 btn-prnt" ><i class="fa fa-print"></i></a>
                                            </div>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive" id="tbldata">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('input[name="date"]').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });

    function ajaxRecord(checked){
        let dateInput = $('#date').val();
        let itemInput = $('#item_type').val();
        if (!dateInput) {
            let spanEl = document.createElement('span')
            $(spanEl).addClass('text-danger lara_error').text('Please select date')
                .insertAfter($("#date"));
            $(this).val('');
            return true;
        }

        if (!itemInput) {
            let spanEl = document.createElement('span')
            $(spanEl).addClass('text-danger lara_error').text('Please select item type')
                .insertAfter($("#item_type"));
            $(this).val('');
            return true;
        }


        $.ajax({
            url: "{{route('order_report.get_order_data_ajax')}}"
            , type: 'POST'
            , data: {
                date: dateInput
                , item_type: itemInput,
                franchise : $('#franchise').val(),
                checked:checked
            }
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , success: function(response) {
                console.log(response);
             $("#tbldata").html(response.data)

            }
            , error: function(errorResponse) {
                console.log(errorResponse);
            }
        });

    }
    $(document).on('change', '#item_type', function() {
        let checked = $('#check_id').is(":checked")
        ajaxRecord(checked)
    })

    $(document).on('change', '#franchise', function() {
        let checked = $('#check_id').is(":checked")
        ajaxRecord(checked)

    })

    $(document).on('click', '#check_id', function() {
        let checked = $('#check_id').is(":checked")
        ajaxRecord(checked)

    })



    // $table.bootstrapTable({
    //     columns: [{
    //             title: 'test1'
    //         }, {
    //             title: 'test2'
    //         }, {
    //             title: 'test3'
    //         }, {
    //             title: 'test4'
    //         }
    //         , {
    //             field: 'operate'
    //             , title: 'Action'
    //             , align: 'center'
    //             , valign: 'middle'
    //             , clickToSelect: false
    //             , formatter: function(value, row, index) {
    //                 let url = "{{route('franchise_order.show', ['id' => ':queryId'])}}";
    //                 url = url.replace(':queryId', row.id);
    //                 let action = `
    //                 <a href="${url}" class="btn btn-sm btn-primary">View</a>

    //                 `;
    //                 return action;
    //             }
    //         }
    //     ]
    // });


    // function ajaxRequest(params) {
    //     var url = "{{ route('franchise_order.server_side') }}"
    //     $.get(url + '?' + $.param(params.data)).then(function(res) {
    //         params.success(res)
    //     })
    // }

    window.tableFilterStripHtml = function(value) {
        return value.replace(/<[^>]+>/g, '').trim();
    }

    $(document).ready(function() {
        // $("#date").datepicker();
        $("#anim").on("change", function() {
            $("#date").datepicker("option", "showAnim", $(this).val());
        });

    })

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
