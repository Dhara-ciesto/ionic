@extends('layouts.frontend.master')

@section('content')

<div class="my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    {{-- <a href="{{route('home')}}" class="d-block auth-logo">
                        <img src="{{ URL::asset('/assets/images/logo2.png') }}" alt="" height="20" class="auth-logo-dark mx-auto">
                        <img src="{{ URL::asset('/assets/images/logo2.png') }}" alt="" height="20" class="auth-logo-light mx-auto">
                    </a> --}}
                    <div class="row justify-content-center mt-5">
                        <div class="col-sm-4">
                            <div class="maintenance-img">
                                <img src="{{ URL::asset('/assets/images/coming-soon.svg') }}" alt="" class="img-fluid mx-auto d-block">
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-5">Coming Soon</h4>
                    {{-- <h4 class="mt-5">Let's get started with Skote</h4> --}}
                    {{-- <p class="text-muted">It will be as simple as Occidental in fact it will be Occidental.</p> --}}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

