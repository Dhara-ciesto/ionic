@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Home @endslot
@slot('title') Dashboard @endslot
@endcomponent
@if(Auth::user()->id == 1)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2>Welcome</h2>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endif
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        @if(Auth::user()->id == 1)
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium"><a href="{{ route('product.index') }}">Total Products </a></p>
                                <h4 class="mb-0">{{$data['products']}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="table-responsive">
                        <table>

                        </table>
                        <table class="table mb-0" id="user_table" data-unique-id="id" data-toggle="table"
                            data-ajax="ajaxRequest" data-side-pagination="server" data-pagination="true"
                            data-total-field="count" data-data-field="items" data-show-columns="true"
                            data-show-toggle="false" data-filter-control="true" data-filter-control-container="#filters"
                            data-show-columns-toggle-all="true">
                            <div id="filters" class="row bootstrap-table-filter-control">

                            </div>
                            <thead>
                                <tr>
                                    <th data-field="counter" data-sortable="true">#</th>
                                    {{-- <th data-field="product_brand.name" data-filter-control="select" data-sortable="true">Brand </th> --}}
                                    <th data-field="buyer_name" data-formatter="nameFormatter" data-filter-control="input" data-sortable="true">Buyer Name
                                    </th>

                                    {{-- <th data-field="transport_name" data-filter-control="select" data-sortable="true">
                                        Transport name </th> --}}
                                    {{-- <th data-field="car_no" data-filter-control="select" data-sortable="true">Car No. </th> --}}
                                    {{-- <th data-field="created_at" data-filter-control="select" data-sortable="true">Date</th> --}}
                                    {{-- <th data-field="qty" data-filter-control="input" data-sortable="true">Quantity </th> --}}
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
                    @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end col -->


</div>
<!-- end row -->

{{-- @endsection --}}
@section('script')
<!-- apexcharts -->
{{-- <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
<!-- blog dashboard init -->
{{-- <script src="{{ URL::asset('/assets/js/pages/dashboard-blog.init.js') }}"></script> --}}
@endsection

@endsection

@push('js')

<!-- Responsive Table js -->
{{-- <script src="{{ URL::asset('/assets/libs/rwd-table/rwd-table.min.js') }}"></script> --}}

<!-- Init js -->
{{-- <script src="{{ URL::asset('/assets/js/pages/table-responsive.init.js') }}"></script> --}}

<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">


<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js">
</script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('assets/js/datatable.js')}}"></script>


    <script>
        function nameFormatter(value, row, index) {
            var data = '<b>Buyer Name: </b>'+ value + "<br><b>Village Name: </b>" + row.village_name + '<br><b>Date: </b>'  +row.created_at;
             return data;
        }
        let $table = $('#user_table');
        $table.bootstrapTable({
            columns: [{}, {},  {
                field: 'operate',
                sortable: 'false',
                title: 'Action',
                align: 'center',
                valign: 'middle',
                clickToSelect: false,
                formatter: function(value, row, index) {
                    let url = "{{ route('order.edit', ['id' => ':queryId']) }}";
                    url = url.replace(':queryId', row.id);
                    let show_url = "{{ route('order.print', ['id' => ':queryId']) }}";
                    show_url = show_url.replace(':queryId', row.id);
                    let status = row.status == 'Active' ? 'Deactive' : 'Active';
                    var class_name = row.status == 'Active' ? 'btn-outline-danger' :
                        'btn-outline-primary';
                    // <a href="${show_url}" class="btn btn-sm btn-outline-info">View</a>&nbsp;
                    let action =
                        `<a href="${show_url}" target="_blank" class="btn btn-sm btn-outline-info"><i class="fa fa-print"></i></a>`;
                    return action;
                }
            }]
        });


        function ajaxRequest(params) {
            var url = "{{ route('order.server_side') }}"
            $.get(url + '?' + $.param(params.data)).then(function(res) {
                params.success(res)
            })
        }
        </script>
@endpush
