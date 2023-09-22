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
            Product
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('product.create') }}" class="btn btn-outline-danger float-end">{{ __('Add Product') }}</a>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Filters</h4>
                    <div class="table-responsive">
                        <table class="table mb-0" id="user_table" data-unique-id="id" data-toggle="table"
                        data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true"
                        data-total-field="count" data-data-field="items" data-show-columns="true"
                        data-show-toggle="false" data-filter-control="true" data-filter-control-container="#filters" data-show-columns-toggle-all="true">
                        <div id="filters" class="row bootstrap-table-filter-control">
                            {{-- <div class="col-md-2">
                                <label class="form-label">Brand</label>
                                <select class="form-control bootstrap-table-filter-control-product_brand.name" data-placeholder="Select Brand Name" data-field="product_brand.name">
                                    <option value=""></option>
                                </select>
                            </div> --}}
                            <div class="col-md-2">
                                <label class="form-label">Product</label>
                                <input type="text" class="form-control bootstrap-table-filter-control-product_name" placeholder="Enter Product Name">
                            </div>
                            {{-- <div class="col-md-1">
                                <label class="form-label">Scent Type</label>
                                <select class="form-control bootstrap-table-filter-control-scent_type.name" data-placeholder="Select Scent Type" data-field="scent_type.name">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Size</label>
                                <input type="text" class="form-control bootstrap-table-filter-control-size" placeholder="Enter Size">
                            </div> --}}
                            {{-- <div class="col-md-2">
                                <label class="form-label">Fragrance Tone</label>
                                <select class="form-control bootstrap-table-filter-control-fragrance_tone_1.name" data-field="fragrance_tone_1.name">
                                    <option value="">Select Fragrance Tone</option>
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-1">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control bootstrap-table-filter-control-price" placeholder="Enter Price">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Campaign</label>
                                <select class="form-control bootstrap-table-filter-control-campaign.name" data-placeholder="Select Campaign" data-field="campaign.name">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Gender</label>
                                <select class="form-control bootstrap-table-filter-control-gender" data-placeholder="Select Gender" data-field="gender">
                                    <option value=""></option>
                                </select>
                            </div> --}}
                        </div>
                        <button type="button" id="delete_all" style="margin-bottom:0px;margin-top:20px" class="btn btn-outline-danger" data-url="{{ route('product.destroy.selected') }}" onclick="delete_all()">Delete All Selected</button>
                        <thead>
                            <tr>
                                <th data-field="counter" data-sortable="true">#</th>
                                <th data-field="checkbox"><input type="checkbox" id="select_all" onchange="select_all(this)"></th>
                                {{-- <th data-field="product_brand.name" data-filter-control="select" data-sortable="true">Brand </th> --}}
                                <th data-field="product_name" data-filter-control="input" data-sortable="true">Product Name </th>
                                {{-- <th data-field="scent_type.name" data-filter-control="select" data-sortable="true">Scent Type </th> --}}
                                <th data-field="qty" data-filter-control="input" data-sortable="true">Quantity </th>
                                {{-- <th data-field="fragrance_tone_1.name" data-filter-control="select" data-sortable="true">Fragrance Tone 1 </th> --}}
                                {{-- <th data-field="price" data-filter-control="input" data-sortable="true">Price </th> --}}
                                {{-- <th data-field="campaign.name" data-filter-control="select" data-sortable="true">Campaign </th> --}}
                                {{-- <th data-field="gender" data-filter-control="select" data-sortable="true">Gender</th> --}}
                                {{-- <th data-field="status"  data-sortable="true">Status</th> --}}

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

    <script>
        let $table = $('#user_table');
        $table.bootstrapTable({
            columns: [{}, {}, {},{},{
                field: 'operate',
                sortable: 'false',
                title: 'Action',
                align: 'center',
                valign: 'middle',
                clickToSelect: false,
                formatter: function(value, row, index) {
                    let url = "{{ route('product.edit', ['id' => ':queryId']) }}";
                    url = url.replace(':queryId', row.id);
                    let show_url = "{{route('product.show', ['id' => ':queryId'])}}";
                    show_url = show_url.replace(':queryId', row.id);
                    let status = row.status == 'Active' ? 'Deactive' : 'Active' ;
                    var class_name = row.status == 'Active' ? 'btn-outline-danger' : 'btn-outline-primary' ;

                    let action = `<a href="${show_url}" class="btn btn-sm btn-outline-info">View</a>&nbsp;<a href="${url}" class="btn btn-sm btn-outline-warning">Edit</a>
                    <button type="button" onClick="changeStatus(${row.id}, ${index}, '${status}')" class="btn btn-sm `+class_name+`">`+status+`</button>`;
                    return action;
                }
            }]
        });


        function ajaxRequest(params) {
            var url = "{{ route('product.server_side') }}"
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
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('product.destroy', ['id' => ':queryId']) }}";
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
        function changeStatus(id, index, status) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: "btn bg-success mt-2",
                cancelButtonClass: "btn bg-danger ms-2 mt-2",
                confirmButtonText: 'Yes, Change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('product.change_status', ['id' => ':queryId']) }}";
                    url = url.replace(':queryId', id);
                    $.ajax({
                        url: url,
                        type: "post",
                        data:{status: status },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data, textStatus, jqXHR) {
                            if (data.success) {
                                $table.bootstrapTable('refresh');
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

        function select_all(e) {
            $(".sub_chk").prop('checked', e.checked);
        }

        function delete_all() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: "btn bg-success mt-2",
                cancelButtonClass: "btn bg-danger ms-2 mt-2",
                confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var allVals = [];
                    $(".sub_chk:checked").each(function() {
                        allVals.push($(this).attr('data-id'));
                    });

                    if(allVals.length <=0)
                    {
                        alert("Please select at least one product.");
                    }  else {
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: $('#delete_all').data('url'),
                            type: 'GET',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function(data, textStatus, jqXHR) {
                                if (data['success']) {
                                    $table.bootstrapTable('refresh');
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
                                        title: data.success
                                    });
                                } else if (data['error']) {
                                    alert('Whoops Something went wrong!!');
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert('Whoops Something went wrong!!');
                            }
                        });
                    }
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
