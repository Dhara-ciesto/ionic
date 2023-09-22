@extends('layouts.frontend.master')

@section('content')
<section class="white-bg hero-small-container">
<div class="my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if($termsAndCondition)
                {!! $termsAndCondition->content !!}
                @endif
                {{-- <div class="text-center">
                    <div class="my-2">
                        <img src="{{asset('assets/images/logo3.png')}}" alt="">
                    </div>
                    <div class="my-2">
                        <h2 class="">TopTier Hire Terms and Conditions</h2>
                    </div>

                </div>
                <div class="">
                    <div class="my-4">
                        <ol class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                   By accessing this website, you agree to be bound by these Terms & Conditions ("terms"), please read
                                   them carefully. If you do not agree to be bound by these terms you should not access or view this
                                   website.
                                </div>
                            </li>

                        </ol>
                        <p>
                        </p>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    The information contained in this website is intended for general information purposes only. TopTier
                                    Hire has made all reasonable efforts to ensure that the information on this website is accurate at the
                                    time of inclusion. We apologise for all inaccuracies.
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    TopTier Hire makes no representations or warranties about the information provided through this
                                    website, including any hypertext links to any website or other items used either directly or indirectly
                                    from this website. TopTier Hire accepts no liability for any inaccuracies or omissions in this website
                                    and any decisions based on information contained in TopTier Hire's websites or mobile application
                                    are the sole responsibility of the visitor.
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    By entering, browsing and using this Site, you agree to our Privacy Policy. We may change this
                                    privacy policy from time to time without notification and therefore advise you to regularly review
                                    the policy when you visit this site. We take your privacy and security seriously and comply with
                                    applicable UK law in relation to processing personal data.
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    You shall not use this website for any illegal purposes and in particular agree that you shall not send,
                                    use, copy, post or allow any posting which is defamatory or obscene within the meaning of the
                                    Obscene Publications Act or which is abusive, indecent or in breach of the privacy of any person. You
                                    agree not to send any unsolicited promotional or advertising material, spam or similar materials or
                                    any volume messages that may interfere with the operation of this website or with the enjoyment of
                                    this website by other visitors. Unauthorised use of this website may give rise for a claim for
                                    damages.
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    TopTier Hire reserves the right at any time and without notice to enhance, modify, alter, suspend or
                                    permanently discontinue all or any part of this website and to restrict or prohibit access to it.
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    This website is provided to you free of charge, and TopTier Hire does not accept any liability to you
                                    (except in the case of personal injury or death caused by its negligence or for fraud or as required by
                                    law) whether in contract, tort (including negligence) or otherwise, arising out of it in connection with
                                    this website. TopTier Hire accepts no liability for any direct, special, indirect or consequential
                                    damages, or any other damages of whatsoever kind resulting from whatever cause through the use
                                    of any information obtained either directly or indirectly from this website. Your sole remedy is to
                                    discontinue using this website.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
</section>

@endsection
