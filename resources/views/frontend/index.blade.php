@extends('layouts.frontend.master')
@section('bodyid')
youbodyid
@endsection

@section('content')
<style>
    .card {
        border: 1px solid rgba(0,0,0,.125) !important;

    }
    /* .select2.select2-container.select2-container--default {
        width: 1%;
        flex: 1 1 auto;
    }

    .select2-container .select2-selection--single {
        border-radius: 30px;
        border-color: #7f7f7f;
        border-width: 2px;
        margin-left: -25px;
        text-indent: 30px;
    } */

    .hero-section2 {
        background: #fff2cc
    }

    .hero-section3 {
        background-image: linear-gradient(to right top, #fbb202, #fcbd16, #fdc724, #fed231, #ffdc3d);
        border-radius: 20px
    }

    .hero-title {
        font-size: 32px;
        color: #495057;
    }

    .section {
        position: relative;
        padding-top: 50px;
        padding-bottom: 15px;
    }

    .steps {
        display: none;
    }

    .attachedCV {
        display: flex;
        border: 1px solid grey;
    }

    .attachedCV div {
        padding: 10px;
        /* background: grey; */
        flex: 1;
        font-size: 15px;
    }

    .attachedCV .attachedFileName {
        background: rgb(207, 205, 205);
    }

    ul.working li {
        /* background: #7f7f7f; */
        border-radius: 70px;
        border: solid 3px gray;
        margin-bottom: 3px;
        padding-top: 5px;
        padding-bottom: 5px;
        list-style-type: none;
    }

    .work {
        justify-content: left;
        flex-direction: row;
        display: flex;
        align-items: center;
        padding: 0.1rem 0.5rem !important;
    }

    .work-number {
        justify-content: center;
        display: flex;
        align-self: auto;
        padding-top: 14.5px;
        min-height: 50px;
        min-width: 50px;
    }

    .work-heading {
        margin-left: 16px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: baseline;
    }

</style>
<section class="section  pt-10 hero-small-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-3 spacing-mlr">
                    <h1 class="fw-semibold hero-title animate__animated  animate__fadeInLeft">Connecting you to the best
                    </h1>
                    {{-- <img src="{{ URL::asset('/assets/images/logo2.png') }}" class="logo-lg-home" alt=""
                    height="150"> --}}
                </div>
            </div>
        </div>
        <div class="row align-items-center text-center p-5">
            <div class="col-lg-12">
                <p class="fs-5">Tira is dedicated to helping you find the perfect job. Tell us a bit
                    about yourself
                    and let the perfect job find you.</p>
                <p class="fs-5">Create your profile and allow Tira recruiters to contact
                    you directly, with roles that suit your educational background, interests and aspirations!</p>


            </div>

        </div>
        <!-- end row -->
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<section class="section pt-4 bg-white" id="about">
    <form id="profile_form" action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container">
            <div id="form_section_">

                <!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-3">
                            <h3>CREATE YOUR PROFILE</h3>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">FULL NAME</label>
                                            <input type="text" class="form-control" name="full_name" id="full_name" value="{{ old('full_name') }}" placeholder="Full Name">
                                            @error('full_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="client_id">Client ID</label>
                                            <input type="text" class="form-control" name="client_id" id="client_id" value="{{ old('client_id') }}" placeholder="Client ID">
                                            @error('client_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="role">Role</label>
                                            <input type="text" class="form-control" name="role" id="role" value="{{ old('role') }}" placeholder="Role">
                                            @error('role')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                                            @error('email')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" placeholder="Contact Number">
                                            @error('contact_number')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="country">Countries</label>
                                            <select class="form-select country" name="country" id="country">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="state">States</label>
                                            <select class="form-select state" name="state" id="state">
                                                <option value="">Select State</option>
                                            </select>
                                            @error('state')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="city">Cities</label>
                                            <select class="form-select city" name="city" id="city">
                                                <option value="">Select City</option>
                                            </select>
                                            @error('city')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="client_name">Client Name</label>
                                            <select class="form-select university" name="client_name">
                                                <option value="">Select Client Manager Name</option>
                                                @foreach($clients as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('client_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                            {{-- <input type="text" class="form-control" name="client_name" id="client_name" value="{{ old('client_name') }}" placeholder="Client Name">
                                            @error('client_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="end_client_name">End Client Name</label>
                                            <input type="text" class="form-control" name="end_client_name" id="end_client_name" value="{{ old('end_client_name') }}" placeholder="End Client Name">
                                            @error('end_client_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="submission_to_client_rate">Submission to client Rate</label>
                                            <input type="text" class="form-control" name="submission_to_client_rate" id="submission_to_client_rate" value="{{ old('submission_to_client_rate') }}" placeholder="Submission to client Rate">
                                            @error('submission_to_client_rate')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Client Manager Name</label>
                                            <input type="text" class="form-control" name="client_manager_name" id="client_manager_name" value="{{ old('client_manager_name') }}" placeholder="Client Name">
                                            @error('client_manager_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                            {{-- <select class="form-select university" name="client_manager_name">
                                                <option value="">Select Client Manager Name</option>
                                                @foreach($clients as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('client_manager_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Acestack Manager Name</label>
                                            <select class="form-select university" name="acestack_manager_name">
                                                <option value="">Select Acestack Manager Name</option>
                                                @foreach($managers as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('acestack_manager_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Recruiter Name</label>
                                            <select class="form-select university" name="recruiter_name">
                                                <option value="">Select Recruiter Name</option>
                                                @foreach($recruiters as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('recruiter_name')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Visa Status</label>
                                            <select class="form-select university" name="visa_status">
                                                <option value="">Select Visa Status</option>
                                            </select>
                                            @error('visa_status')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Update by Acestack Manager</label>
                                            <input type="text" class="form-control" name="update_by_acestack_manager" id="update_by_acestack_manager" value="{{ old('update_by_acestack_manager') }}" placeholder="Update by Acestack Manager">
                                            @error('update_by_acestack_manager')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Update from client</label>
                                            <select class="form-select university" name="update_from_client">
                                                <option value="">Select Update from client</option>
                                                <option value="No Update">No Update</option>
                                                <option value="Interview going on">Interview going on</option>
                                                <option value="Backout">Backout</option>
                                                <option value="Placed">Placed</option>
                                            </select>
                                            @error('update_from_client')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="candidate_status" id="candidate_status_w2" value="w2" checked>
                                                <label class="form-check-label" for="candidate_status_w2">W2</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="candidate_status" id="candidate_status_c2c" value="c2c">
                                                <label class="form-check-label" for="candidate_status_c2c">C2c</label>
                                            </div>

                                            @error('visa_status')
                                            <p class="error text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div id="container_w2" class="toHide">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Rate</label>
                                                <input type="text" class="form-control" name="w2_rate" id="w2_rate" value="{{ old('w2_rate') }}" placeholder="w2_Rate">
                                                @error('w2_rate')
                                                <p class="error text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="container_c2c" class="toHide" style="display:none">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Rate</label>
                                                <input type="text" class="form-control" name="c2c_rate" id="c2c_rate" value="{{ old('c2c_rate') }}" placeholder="Rate">
                                                @error('c2c_rate')
                                                <p class="error text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Employer Name</label>
                                                <input type="text" class="form-control" name="c2c_employer_name" id="c2c_employer_name" value="{{ old('c2c_employer_name') }}" placeholder="Employer Name">
                                                @error('c2c_employer_name')
                                                <p class="error text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Employer Email</label>
                                                <input type="text" class="form-control" name="c2c_employer_email" id="c2c_employer_email" value="{{ old('c2c_employer_email') }}" placeholder="Employer Email">
                                                @error('c2c_employer_email')
                                                <p class="error text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Employer Contact</label>
                                                <input type="text" class="form-control" name="c2c_employer_contact" id="c2c_employer_contact" value="{{ old('c2c_employer_contact') }}" placeholder="Employer Contact">
                                                @error('c2c_employer_contact')
                                                <p class="error text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="repeater ">
                                    <div data-repeater-list="group_a" class="outer">
                                        <div data-repeater-item class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Resume</label>
                                                        <input class="form-control" type="file" name="resume" id="resume">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Other Documents</label>
                                                    <input type="text" class="form-control" name="other_documents" id="other_documents" value="{{ old('other_documents') }}" placeholder="Other documents">
                                                    @error('other_documents')
                                                    <p class="error text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 delete d-none my-3">
                                                <span data-repeater-delete class="float-end" type="button"><i class='bx bxs-trash-alt bx-xs error'></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-end">
                                            <button data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0"><i class='bx bx-plus'></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 offset-1 text-end">
                    <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                </div>
            </div>
        </div>

        
        <div class="row align-items-center d-none" id="complete_section">
            <section>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="mdi mdi-check-circle-outline text-warning display-4"></i>
                            </div>
                            <div>
                                <h5>Congratulations!</h5>
                                {{-- <p class="text-muted">If several languages coalesce, the grammar of the resulting
                                </p> --}}
                                <p class="text-muted">YOU ARE ON YOUR WAY TO FINDING YOUR DREAM JOB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        </div>
        <!-- end container -->
    </form>
</section>
<!-- about section end -->
@endsection
@push('js')
<!-- jquery step -->
{{-- <script src="{{ URL::asset('/assets/libs/jquery-steps/jquery-steps.min.js') }}"></script> --}}

<!-- form wizard init -->
{{-- <script src="{{ URL::asset('/assets/js/pages/form-wizard.init.js') }}"></script> --}}
<!-- form repeater js -->
<script src="{{ URL::asset('assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/pages/form-repeater.int.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        var errors = $('.is-invalid')
        if (errors.length) {
            $(document).scrollTop(errors.offset().top)
        }
    });

    let errors = @json($errors -> messages());
    setTimeout(() => {
        console.log(errors);
        $.each(errors, function(index, error) {
            element = dotToArray(index);
            let spanEl = document.createElement('span')
            $(spanEl).addClass('text-danger').text(error).insertAfter($("input[name='" + element + "']")
                .parent())
            $(spanEl).addClass('text-danger').text(error).insertAfter($("select[name='" + element +
                "']").parent())

        });

    }, 500);

    $(document).on('click', '.formFile', function(e) {
        $('#'.id).trigger('click');

    });

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

    $("#profile_form").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent("div"));
        },

        rules: {
            client_id: "required"
            , role: "required"
            , full_name: "required",
            // current_location: "required",
            contact_number: "required"
            , email: {
                required: true
                , email: true
            },
            country: "required",
            state: "required",
            city: "required",
            // visa_status: "required",
            w2_rate: {
                required: function(element) {
                    return $('#candidate_status_w2').val() != ""
                }
            },
            // c2c_employer_name: "required",
            // c2c_employer_email: "required",
            // c2c_employer_contact: "required",
            client_name: "required"
            , end_client_name: "required"
            , submission_to_client_rate: "required"
            , client_manager_name: "required"
            , acestack_manager_name: "required"
            , recruiter_name: "required"
            , update_by_acestack_manager: "required"
            , update_from_client: "required"
        , }
        , submitHandler: function(formd) {
            let form = $('#profile_form')[0];
            let form_data = new FormData(form);
            $.ajax({
                url: '{{ route('submission.store') }}'
                , type: "post"
                , contentType: false
                , processData: false,
                // data: $('#profile_form').serialize(),
                data: form_data
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , beforeSend: function() {
                    $('#submit_btn').prop('disabled', true)
                    $('#submit_btn').text('Loading...')
                }
                , success: function(data, textStatus, jqXHR) {
                    $('#submit_btn').prop('disabled', false)
                    $('#submit_btn').text('Submit')

                    if (data.success) {
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
                        $('#profile_form')[0].reset();

                        $('#form_section').addClass('d-none');
                        $('#complete_section').removeClass('d-none');
                    }
                }
                , error: function(jqXHR, textStatus, errorThrown) {
                    $('#submit_btn').prop('disabled', false)
                    $('#submit_btn').text('Submit')

                    console.log(jqXHR.responseJSON);

                    if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                        $('.lara_error').remove(); // remove old errors

                        $.each(jqXHR.responseJSON.errors, function(index, errorMessage) {
                            element = dotToArray(index);

                            $("input[name='" + element + "']").parent().next('span').remove();
                            $("select[name='" + element + "']").parent().next('span').remove();

                            let spanEl = document.createElement('span')
                            $(spanEl).addClass('text-danger lara_error').text(errorMessage)
                                .insertAfter($("input[name='" + element + "']").parent())
                            $(spanEl).addClass('text-danger').text(errorMessage).insertAfter($(
                                "select[name='" + element + "']").parent())
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


    $(document).on('submit', '#profile_form_', function(e) {
        e.preventDefault();
        let form = $('#profile_form')[0];
        let form_data = new FormData(form);
        $.ajax({
            url: '{{ route('submission.store') }}'
            , type: "post"
            , contentType: false
            , processData: false,
            // data: $('#profile_form').serialize(),
            data: form_data
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , success: function(data, textStatus, jqXHR) {
                if (data.success) {
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
                    $('#profile_form')[0].reset();

                    $('#form_section').addClass('d-none');
                    $('#complete_section').removeClass('d-none');
                }
            }
            , error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                    $('.lara_error').remove(); // remove old errors

                    $.each(jqXHR.responseJSON.errors, function(index, errorMessage) {
                        element = dotToArray(index);

                        $("input[name='" + element + "']").parent().next('span').remove();
                        $("select[name='" + element + "']").parent().next('span').remove();

                        let spanEl = document.createElement('span')
                        $(spanEl).addClass('text-danger lara_error').text(errorMessage)
                            .insertAfter($("input[name='" + element + "']").parent())
                        $(spanEl).addClass('text-danger').text(errorMessage).insertAfter($(
                            "select[name='" + element + "']").parent())
                    });
                    $('html, body').animate({
                        scrollTop: $(".lara_error").offset().top - 150
                    }, 1);
                }

                // $("#profile_form_step-t-0").click();
            }
        });

    })
    var theFile = document.getElementById('formFile');


    function onFileInput(id) {
        $('#' + id).trigger('click');
        document.body.onfocus = checkIt;
        console.log('initializing');

    }

    function checkIt() {
        // console.log(theFile.value);
        // let name = theFile.value
        if (theFile.value.length) {
            $('.attachedFileName').html(theFile.value);
            $('.file-uploads').addClass('d-none');
            $('.attachedCV').removeClass('d-none');
        }

        // Alert the user if the number
        // of file is zero
        // else {
        //     alert('Cancel clicked');
        // }
        document.body.onfocus = null;
        console.log('checked');
    }

    $(".university").select2({
        tags: true
    , });
    $(".degree").select2({
        tags: true
    });
    $(".country").select2();
    $(".state").select2();
    $(".city").select2();

    // candidate_status
    $("[name=candidate_status]").click(function() {
        $('.toHide').hide();
        console.log($("#container_" + $(this).val()));

        $("#container_" + $(this).val()).show('slow');
    });
    $(document).on('change', '#country', function(e) {
        let country_id = $(this).val();
        if(country_id) {
            $.ajax({
                url: "{{route('submission.getStates')}}",
                type: 'POST',
                data: {'country_id': country_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if(response.status) {
                        $('select[name="state"]').empty();
                        $('select[name="state"]').append('<option value="">Select State</option>');
                        $.each(response.data, function(key, value) {
                            $('select[name="state"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                },
                error: function (errorResponse) {
                    console.log(errorResponse);
                }
            });
        } else {
            $('select[name="state"]').empty();
            $('select[name="state"]').append('<option value="">Select State</option>');
            $('#state').val('').trigger('change');
        }
    })
    $(document).on('change', '#state', function(e) {
        let state_id = $(this).val();
        if(state_id) {
            $.ajax({
                url: "{{route('submission.getCities')}}",
                type: 'POST',
                data: {'state_id': state_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if(response.status) {
                        $('select[name="city"]').empty();
                        $('select[name="city"]').append('<option value="">Select City</option>');
                        $.each(response.data, function(key, value) {
                            $('select[name="city"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                },
                error: function (errorResponse) {
                    console.log(errorResponse);
                }
            });
        } else {
            $('select[name="city"]').empty();
            $('select[name="city"]').append('<option value="">Select City</option>');
        }
    })

</script>
@if (Session::has('success'))
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
        , title: "{{ Session::get('success') }}"
    })

</script>
@endif
@endpush
