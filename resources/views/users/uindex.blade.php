@extends('layouts.master')

@section('title') Users @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Users @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if(Auth::user()->role == 1)
                    <a href="{{route('user.export')}}" class="btn btn-primary float-end mx-1">{{__('Export')}}</a>
                @endif

                {{-- <a href="{{route('user.create')}}" class="btn btn-primary float-end">{{__('Add Admin')}}</a> --}}
            </div>
            <div class="card-body">
                {{-- <h4 class="card-title">Basic example</h4> --}}
                <div class="table-responsive">
                    <table class="table mb-0" id="user_table" data-unique-id="id" data-toggle="table" data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true" data-total-field="count" data-data-field="items" data-show-columns="true" data-show-toggle="false" data-filter-control="true" data-show-columns-toggle-all="true"  data-filter-control-container="#filters">
                        <div id="filters" class="row bootstrap-table-filter-control">
                            {{-- <div class="col-md-2">
                                <label class="form-label">Brand</label>
                                <select class="form-control bootstrap-table-filter-control-product_brand.name" data-placeholder="Select Brand Name" data-field="product_brand.name">
                                    <option value=""></option>
                                </select>
                            </div> --}}
                            <div class="col-md-2">
                                <label class="form-label">Business Name</label>
                                <input type="text" class="form-control bootstrap-table-filter-control-username" placeholder="Enter User Name">
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">#</th>
                                <th data-field="username" data-filter-control="select" data-sortable="true">Business Name</th>
                                <th data-field="name" data-filter-control="select" data-sortable="true">Full Name</th>
                                <th data-field="whatsapp_no" data-filter-control="select" data-sortable="true">Whatsapp No</th>
                                {{-- <th data-field="email" data-filter-control="select" data-sortable="true">Email</th> --}}
                                {{-- <th data-field="role" data-filter-control="select" data-sortable="true">Role</th> --}}
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


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let $table = $('#user_table');
    $table.bootstrapTable({
        pageSize: 100,
        columns: [{}, {}, {}, {}
            , {
                field: 'operate'
                , title: 'Action'
                , align: 'center'
                , valign: 'middle'
                , clickToSelect: false
                , formatter: function(value, row, index) {
                    let url = "{{route('user.edit', ['id' => ':queryId'])}}";
                    url = url.replace(':queryId', row.id);
                    // <a href="${url}" class="btn btn-sm btn-warning">Edit</a>
                    let action = `<button onClick="remove(${row.id}, ${index})" class="btn btn-sm btn-danger">Delete</button>

                    `;
                    return action;
                }
            }
        ]
    });


    function ajaxRequest(params) {
        var url = "{{ route('user.server_side') }}"
        params.data.getadmin = false;
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
                let url = "{{route('user.destroy', ['id' => ':queryId'])}}";
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
