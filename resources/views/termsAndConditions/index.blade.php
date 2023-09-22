@extends('layouts.master')

@section('title') Terms and Conditions @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Terms and Conditions @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">Meta Data</h4>
                    <p class="card-title-desc">Fill all information below</p> --}}
                <form method="POST" action="{{route('terms-and-condition')}}">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                {{-- <label for="editor_content">Privacy Policy</label> --}}
                                <textarea id="content" name="content">@if($termsAndCondition) {{$termsAndCondition->content}} @endif</textarea>
                                @error('content')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 300
        });
    });

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