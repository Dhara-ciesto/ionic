@extends('layouts.master')


@section('title') DASHBOARD @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Home @endslot
@slot('title') Dashboard @endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div id="toolbar">
                        @if(Auth::user()->role == 1)
                        <a href="{{route('submission.export')}}" class="btn btn-primary float-end mx-1">{{__('Export All')}}</a>
                        @endif
                        <select class="form-control">
                            <option value="">Export Basic</option>
                            <option value="all">Export All</option>
                            <option value="selected">Export Selected</option>
                        </select>

                    </div>
                </div>
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="profile_list_table" class="table table-striped" data-unique-id="id" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-toggle="table" data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true" data-total-field="count" data-data-field="items" data-show-columns="true" data-show-toggle="false" data-filter-control="true" data-show-columns-toggle-all="true">
                            <thead>
                                <tr>
                                    <th data-field="counter" data-sortable="true">{{__('#')}}</th>
                                    <th data-field="full_name" data-filter-control="input" data-sortable="true">{{__('Full Name')}}</th>
                                    <th data-field="client_id" data-filter-control="input" data-sortable="true">{{__('Client Id')}}</th>
                                    <th data-field="role" data-filter-control="input" data-sortable="true">{{__('Role')}}</th>
                                    <th data-field="contact_number" data-filter-control="input" data-sortable="true">{{__('Contact Number')}}</th>
                                    <th data-field="email" data-filter-control="input" data-sortable="true">{{__('Email')}}</th>
                                    <th data-field="city_obj.name" data-filter-control="select" data-sortable="true">{{__('City')}}</th>
                                    <th data-field="state_obj.name" data-filter-control="select" data-sortable="true">{{__('State')}}</th>
                                    <th data-field="country_obj.name" data-filter-control="select" data-sortable="true">{{__('Country')}}</th>
                                    <th data-field="visa_status" data-filter-control="input" data-sortable="true">{{__('Visa Status')}}</th>
                                    <th data-field="w2_rate" data-filter-control="input" data-sortable="true">{{__('W2 Rate')}}</th>
                                    <th data-field="c2c_rate" data-filter-control="input" data-sortable="true">{{__('C2c Rate')}}</th>
                                    <th data-field="c2c_employer_name" data-filter-control="input" data-sortable="true">{{__('C2c Employer Name')}}</th>
                                    <th data-field="c2c_employer_email" data-filter-control="input" data-sortable="true">{{__('C2c Employer Email')}}</th>
                                    <th data-field="c2c_employer_contact" data-filter-control="input" data-sortable="true">{{__('C2c Employer Contact')}}</th>
                                    <th data-field="client.name" data-filter-control="input" data-sortable="true">{{__('Client Name')}}</th>
                                    <th data-field="end_client_name" data-filter-control="input" data-sortable="true">{{__('End Client Name')}}</th>
                                    <th data-field="submission_to_client_rate" data-filter-control="input" data-sortable="true">{{__('Submission to Client Rate')}}</th>
                                    <th data-field="client_manager_name" data-filter-control="input" data-sortable="true">{{__('Client Manager Name')}}</th>
                                    <th data-field="manager.name" data-filter-control="input" data-sortable="true">{{__('Acestack Manager Name')}}</th>
                                    <th data-field="recruiter.name" data-filter-control="input" data-sortable="true">{{__('Recruiter Name')}}</th>
                                    <th data-field="update_by_acestack_manager" data-filter-control="input" data-sortable="true">{{__('Update by Acestack Manager')}}</th>
                                    <th data-field="update_from_client" data-filter-control="input" data-sortable="true">{{__('Update from Client')}}</th>
                                    <th data-field="created_at" data-filter-control="input" data-sortable="false">{{__('Created At')}}</th>
                                    <th data-buttons="true" data-show-button-text="View Details">{{__('View Details')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection

@section('script')
<!-- Responsive Table js -->
{{-- <script src="{{ URL::asset('/assets/libs/rwd-table/rwd-table.min.js') }}"></script> --}}

<!-- Init js -->
{{-- <script src="{{ URL::asset('/assets/js/pages/table-responsive.init.js') }}"></script> --}}

<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">


<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
{{-- <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script> --}}
{{-- <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/extensions/export/bootstrap-table-export.min.js"></script> --}}


<script src="{{asset('assets/js/datatable.js')}}"></script>

<script>
    var $table = $('#profile_list_table');
    $table.bootstrapTable({
        toolbar: '#toolbar'
        , columns: [{}
            , {
                field: 'counter'
                , title: '#'
            }
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}
            , {}, 
            , {
                field: 'operate'
                , title: 'View Details'
                , align: 'center'
                , valign: 'middle'
                , clickToSelect: false
                , formatter: function(value, row, index) {
                    //return '<input name="elementname" value="'+value+'" />';
                    let url = "{{route('admin.submission.view', ['id' => ':queryId'])}}";
                    url = url.replace(':queryId', row.id);

                    // return '<a href="' + url + '" class=\'btn btn-primary \' pageName="' + row.name + '" pageDetails="' + row.price + '">View Details</a> <a href="' + url + '" class=\'btn btn-primary \' pageName="' + row.name + '" pageDetails="' + row.price + '">View Details</a>';
                    return `<a href="${url}" class="btn btn-primary btn-sm" pageName="${row.name}" pageDetails="${row.price}">View Details</a> <button class="btn btn-danger btn-sm" id="removeSubmission" data-id="${row.id}" data-index="${index}">Delete</button>`
                }
            }
        ]
    });

    function ajaxRequest(params) {
        var url = "{{ route('submission-server-side') }}"
        $.get(url + '?' + $.param(params.data)).then(function(res) {
            params.success(res)
        })
    }

    window.tableFilterStripHtml = function(value) {
        return value.replace(/<[^>]+>/g, '').trim();
    }

    $(document).on('change', '.bt_filter', function(e) {
        let value = $(this).val();
        let field = $(this).data("field");

        let arr = {};
        $('.bt_filter').each(function(index, element) {
            if ($(element).val()) {
                arr[$(element).data('field')] = $(element).val();
            }
        })

        let data = {
            filter: JSON.stringify({
                // [field]: value
                field: arr
            })
        }

        var url = "{{ route('submission-server-side') }}"
        $.ajax({
            method: 'GET'
            , dataType: 'json'
            , url: url + "?" + $.param(data)
            , success: function(response) {
                $table.bootstrapTable('load', response);
            }
        });
    })

    $(".university").select2({
        tags: true
    , });
    $(".degree").select2({
        tags: true
    , });
    $(".location").select2();
    $(".industry").select2();
    $(".job_type").select2();

    $(function() {
        $('#toolbar').find('select').change(function() {
            $table.bootstrapTable('destroy').bootstrapTable({
                exportDataType: $(this).val()
                , exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf']
                , columns: [{
                        field: 'state'
                        , checkbox: true
                        , visible: $(this).val() === 'selected'
                    }
                    , {
                        field: 'counter'
                        , title: '#'
                    }
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}
                    , {}, 
                    , {
                        field: 'operate'
                        , title: 'View Details'
                        , align: 'center'
                        , valign: 'middle'
                        , clickToSelect: false
                        , formatter: function(value, row, index) {
                            //return '<input name="elementname" value="'+value+'" />';
                            let url = "{{route('admin.submission.view', ['id' => ':queryId'])}}";
                            url = url.replace(':queryId', row.id);
                            // return '<a href="' + url + '" class=\'btn btn-primary \' pageName="' + row.name + '" pageDetails="' + row.price + '">View Details</a> ';
                            return `<a href="${url}" class="btn btn-primary btn-sm" pageName="${row.name}" pageDetails="${row.price}">View Details</a> <button class="btn btn-danger btn-sm" id="removeSubmission" data-id="${row.id}" data-index="${index}">Delete</button>`
                        }
                    }
                ]

            })
        }).trigger('change')
    })
    $(document).on('click', '#removeSubmission', function(e) {
        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let submissionId = $('#removeSubmission').data('id');
                
                let deleteUrl = "{{route('admin.submission.destroy', ['id' => ':queryId'])}}";
                deleteUrl = deleteUrl.replace(':queryId', submissionId);
                $.ajax({
                    url: deleteUrl
                    , type: 'GET',
                    // data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $table.bootstrapTable('removeByUniqueId', submissionId);
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
                                , title: response.message
                            });

                        }

                    }
                    , error: function(errorResponse) {
                        console.log(errorResponse);
                    }
                });
            }
        })

    })

</script>

@endsection
