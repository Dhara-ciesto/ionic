@extends('layouts.master')

@section('title')
    Media Management
@endsection

@section('content')
    <style type="text/css">
        .required_sign {
            color: red !important;
        }

        .rounded {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border: 3px solid transparent;
            box-shadow: 0 0 4px #ccc;
        }

        .delete-link {
            float: right;
            color: red;
        }

        .image-checkbox-checked {
            position: relative;
            border-color: #73007d;
        }
    </style>
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
        Media Management
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('media.create') }}" role="button"
                        style="float: right;position: inherit;">Add new media</a>
                    <button class="btn btn-primary waves-effect waves-light delete_all" onclick="delete_all()"
                        data-url="{{ route('media.destroy.selected') }}"
                        style="float: right;margin-right: 10px;">Delete All Selected</button>
                </div>
            </div>
            <br>
            <div class="row">
                @foreach ($medias as $key => $media)
                    <div class="col-md-2 col-xl-2">
                        <!-- Simple card -->
                        <div class="card">
                            <a href="javascript: void(0);">
                                <input class="sub_chk form-check-input" type="checkbox" id="image_check_box_{{  $media->id }}"
                                    data-id="{{  $media->id }}" style="margin: 9px;position: absolute;height: 20px;width: 20px;">
                                <img class="rounded" src="{{ asset($media->image) }}"
                                    alt="Card image cap" onerror="this.onerror=null;this.src='{{ asset("/images/placeholder.png") }}'" >
                            </a>
                            <div class="card-body">
                                <a href="javascript: void(0);" class="card-link copy-link"
                                    data-text="{{ asset($media->image) }}">Copy URL</a>
                                <a href="javascript: void(0);" class="card-link delete-link" onclick="remove('{{ $media->id}}','{{ $key}}')" title="Delete">Delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> <!-- end col -->
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
        //media managment image copy image link
        $('.copy-link').on('click', function(e) {
            e.preventDefault();
            var copyText = $(this).attr('data-text');

            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
            Toast.fire({
                icon: 'info',
                title: 'Image url copied successfully..!'
            });
            // toastr.info("Image url copy successfully..!");
        });
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
                            url: $('.delete_all').data('url'),
                            type: 'GET',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function(data, textStatus, jqXHR) {
                                if (data['success']) {
                                    location.reload();
                                    // $table.bootstrapTable('refresh');
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
                                console.log(data);
                                alert('Whoops Something went wrong!!');
                            }
                        });
                    }
                }
            })

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
                    let url = "{{ route('media.destroy', ['id' => ':queryId']) }}";
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
                                location.reload();
                                // $table.bootstrapTable('removeByUniqueId', id);
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
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('success') }}"
            });
        </script>
    @endif
@endsection
