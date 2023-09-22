@extends('layouts.master')
@section('title') Product @endsection


@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Product Details @endslot
@endcomponent
<div class="row">
    <div class="col-md-12">
        <a href="{{route('product.edit', ['id' => $product->id])}}" class="btn btn-outline-danger float-end">{{__('Edit Details')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-white bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            {{-- <p>It will seem like simplified</p> --}}
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        {{-- <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid"> --}}
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            @if($product->file)
                            <img src="{{ asset($product->file) }}" alt="" class="w-100">
                        @else
                            <img src="{{ asset('/images/dp.png') }}" alt="" class="w-100">
                        @endif
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class=" profile-user-wid mb-4 text-center">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                                @if($product->file)
                                    <img src="{{ asset($product->file) }}" alt="" class="img-fluid" style="min-height: 300px;min-width:200px;" >
                                @else
                                    <img src="{{ asset('/images/dp.png') }}" alt="" class="img-thumbnail">
                                @endif
                            </a>
                        </div>
                        {{-- <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> --}}
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <td><b>{{ $product->product_name ? $product->product_name : '' }}</b></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Brand :</th>
                                        <td>{{ $product->product_brand ? $product->product_brand->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Scent Type :</th>
                                        <td>{{ $product->scent_type->name ? $product->scent_type->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fragrance Tone 1 :</th>
                                        <td>{{ $product->fragrance_tone_1->name ? $product->fragrance_tone_1->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fragrance Tone 2 :</th>
                                        <td>{{ $product->fragrance_tone_2 ? $product->fragrance_tone_2->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Size:</th>
                                        <td>{{ $product->size ? $product->size.$product->size_unit->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Campaign :</th>
                                        <td>{{ $product->campaign ? $product->campaign->name : '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <h4 class="card-title mb-4">CV</h4> --}}
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Details</h4>
                <div class="row">
                    <div class="col-md-3">
                        <label for="price" class="form-label"><b>Price:</b></label>
                        <P>{{$product->price}}</P>
                    </div>  
                    <div class="col-md-3">
                        <label for="price" class="form-label"><b>URL:</b></label>
                        <P><a href="{{$product->url}}">{{$product->url}}</a></P>
                    </div>  
                    <div class="col-md-3">
                        <label for="price" class="form-label"><b>Occasion:</b></label>
                        <P>{{$product->occasion}}</P>
                    </div>  
                    <div class="col-md-3">
                        <label for="price" class="form-label"><b>Gender:</b></label>
                        <P>{{$product->gender}}</P>
                    </div>      
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Other</h4>
                <div class="row">
                    <div class="col-md-4">
                        <label for="price" class="form-label"><b>Fragrance Description:</b></label>
                        <P>{{$product->fragrance_description}}</P>
                    </div>  
                    <div class="col-md-4">
                        <label for="price" class="form-label"><b>Status:</b></label>
                        <P>{{$product->status}}</P>
                    </div>  
                    <div class="col-md-4">
                        <label for="price" class="form-label"><b>Photo:</b></label>
                        <P><a href="{{ asset($product->file)}}">Download Image</a></P>
                    </div>      
                </div>
            </div>
        </div>
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
        </div>
    </div>
</div>
<!-- end row -->

<!--  Update Profile example -->
<div class="modal fade update-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="update-profile">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
                    <div class="mb-3">
                        <label for="useremail" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" value="{{ Auth::user()->email }}" name="email" placeholder="Enter email" autofocus>
                        <div class="text-danger" id="emailError" data-ajax-feedback="email"></div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" id="username" name="name" autofocus placeholder="Enter username">
                        <div class="text-danger" id="nameError" data-ajax-feedback="name"></div>
                    </div>

                    <div class="mb-3">
                        <label for="userdob">Date of Birth</label>
                        <div class="input-group" id="datepicker1">
                            <input type="text" class="form-control @error('dob') is-invalid @enderror" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-date-end-date="0d" value="{{ date('d-m-Y', strtotime(Auth::user()->dob)) }}" data-provide="datepicker" name="dob" autofocus id="dob">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                        <div class="text-danger" id="dobError" data-ajax-feedback="dob"></div>
                    </div>

                    <div class="mb-3">
                        <label for="avatar">Profile Picture</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" autofocus>
                            <label class="input-group-text" for="avatar">Upload</label>
                        </div>
                        <div class="text-start mt-2">
                            <img src="{{ asset(Auth::user()->avatar) }}" alt="" class="rounded-circle avatar-lg">
                        </div>
                        <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light UpdateProfile" data-id="{{ Auth::user()->id }}" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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
    })

</script>
@endif
@if(Session::has('error'))
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
        icon: 'warning'
        , title: "{{Session::get('error')}}"
    })

</script>
@endif
@endpush
