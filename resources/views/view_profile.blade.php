@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <img src="{{asset($profile->image)}}" class="img-fluid mb-3" style="width: 80px; height:80px; border-radius: 50%" alt="">
                <h5 class="">{{$profile->name}}</h5>
                <h5 class="">{{$profile->email}}</h5>
                <div class="my-5">
                    <h5 class="card-title">{{__('Introduction Video')}}</h5>
                </div>
                <div class="my-5">
                    <h5 class="card-title">{{__('Educational History')}}</h5>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>University</th>
                                    <th>Degree</th>
                                    <th>Grades Achieved</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($profile->university) as $key => $value)
                                <tr>
                                    <th>{{$value->university}}</th>
                                    <td>{{$value->degree}}</td>
                                    <td>{{$value->grades_achieved}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Education Institution</th>
                                    <th>Educational Level</th>
                                    <th>Grades Achieved</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($profile->education) as $key => $value)
                                <tr>
                                    <th>{{$value->education_institutional}}</th>
                                    <td>{{$value->education_level}}</td>
                                    <td>{{$value->grades_achieved2}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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

