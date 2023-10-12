@extends('layouts.master')
@section('title')
    Order
@endsection


@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Order Details
        @endslot
    @endcomponent
    <style>
        .dlabel {
            margin-bottom: 0px !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-start">
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Business Name :</th>
                                        <td>{{ $order->orderBy->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Orders :</th>
                                        <td>{{ count($orders) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Order In Processing :</th>
                                        <td>{{ count($orders->where('status', 'Processing')) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dispatched Orders :</th>
                                        <td>{{ count($orders->where('status', 'Dispatched')) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($orders as $key => $order)
        <div class="row">
            <div class="col-xl-4">
                <div class="card shadow-lg p-3 bg-body rounded">
                    <div class="bg-white bg-soft">

                    </div>


                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Date :</th>
                                                <td>{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Order :</th>
                                                <td>{{ $order->uid }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status :</th>
                                                <td>{{ $order->status }}</td>
                                            </tr>
                                            @if ($order->status == 'Processing')
                                                <tr>
                                                    <td colspan="2" style="text-align: end;"><button
                                                            class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                                            onclick="setOrderId({{ $order->id }})"
                                                            data-bs-target="#exampleModal">Dispatch</button></td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="2" style="text-align: end;">
                                                        <button onClick="remove({{ $order->id }}, {{ $key }})"
                                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body shadow-lg p-3 bg-body rounded">
                        {{-- <h4 class="card-title mb-4">Details</h4> --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-nowrap mb-0  ">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="row">No. </th>
                                                <th scope="row">Product </th>
                                                <th scope="row">Total Cartoon </th>
                                                <th scope="row">Dispatched Cartoon </th>
                                                <th scope="row">Pending Cartoon </th>
                                                {{-- <th scope="row">Total Qty </th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->products as $pkey => $product)
                                                {{-- {{ dd($product->dispatch_product) }} --}}
                                                <tr @if ($product->status == 'Dispatched')  style="text-decoration: line-through;" @endif>
                                                    <td>{{ $pkey + 1 }}</td>
                                                    <td>{{ $product->product->product_name }}</td>
                                                    <td>{{ $product->cartoon }}</td>
                                                    {{-- <td>{{ $product->qty }}</td> --}}
                                                    <td>{{ $product->dispatch_product->sum('cartoon') }}</td>
                                                    <td>{{ $product->cartoon - $product->dispatch_product->sum('cartoon') }}
                                                    </td>
                                                </tr>
                                                @foreach ($product->dispatch_product as $dorder)
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>{{ $dorder->cartoon }}</td>
                                                        {{-- <td>{{ $dorder->qty }}</td> --}}
                                                        <td><b>LR Number : </b> {{ $dorder->lr_no }}</td>
                                                        <td>@if($dorder->receipt_image)<a href="{{ asset($dorder->receipt_image) }}"
                                                                target="_blank"><i class="fa fa-eye"></i></a>@endif</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Notes</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for="price" class="form-label"><b>Fragrance Top Note:</b></label>
                        <P>{{$product->fragrance_top_note}}</P>
                    </div>
                    <div class="col-md-4">
                        <label for="price" class="form-label"><b>Fragrance Middle Note:</b></label>
                        <P>{{$product->fragrance_middle_note}}</P>
                    </div>
                    <div class="col-md-4">
                        <label for="price" class="form-label"><b>Fragrance Base Note:</b></label>
                        <P>{{$product->fragrance_base_note}}</P>
                    </div>
                </div>
            </div>
        </div> --}}
            </div>
        </div>
    @endforeach
    <!-- end row -->

    <!--  Update Profile example -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="profile_form" action="{{ route('order.dispatch') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Dispatch Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body" id="product_div">

                                {{-- <div class="row mb-2">
                                    <div class="col-lg-9" id="">

                                            <label class="dlabel" style="margin-left: 10px;">
                                                <input type="checkbox" class="mt-2 prod_checkbox" value="2"
                                                    name="product[0][product_id]">&nbsp;product 1
                                            </label>
                                            <br>
                                        <span class="font-size-10 ms-4" style="margin-top: -20px;">Total order cartoon :
                                            2</span>
                                    </div>
                                    <div class="col-lg-3" id="">
                                        <input type="number" value="" name="product[0][cartoon]"
                                            class="form-control form-control-color" min="1">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-9" id="">
                                        <label class="dlabel" style="margin-left: 10px;">
                                            <input type="checkbox" class="mt-2 prod_checkbox" value="2"
                                                name="product[1][product_id]">&nbsp;product 2
                                        </label>
                                        <br>
                                        <span class="font-size-10 ms-4" style="margin-top: -20px;">Total order cartoon :
                                            2</span>
                                    </div>
                                    <div class="col-lg-3" id="">
                                        <input type="number" value="" name="product[1][cartoon]"
                                            class="form-control form-control-color" min="1">
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row mt-2 ms-2">
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <input type="hidden" name="order_id" id="order_id" value="">
                                        <label for="brand_name">LR Number<span class="error">*</span></label>
                                        <input id="lr_no" name="lr_no" type="text" value="{{ old('lr_no') }}"
                                            class="form-control" placeholder="LR Number">
                                        @error('lr_no')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Receipt Image</label>
                                        <input id="receipt_image" type="file" name="receipt_image" class="form-control"
                                            placeholder="Campaign">{{ old('receipt_image') }}</textarea>
                                        <small>File size maximum limit 5 MB.</small>
                                        @error('receipt_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <br><span id="old_image"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit_btn"class="btn btn-outline-success">Submit</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                            id="close_order_dtls">Cancel</button>

                    </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <!-- jquery step -->
    <script src="{{ URL::asset('/assets/libs/jquery-steps/jquery-steps.min.js') }}"></script>

    <!-- form wizard init -->
    <script src="{{ URL::asset('/assets/js/pages/form-wizard.init.js') }}"></script>
    <!-- form repeater js -->
    <script src="{{ URL::asset('assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/form-repeater.int.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
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
                    let url = "{{ route('order.destroy', ['id' => ':queryId']) }}";
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

        function dotToArray(str) {
            var output = '';
            var chucks = str.split('.');
            if (chucks.length > 1) {
                for (i = 0; i < chucks.length; i++) {
                    if (i == 0) {
                        output = chucks[i];
                    } else {
                        output += '[' + chucks[i] + ']';
                    }
                }
            } else {
                output = chucks[0];
            }
            return output
        }

        function setOrderId(order_id) {
            $('#order_id').val(order_id);
            $('#product_div').html('');
            var img =
                `<div class="card-header row mb-2"><div class="col-lg-9">Product</div><div class="col-lg-3" id="">Cartoon</div></div>`;
            $.ajax({
                url: '{{ route('order.getOrder') }}',
                type: "get",
                data: {
                    'order_id': order_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#submit_btn').prop('disabled', true)
                    $('#submit_btn').text('Loading...')
                },
                success: function(data, textStatus, jqXHR) {
                    $('#submit_btn').prop('disabled', false)
                    $('#submit_btn').text('Submit')
                    if (data.success) {
                        var res = data.data;
                        console.log(res);
                        for (i = 0; i < res.length; ++i) {
                            // do something with `substr[i]`
                            img +=
                                `<div class="row mb-2">
                                            <div class="col-lg-9 col-sm-9" id="">
                                                <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                            <input class="form-check-input prod_checkbox" type="checkbox" value="` + res[i].product_id + `"
                                                            name="product[` + i + `][product_id]">&nbsp;&nbsp;` + res[i].product.product_name + `
                                                            <br>
                                                            <span class="font-size-10" style="margin-top: -20px;color: black;">Total order cartoon :
                                                    ` + res[i].cartoon + `</span><br>
                                                            <span class="font-size-10" style="margin-top: -20px;color: black;">Size : ` + res[i].product.size + `</span><br>
                                                            <span class="font-size-10" style="margin-top: -20px;color: black;">Finish : ` + res[i].product.finish + `</span>

                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-3" id=""><input type="hidden" name="product[` + i +`][total_cartoon]" value="` + (res[i].cartoon) + `">
                                                <input type="number" value="` + (res[i].cartoon - res[i].dispatch_count) + `" name="product[` + i + `][cartoon]"
                                                    class="form-control w-50" max="` + (res[i].cartoon - res[i].dispatch_count) + `" min="1">
                                            </div>
                                        </div>`;
                        }
                        // console.log(value.product_id);
                        // var k=0;
                        // $.each(res.products[key], function (i, j) {
                        // console.log(key + value);

                        // });


                        $('#product_div').html(img);
                    } else {
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
                            icon: 'warning',
                            title: data.message
                        });
                        location.reload();

                    }

                }
            });


        }
        $(".prod_checkbox").on('change', function() {
            // console.log($(this).parent().parent());
            console.log($(this).parent().parent().parent().find("input[name='product[cartoon][]']").length);
            if (this.checked) {
                // $("#input").attr('required', true);
                $(this).parent().parent().parent().find("input[name='product[cartoon][]']").attr('required', true);
            } else {
                // $("#input").attr('required', false);
                $(this).parent().parent().parent().find("input[name='product[cartoon][]']").attr('required', false);

            }
        });
        $(document).find("#profile_form").validate({
            errorPlacement: function(error, element) {
                console.log(error);
                error.insertAfter(element);
            },

            rules: {
                order_id: "required",
                // 'cartoon[]': {
                //     required: function(element){
                //         return $("#document_title").val()!="";
                //     }
                // }
                // lr_no: "required",
                // receipt_image: "required",
            },
            submitHandler: function(formd) {
                let form = $('#profile_form')[0];
                let form_data = new FormData(form);
                let submissionId = $('#submissionId').val();
                let url = "{{ route('order.dispatch') }}";
                url = url.replace(':queryId', submissionId);

                $.ajax({
                    url: url,
                    type: "post",
                    contentType: false,
                    processData: false,
                    // data: $('#profile_form').serialize(),
                    data: form_data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#submit_btn').prop('disabled', true)
                        $('#submit_btn').text('Loading...')
                    },
                    success: function(data, textStatus, jqXHR) {
                        $('#submit_btn').prop('disabled', false)
                        $('#submit_btn').text('Submit')
                        if (data.success) {
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
                            $('#profile_form')[0].reset();
                            setTimeout(() => {
                                location.reload()
                            }, 2000);
                            // $('#form_section').addClass('d-none');
                            // $('#complete_section').removeClass('d-none');
                        } else {
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
                                icon: 'warning',
                                title: data.message
                            });

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#submit_btn').prop('disabled', false)
                        $('#submit_btn').text('Submit')

                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            $('.lara_error').remove(); // remove old errors
                            // console.log(jqXHR.responseJSON.errors);
                            $.each(jqXHR.responseJSON.errors, function(element, errorMessage) {
                                console.log(element);
                                element = dotToArray(element);
                                console.log(element);
                                if (element == 'product[product_id]') {
                                    element = 'product' + '[0]' + '[product_id]';
                                }

                                $("input[name='" + element + "']").next('span')
                                    .remove();
                                $("select[name='" + element + "']").next('span')
                                    .remove();
                                let spanEl = document.createElement('span')
                                if (element == 'product') {
                                    $(spanEl).addClass('text-danger lara_error').text(
                                            errorMessage)
                                        .insertAfter($(".prod_checkbox").last().parent()
                                            .parent().parent());
                                    $(spanEl).addClass('text-danger').text(errorMessage)
                                        .insertAfter($(".prod_checkbox").last().parent()
                                            .parent().parent());
                                    // $(spanEl).insertAfter($('[id^="NextElement"]').last());
                                } else {

                                    $(spanEl).addClass('text-danger lara_error').text(
                                            errorMessage)
                                        .insertAfter($("input[name='" + element + "']"))
                                    $(spanEl).addClass('text-danger').text(errorMessage)
                                        .insertAfter($(
                                            "select[name='" + element + "']"))
                                }
                            });
                            $('html, body').animate({
                                scrollTop: $(".lara_error").offset().top - 150
                            }, 1);
                        }

                        // $("#profile_form_step-t-0").click();
                    }
                });

            }
        });
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
            })
        </script>
    @endif
    @if (Session::has('error'))
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
                icon: 'warning',
                title: "{{ Session::get('error') }}"
            })
        </script>
    @endif
@endpush
