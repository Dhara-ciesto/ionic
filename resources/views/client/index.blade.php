@extends('layouts.master')

@section('title') Clients @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Clients @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{route('client.create')}}" class="btn btn-primary float-end">{{__('Add client')}}</a>
            </div>
            <div class="card-body">
                {{-- <h4 class="card-title">Basic example</h4> --}}
                <div class="table-responsive">
                    <table class="table mb-0" id="user_table" data-unique-id="id" data-toggle="table" data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true" data-total-field="count" data-data-field="items" data-show-columns="true" data-show-toggle="false" data-filter-control="true" data-show-columns-toggle-all="true" >
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">#</th>
                                <th data-field="name" data-filter-control="select" data-sortable="true">Name</th>
                                {{-- <th data-field="email" data-filter-control="select" data-sortable="true">Email</th>
                                <th data-field="mobile" data-filter-control="select" data-sortable="true">Mobile</th> --}}
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
        columns: [{}, {}
            , {
                field: 'operate'
                , title: 'Action'
                , align: 'center'
                , valign: 'middle'
                , clickToSelect: false
                , formatter: function(value, row, index) {
                    let url = "{{route('client.edit', ['id' => ':queryId'])}}";
                    url = url.replace(':queryId', row.id);
                    let action = `
                    <a href="${url}" class="btn btn-sm btn-warning">Edit</a>
                    <button onClick="remove(${row.id}, ${index})" class="btn btn-sm btn-danger">Delete</button>

                    `;
                    return action;
                }
            }
        ]
    });


    function ajaxRequest(params) {
        var url = "{{ route('client.server_side') }}"
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
                let url = "{{route('client.destroy', ['id' => ':queryId'])}}";
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
