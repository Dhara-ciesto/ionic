@extends('layouts.frontend.master')

@section('content')
<style>
    .hero-section2 {
        background: #fff2cc
    }
</style>
<section class="section hero-section2 pt-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center- mb-5" style="margin: 0 10rem">
                    <h1 class="fw-semibold mb-3 hero-title animate__animated  animate__fadeInLeft">CONNECTING YOU TO THE BEST…</h1>
                    <h1 class="fw-semibold mb-3 hero-title text-end animate__animated  animate__fadeInRight">…AT THE CLICK OF A BUTTON</h1>
                </div>
            </div>
        </div>
        <div class="row align-items-center text-center">
            <div class="col-lg-12">
                <p class="fs-5">Tira Hire is dedicated to helping you find the perfect job. Tell us a bit about yourself
                    and let the perfect job find you.</p>
                <p class="fs-5">Create your profile and allow Tira recruiters and employers to contact directly. with
                    roles that fit your educational background, interests and aspirations!</p>

            </div>

        </div>
        <!-- end row -->
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<section class="section pt-4 bg-white" id="about">
    <div class="container">
        <div class="row">

            <!-- end col -->
        </div>
        <!-- end row -->



        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    {{-- <div class="small-title">About us</div> --}}
                    <h4>CREATE YOUR PROFILE</h4>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="profile_form" action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- <h4 class="card-title mb-4">Basic Wizard</h4> --}}
                            <div class="form-check my-3">
                                <input class="form-check-input" name="agree" type="checkbox" id="formCheck2" checked>
                                <label class="form-check-label" for="formCheck2">
                                    CLICK HERE TO AGREE TO THE Tira <a href="#">PRIVACY POLICY</a>
                                </label>
                                <div class="agreeError error"></div>
                            </div>


                            <div id="profile_form_step">
                                <!-- Seller Details -->
                                <h3>Seller Details</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="name">FULL NAME <span class="error">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Enter Your Full Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="email">EMAIL <span class="error">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Enter Your Email ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phone">PHONE <span class="error">*</span></label>
                                                <input type="number" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="Enter Your Phone No.">
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Company Document -->
                                <h3>Company</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">PICTURE</label>
                                                <input class="form-control" name="image" type="file" id="image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">VIDEO</label>
                                                <input class="form-control" name="video" type="file" id="video" accept="video/*">
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Bank Details -->
                                <h3>Bank Details</h3>
                                <section>
                                    <div>
                                        <div class="repeater mb-5">
                                            <div data-repeater-list="group_a" class="outer">
                                                <div data-repeater-item class="row">
                                                    <div class="col-lg-11">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>UNIVERSITY <span class="error">*</span></label>
                                                                    <select class="form-select university" name="university">
                                                                        <option value="">Select University</option>
                                                                        <option value="University of Nottingham" {{old('university') == 'University of Nottingham' ? 'selected' : ''}}>University of Nottingham</option>
                                                                        <option value="University of Exeter" {{old('university') == 'University of Exeter' ? 'selected' : ''}}>University of Exeter</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>DEGREE <span class="error">*</span></label>
                                                                    <select class="form-select degree" name="degree">
                                                                        <option value="">Select Degree</option>
                                                                        <option value="Degree1" {{old('degree') == 'Degree1' ? 'selected' : ''}}>Degree1</option>
                                                                        <option value="Degree2" {{old('degree') == 'Degree2' ? 'selected' : ''}}>Degree2</option>
                                                                        <option value="Degree3" {{old('degree') == 'Degree3' ? 'selected' : ''}}>Degree3</option>
                                                                        <option value="Degree4" {{old('degree') == 'Degree4' ? 'selected' : ''}}>Degree4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>GRADES ACHIEVED/PREDICTED <span class="error">*</span></label>
                                                                    <input type="text" name="grades_achieved" value="{{old('grades_achieved')}}" class="inner form-control grades_achieved" placeholder="Enter your GRADES Achieved" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 delete d-none" style="margin: auto">
                                                        <span data-repeater-delete type="button" ><i class='bx bxs-trash-alt bx-xs error'></i></span>
                                                        {{-- <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" /> --}}
                                                        {{-- <div class="row">
                                                            <div class="col-lg-12 align-self-center">
                                                                <div class="d-grid">
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    {{-- <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" /> --}}
                                                    <button data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="repeater mb-5">
                                            <div data-repeater-list="group_b" class="outer">
                                                <div data-repeater-item class="row">
                                                    <div class="col-lg-11">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>EDUCATIONAL INSTITUTIONAL <span class="error">*</span></label>
                                                                    <input type="text" name="education_institutional" value="{{old('education_institutional')}}" class="inner form-control education_institutional" placeholder="Enter your educational institutional" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>EDUCATION LEVEL <span class="error">*</span></label>
                                                                    <select class="form-select education_level" name="education_level">

                                                                        <option value="">Select Education Level</option>
                                                                        <option value="GCSE" {{old('education_level') == 'GCSE' ? 'selected' : ''}}>GCSE</option>
                                                                        <option value="A-Levels" {{old('education_level') == 'A-Levels' ? 'selected' : ''}}>A-Levels</option>
                                                                        <option value="Bachelors Degree" {{old('education_level') == 'Bachelors Degree' ? 'selected' : ''}}>Bachelor's Degree</option>
                                                                        <option value="Masters Degree" {{old('education_level') == 'Masters Degree' ? 'selected' : ''}}>Master's Degree</option>
                                                                        <option value="Doctoral Degree" {{old('education_level') == 'Doctoral Degree' ? 'selected' : ''}}>Doctoral Degree</option>
                                                                        <option value="Diploma of Higher Education" {{old('education_level') == 'Diploma of Higher Education' ? 'selected' : ''}}>Diploma of Higher Education</option>
                                                                        <option value="Certificate of Higher Education" {{old('education_level') == 'Certificate of Higher Education' ? 'selected' : ''}}>Certificate of Higher Education</option>
                                                                        <option value="Foundation Degree" {{old('education_level') == 'Foundation Degree' ? 'selected' : ''}}>Foundation Degree</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>GRADES ACHIEVED/PREDICTED <span class="error">*</span></label>
                                                                    <input type="text" name="grades_achieved2" value="{{old('grades_achieved2')}}" class="inner form-control grades_achieved2" placeholder="Enter your GRADES Achieved" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 delete d-none" style="margin: auto">
                                                        <div class="row">
                                                            <div class="col-lg-12 align-self-center ">
                                                                <div class="d-grid">
                                                                    {{-- <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" /> --}}
                                                                    <span data-repeater-delete type="button"><i class='bx bxs-trash-alt bx-xs error'></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    {{-- <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" /> --}}
                                                    <button data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0 "><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="repeater">
                                            <div data-repeater-list="group_c" class="outer">
                                                <div data-repeater-item class="row">
                                                    <div class="col-lg-11">
                                                        <div class="mb-3">
                                                            <label>OTHER QUALIFICATION <span class="error">*</span></label>
                                                            <select class="form-select other_qualification" name="other_qualification">
                                                                <option value="">Select Other Qualification</option>
                                                                <option value="Prince 2" {{old('other_qualification') == 'Prince 2' ? 'selected' : ''}}>Prince 2</option>
                                                                <option value="Project Management" {{old('other_qualification') == 'Project Management' ? 'selected' : ''}}>Project Management</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 delete d-none" style="margin: auto">
                                                        <div class="row">
                                                            <div class="col-lg-12 align-self-center ">
                                                                <div class="d-grid">
                                                                    {{-- <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" /> --}}
                                                                    <span data-repeater-delete type="button"><i class='bx bxs-trash-alt bx-xs error'></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    {{-- <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" /> --}}
                                                    <button data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0 "><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h3>Roles</h3>
                                <section>
                                    <div>
                                        <div class="repeater mb-5">
                                            <div data-repeater-list="group_d" class="outer">
                                                <div data-repeater-item class="row">
                                                    <div class="col-lg-11">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>CITY <span class="error">*</span></label>
                                                                    <select class="form-select city" name="city">
                                                                        <option value="">Select City</option>
                                                                        <option value="London" {{old('city') == 'London' ? 'selected' : ''}}>London</option>
                                                                        <option value="Birmingham" {{old('city') == 'Birmingham' ? 'selected' : ''}}>Birmingham</option>
                                                                        <option value="Newcastle" {{old('city') == 'Newcastle' ? 'selected' : ''}}>Newcastle</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>INDUSTRY <span class="error">*</span></label>
                                                                    <select class="form-select industry" name="industry">
                                                                        <option value="">Select Industry</option>
                                                                        <option value="Financial Services" {{old('industry') == 'Financial Services' ? 'selected' : ''}}>Financial Services</option>
                                                                        <option value="Technology" {{old('industry') == 'Technology' ? 'selected' : ''}}>Technology</option>
                                                                        <option value="Marketing" {{old('industry') == 'Marketing' ? 'selected' : ''}}>Marketing</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label>JOB TYPE</label>
                                                                    <select class="form-select" name="job_type" id="job_type">

                                                                        <option value="">Select Job Type</option>
                                                                        <option value="Part-Time" {{old('job_type') == 'Part-Time' ? 'selected' : ''}}>Part-Time</option>
                                                                        <option value="Full-Time" {{old('job_type') == 'Full-Time' ? 'selected' : ''}}>Full-Time</option>
                                                                        <option value="Internship" {{old('job_type') == 'Internship' ? 'selected' : ''}}>Internship</option>
                                                                        <option value="Graduate Scheme" {{old('job_type') == 'Graduate Scheme' ? 'selected' : ''}}>Graduate Scheme</option>
                                                                        <option value="Temporary" {{old('job_type') == 'Temporary' ? 'selected' : ''}}>Temporary</option>
                                                                        <option value="Contract" {{old('job_type') == 'Contract' ? 'selected' : ''}}>Contract</option>
                                                                        <option value="Apprenticeship" {{old('job_type') == 'Apprenticeship' ? 'selected' : ''}}>Apprenticeship</option>
                                                                        <option value="Volunteer" {{old('job_type') == 'Volunteer' ? 'selected' : ''}}>Volunteer</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 delete d-none" style="margin: auto">
                                                        <div class="row">
                                                            <div class="col-lg-12 align-self-center ">
                                                                <div class="d-grid">
                                                                    {{-- <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" /> --}}
                                                                    <span data-repeater-delete type="button"><i class='bx bxs-trash-alt bx-xs error'></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    {{-- <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" /> --}}
                                                    <button data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0 "><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">ATTACH CV</label>
                                                    <input class="form-control" name="cv" id="cv" type="file" id="formFile" accept="application/pdf,.csv">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Confirm Details -->
                                <h3>Confirm Detail</h3>
                                <section>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                </div>
                                                <div>
                                                    <h5>Confirm Detail</h5>
                                                    <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </form>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>

        </div>
        <!-- end row -->

        {{-- <hr class="my-5"> --}}

        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- about section end -->

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
    let errors = @json($errors -> messages());
    setTimeout(() => {
        console.log(errors);
        $.each(errors, function(index, error) {
            element = dotToArray(index);


            let spanEl = document.createElement('span')
            $(spanEl).addClass('text-danger').text(error).insertAfter($("input[name='" + element + "']").parent())
            $(spanEl).addClass('text-danger').text(error).insertAfter($("select[name='" + element + "']").parent())

        });
    }, 500);

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
@endpush
