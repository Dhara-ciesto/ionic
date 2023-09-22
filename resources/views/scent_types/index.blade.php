@extends('layouts.master')

@section('title')
    Scent Types
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Masters
        @endslot
        @slot('title')
            Scent Types
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('scent_types.create') }}" class="btn btn-outline-danger float-end">{{ __('Add Scent Type') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="scent_type_table" data-unique-id="id" data-toggle="table"
                            data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true"
                            data-total-field="count" data-data-field="items" data-show-columns="true"
                            data-show-toggle="false" data-filter-control="true" data-filter-control-container="#filters" data-show-columns-toggle-all="true">
                            <div id="filters" class="row bootstrap-table-filter-control">
                                <div class="col-md-4">
                                    <label class="form-label">Scent Type</label>
                                    <input type="text" class="form-control bootstrap-table-filter-control-name" placeholder="Select Brand Name">
                                </div>
                            </div>
                            <thead>
                                <tr>
                                    <th data-field="counter" data-sortable="true">#</th>
                                    <th data-field="name" data-filter-control="select" data-sortable="true">Scent Type</th>
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
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script
        src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
    </script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let $table = $('#scent_type_table');
        $table.bootstrapTable({
            columns: [{}, {}, {
                field: 'operate',
                title: 'Action',
                align: 'center',
                valign: 'middle',
                clickToSelect: false,
                formatter: function(value, row, index) {
                    let url = "{{ route('scent_types.edit', ['id' => ':queryId']) }}";
                    url = url.replace(':queryId', row.id);
                    let checked = row.status == 'Active' ? 'checked' : '';
                    let action = `<a href="${url}" class="btn btn-sm btn-outline-warning">Edit</a>
                    <button onClick="remove(${row.id}, ${index})" class="btn btn-sm btn-danger">Delete</button>`;
                    return action;
                }
            }]
        });


        function ajaxRequest(params) {
            var url = "{{ route('scent_types.server_side') }}"
            $.get(url + '?' + $.param(params.data)).then(function(res) {
                params.success(res)
            })
        }

        window.tableFilterStripHtml = function(value) {
            return value.replace(/<[^>]+>/g, '').trim();
        }

        function remove(id, index) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: "btn bg-success mt-2",
                cancelButtonClass: "btn bg-danger ms-2 mt-2",
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('scent_types.destroy', ['id' => ':queryId']) }}";
                    url = url.replace(':queryId', id);
                    $.ajax({
                        url: url,
                        type: "get",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data, textStatus, jqXHR) {
                            console.log(data);
                            if (data.success) {
                                $table.bootstrapTable('removeByUniqueId', id);

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                })
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                });

                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                        }
                    });
                }
            })

        }
        
    </script>

    @if (Session::has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('success') }}"
            });
        </script>
    @endif
@endsection
