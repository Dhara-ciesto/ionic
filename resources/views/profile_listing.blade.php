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
                        <div class="row">
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select class="form-select bt_filter university" id="university" data-field="university">
                                            <option value="">University</option>
                                            {{-- @foreach($data as $key => $value)
                                            @php
                                            $universityArray = [];
                                            @endphp
                                            @foreach (json_decode($value->university) as $item)
                                            @php
                                            $universityArray[] = $item->university;
                                            @endphp
                                            @endforeach
                                            <option value="{{implode(',', $universityArray)}}">{{implode(',', $universityArray)}}</option>
                                            @endforeach --}}
                                            @foreach ($universities as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select bt_filter degree" data-field="university">
                                            <option value="">Degree</option>
                                            {{-- @foreach($data as $key => $value)
                                            @php
                                            $degreeArray = [];
                                            @endphp
                                            @foreach (json_decode($value->university) as $item)
                                            @php
                                            $degreeArray[] = $item->degree;
                                            @endphp
                                            @endforeach
                                            <option value="{{implode(',', $degreeArray)}}">{{implode(',', $degreeArray)}}</option>
                                            @endforeach --}}
                                            @foreach($university_courses as $key => $value)
                                                <option value="{{$value->name}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select bt_filter location" data-field="roles">
                                            <option value="">Location</option>
                                            {{-- @foreach($data as $key => $value)
                                            @php
                                            $location = [];
                                            @endphp
                                            @foreach (json_decode($value->roles) as $item)
                                            @php
                                            $location[] = $item->city
                                            @endphp
                                            @endforeach
                                            <option value="{{implode(',', $location)}}">{{implode(',', $location)}}</option>
                                            @endforeach --}}
                                            @foreach ($cities as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select bt_filter industry" data-field="roles">
                                            <option value="">Industry</option>
                                            {{-- @foreach($data as $key => $value)
                                            @php
                                            $industryArray = [];
                                            @endphp
                                            @foreach (json_decode($value->roles) as $item)
                                            @php
                                            $industryArray[] = $item->industry
                                            @endphp
                                            <option value="{{implode(',', $industryArray)}}">{{implode(',', $industryArray)}}</option>
                                            @endforeach
                                            @endforeach --}}
                                            @foreach ($industries as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select bt_filter job_type" data-field="roles">
                                            <option value="">Job Type</option>
                                            {{-- @foreach($data as $key => $value)
                                            @php
                                            $jobTypeArray = [];
                                            @endphp
                                            @foreach (json_decode($value->roles) as $item)
                                            @php
                                            $jobTypeArray[] = $item->job_type;
                                            @endphp
                                            <option value="{{implode(',', $jobTypeArray)}}">{{implode(',', $jobTypeArray)}}</option>
                                            @endforeach
                                            @endforeach --}}
                                            
                                            <option value="Part-Time" >Part-Time</option>
                                            <option value="Full-Time" >Full-Time</option>
                                            <option value="Internship" >Internship</option>
                                            <option value="Graduate Scheme" >Graduate Scheme</option>
                                            <option value="Temporary" >Temporary</option>
                                            <option value="Contract" >Contract</option>
                                            <option value="Apprenticeship" >Apprenticeship</option>
                                            <option value="Volunteer" >Volunteer</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select bt_filter" data-field="cv">
                                            <option value="">CV Attached</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(Auth::user()->role == 1)
                                        <a href="{{route('dashboard.export')}}" class="btn btn-primary float-end mx-1">{{__('Export')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        {{-- <table id="profile_list_table" class="table table-striped" table-for="dashboard" data-ajax="ajaxRequest" data-filter-control="true" data-show-search-clear-button="false" data-side-pagination="server" data-pagination="true" data-sortable="true" data-toggle="table" data-show-columns="true" data-show-toggle="false" data-show-export="true" data-show-columns-toggle-all="true" data-total-field="count" data-data-field="items"> --}}
                        <table id="profile_list_table" class="table table-striped" data-toolbar="#toolbar" data-toggle="table" data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true" data-total-field="count" data-data-field="items" data-show-columns="true" data-show-toggle="false" data-filter-control="true" data-show-columns-toggle-all="true" >
                            <thead>
                                <tr>
                                    <th data-field="name" data-filter-control="select" data-sortable="true">{{__('Full Name')}}</th>
                                    <th data-field="email" data-filter-control="input" data-sortable="true">{{__('Email')}}</th>
                                    <th data-field="university" data-filter-control="select" data-sortable="true">{{__('Degree Achieved')}}</th>
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
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var $table = $('#profile_list_table');
    $table.bootstrapTable({
        toolbar: '#toolbar'
        , columns: [{
                title: 'Full Name'
                , field: 'name'
            }, {
                title: 'Email'
                , field: 'email'
            }, {
                title: 'University'
                , field: 'university'
            }
            , {
                field: 'operate'
                , title: 'View Details'
                , align: 'center'
                , valign: 'middle'
                , clickToSelect: false
                , formatter: function(value, row, index) {
                    //return '<input name="elementname" value="'+value+'" />';
                    let url = "{{route('profile_view', ['id' => ':queryId'])}}";
                    url = url.replace(':queryId', row.id);
                    return '<a href="' + url + '" class=\'btn btn-primary \' pageName="' + row.name + '" pageDetails="' + row.price + '">View Details</a> ';
                }
            }
        ]
    });

    function ajaxRequest(params) {
        var url = "{{ route('bt-server-side') }}"
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

        var url = "{{ route('bt-server-side') }}"
        $.ajax({
            method: 'GET'
            , dataType: 'json'
            , url: url + "?" + $.param(data)
            , success: function(response) {
                $table.bootstrapTable('load', response);
            }
        });
    })

    // $(document).on('change', '.fht-cell .filter-control select', function(e) {
    //     let value = $(this).val();
    //     let field = $(this).parent().parent().parent().data("field");

    //     let arr = {};
    //     $('.fht-cell .filter-control select').each(function (index, element) {
    //         if($(element).val()) {
    //             arr[$(element).parent().parent().parent().data("field")] = $(element).val();
    //         }
    //     })
    //     let data = {
    //         filter: JSON.stringify({
    //             // [field]: value
    //             field: arr
    //         })
    //     }

    //     // var url = "{{ route('bt-server-side') }}"
    //     // $.ajax({
    //     //     method: 'GET',
    //     //     dataType: 'json'
    //     //     , url: url + "?" + $.param(data)
    //     //     , success: function(response) {
    //     //         $table.bootstrapTable('load', response);
    //     //     }
    //     // });

    //     console.log(arr);

    // })

    $(".university").select2({
        tags: true,
    });
    $(".degree").select2({
        tags: true,
    });
    $(".location").select2();
    $(".industry").select2();
    $(".job_type").select2();
</script>

@endsection
