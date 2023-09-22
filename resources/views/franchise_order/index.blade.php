@extends('layouts.master')

@section('title') Franchise Order @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Franchise Order @endslot
@endcomponent
<STYLE>
    @media print{
        .card{
            box-shadow: none;
        }
    }
</STYLE>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <a href="{{route('franchise_order.store')}}" class="btn btn-primary">Add</a>
                <div class="table-responsive">
                    <table class="table mb-0" id="profile_list_table" data-unique-id="id" data-toggle="table" data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true" data-total-field="count" data-data-field="items" data-show-columns="true" data-show-toggle="false" data-filter-control="true" data-show-columns-toggle-all="true">
                        <thead>
                            <tr>
                                <th data-field="counter" data-sortable="true">#</th>
                                <th data-field="franchise.franchise_name" data-filter-control="input" data-sortable="true">Franchise Name</th>
                                {{-- <th data-field="status" data-filter-control="input" data-sortable="true">Order No</th> --}}
                                <th data-field="order_no" data-filter-control="input" data-sortable="true">Order No</th>
                                <th data-field="total_price" data-filter-control="input" data-sortable="true">Price</th>
                                <th data-field="date" class="date" data-filter-control="input" data-sortable="true">Order Date</th>
                                <th data-sortable="false">Action</th>
                            </tr>
                        </thead>
                        <tbody>

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

<script src="{{asset('assets/js/order_datatable.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let $table = $('#profile_list_table');
    $table.bootstrapTable({
        columns: [{}, {}, {}, {}, {}

            , {
                field: 'operate'
                , title: 'Action'
                , align: 'center'
                , valign: 'middle'
                , clickToSelect: false
                , formatter: function(value, row, index) {
                    let url = "{{route('franchise_order.show', ['id' => ':queryId'])}}";
                    url = url.replace(':queryId', row.id);
                    let editUrl = "{{route('franchise_order.edit', ['id' => ':queryId'])}}";
                    editUrl = editUrl.replace(':queryId', row.id);
                    let action = `
                    <a href="${url}" class="btn btn-sm btn-primary">View</a>
                    <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                    `;
                    return action;
                }
            }
        ]
    });


    function ajaxRequest(params) {
        var url = "{{ route('franchise_order.server_side') }}"
        $.get(url + '?' + $.param(params.data)).then(function(res) {
            params.success(res)
        })
    }

    window.tableFilterStripHtml = function(value) {
        return value.replace(/<[^>]+>/g, '').trim();
    }

    function remove(id, index) {
        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = "{{route('franchise.destroy', ['id' => ':queryId'])}}";
                url = url.replace(':queryId', id);
                $.ajax({
                    url: url
                    , type: "get"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , success: function(data, textStatus, jqXHR) {
                        console.log(data);
                        if (data.success) {
                            $table.bootstrapTable('removeByUniqueId', id);

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
                                , title: data.message
                            });

                        }
                    }
                    , error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                    }
                });
            }
        })

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
