@extends('layouts.master')
@section('title') Submission Detail @endsection


@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Submission Details @endslot
@endcomponent
<div class="row">
    <div class="col-md-12">
        <a href="{{route('admin.submission.edit', ['id' => $submission->id])}}" class="btn btn-primary float-end">{{__('Edit Details')}}</a>
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
                            <img src="{{ asset('/images/dp.png') }}" alt="" srcset="" class="w-100">
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class=" profile-user-wid mb-4 text-center">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal">

                                <img src="{{ asset('/images/dp.png') }}" alt="" class="img-thumbnail rounded-circle avatar-md">
                            </a>
                        </div>
                        {{-- <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> --}}
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>{{ $submission->full_name ? $submission->full_name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail :</th>
                                        <td>{{ $submission->email ? $submission->email : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone :</th>
                                        <td>{{ $submission->contact_number ? $submission->contact_number : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Client ID :</th>
                                        <td>{{ $submission->client_id ? $submission->client_id : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Role :</th>
                                        <td>{{ $submission->role ? $submission->role : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">City :</th>
                                        <td>{{ $submission->city_obj ? $submission->city_obj->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">State :</th>
                                        <td>{{ $submission->state_obj ? $submission->state_obj->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Country :</th>
                                        <td>{{ $submission->country_obj ? $submission->country_obj->name : '' }}</td>
                                    </tr>
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


        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Resume or Other Documents</h4>
                <a href="{{ route('submission.zip-download',['id'=> $submission->id]) }}" class="btn btn-primary buttons-zip">Download all files <i class="fas fa-file-download"></i></a>
                @if($submission->resume_or_other_documents)
                <div class="table-responsive">
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Resume</th>
                                <th>Other Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (json_decode($submission->resume_or_other_documents) as $item)
                                <tr>
                                    <td>
                                        @if($item->resume)
                                        <a href="{{asset($item->resume)}}" target="_blank">Link to Resume</a>
                                        @endif
                                    </td>
                                    <td>{{$item->other_documents ? $item->other_documents : ''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                @if($submission->candidate_status && $submission->candidate_status == 'c2c')
                    <h4 class="card-title mb-4">C2C</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Rate</th>
                                    <th>Employer Name</th>
                                    <th>Employer Email</th>
                                    <th>Employer Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$submission->c2c_rate ? $submission->c2c_rate : ''}}</td>
                                    <td>{{$submission->c2c_employer_name ? $submission->c2c_employer_name : ''}}</td>
                                    <td>{{$submission->c2c_employer_email ? $submission->c2c_employer_email : ''}}</td>
                                    <td>{{$submission->c2c_employer_contact ? $submission->c2c_employer_contact : ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="card-title mb-4">W2</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$submission->w2_rate ? $submission->w2_rate : ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Clients</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Manager</th>
                                <th>Recruiter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$submission->client ? $submission->client->name : ''}}</td>
                                <td>{{$submission->manager ? $submission->manager->name : ''}}</td>
                                <td>{{$submission->recruiter ? $submission->recruiter->name : ''}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Other</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Client Manager Name</th>
                                <th>End Client Name</th>
                                <th>Submission To Client Rate</th>
                                <th>Update By Acestack Manager</th>
                                <th>Update From Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- <td>{{$submission->client_name ? $submission->client_name : ''}}</td> --}}
                                <td>{{$submission->client_manager_name ? $submission->client_manager_name : ''}}</td>
                                <td>{{$submission->end_client_name ? $submission->end_client_name : ''}}</td>
                                <td>{{$submission->submission_to_client_rate ? $submission->submission_to_client_rate : ''}}</td>
                                <td>{{$submission->update_by_acestack_manager ? $submission->update_by_acestack_manager : ''}}</td>
                                <td>{{$submission->update_from_client ? $submission->update_from_client : ''}}</td>
                            </tr>
                        </tbody>
                    </table>
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
