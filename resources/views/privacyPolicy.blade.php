@extends('layouts.frontend.master')

@section('content')
<section class="white-bg hero-small-container">
    <div class="my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if($privacyPolicy)
                        {!! $privacyPolicy->content !!}
                    @endif
                </div>
                {{-- <div class="col-lg-12">
                    <div class="text-center">
                        <div class="my-2">
                        <img src="{{asset('assets/images/logo3.png')}}" alt="">
                    </div>
                    <div class="my-2">
                        <h2 class="">Tira Hire Privacy Policy</h2>
                    </div>
                </div>
                <div class="my-4">
                    <p><u>What is the purpose of this Privacy Policy?</u></p>
                    <p>The purpose of this Privacy Policy is to explain what we do with your personal data once you have
                        voluntarily provided it to us. This Privacy Policy applies to your use of our website and applies to
                        your use of our mobile application software. Your privacy is important to us, and we are committed
                        to protecting and safeguarding your data privacy rights and fulfilling our legal obligations to you.</p>

                    <p><u>What is the applicable legislation?</u></p>
                    <p>The applicable data protection legislation is the General Data Protection Regulation (Regulation (EU)
                        2016/679) (the "GDPR").</p>
                    <p><u>Changes to this Privacy Policy</u></p>
                    <p>We may amend this Privacy Policy from time to time, please ensure you continue to visit this page to
                        stay up to date with the changes. The changes, where appropriate, may be notified to you by e-mail
                        or when you visit the page or online application including where we are required to obtain either
                        revised or additional consent from you with regards to the collection, transfer and processing of
                        your personal data.</p>
                    <p><u>Information we may collect from you</u></p>
                    <p>This Privacy Policy includes information you give us (voluntary information) by creating your profile
                        on our website or online application or by corresponding with us.</p>

                    <p>We may collect and process the following data about you:</p>
                    <p> - Name</p>
                    <p> - Address (including post code)</p>
                    <p> - E-mail address</p>
                    <p> - Phone number</p>
                    <p> - Nationality</p>
                    <p> - Gender/Pronouns</p>
                    <p> - Ethnicity</p>
                    <p> - Date of birth</p>
                    <p> - Preferred work location</p>
                    <p> - Education History</p>
                    <p> - Disabilities (if any)</p>
                    <p> - Sexual orientation</p>
                    <p> - Extra-Curricular activities/interests</p>
                    <p> - Skills</p>
                    <p> - Languages spoken</p>
                    <p> - Visa Status</p>
                    <p> - Work experience</p>
                    <p> - GCSEs</p>
                    <p> - Your username and password</p>

                    <p><u>Processing of video recordings</u></p>
                    <p>We may ask you to record yourself as part of your profile set-up. Video recordings will be removed
                        once they are no longer needed or if a user requests deletion. Video recordings will be retained by
                        Tira Hire in line with Tira Hire's retention policy.</p>
                    <p><u>How long do we keep your personal data for?</u></p>
                    <p>We will only retain your information for as long as is necessary for us to use your information as
                        described above or to comply with our legal obligations. We may retain some of your information
                        after you cease to use our services, if we believe in good faith that it is necessary to meet our legal
                        obligations, such as retaining the information for tax and accounting purposes.</p>
                    <p>When determining the relevant retention periods, we will take into account factors including:</p>

                    <p> - our contractual obligations and rights in relation to the information involved;</p>
                    <p> - legal obligation(s) under applicable law to retain data for a certain period of time;</p>
                    <p> - statute of limitations under applicable law(s);</p>
                    <p> - (potential) disputes;</p>
                    <p> - if you have made a request to have your information deleted; and</p>
                    <p> - guidelines issued by relevant data protection authorities.</p>

                    <p>Otherwise, we securely erase your information once this is no longer needed.</p>
                    <p><u>Who do we share your personal data with?</u></p>
                    <p>Graduates: We share your personal data with the client who has a position to fill. The client will have
                        access to your profile to determine if you are a good fit for the roe they are looking to fill.</p>
                    <p>Clients; We share your data with candidates during the course of providing recruitment services to
                        you, and with potential third parties as part of our contractual relationship.</p>
                    <p><u>What rights do you have in relation to the data we hold about you?</u></p>
                    <p>You have a number of rights by law when it comes to your personal data.</p>

                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to be informed
                                You have the right to be provided with clear, transparent and easily understandable information
                                about how we use your information and your rights.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right of access You have the right to obtain access to your information (in the instance we are the data processor),
                                about you.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to rectification
                                You are entitled to have your information corrected if it's inaccurate or incomplete.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to erasure
                                Also known as 'the right to be forgotten'. This right enables you to request the deletion or removal
                                of your information where there's no compelling reason for us to keep using it. This is not a general
                                right to erasure; there are exceptions.

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to restrict processing
                                You have rights to 'block' or suppress further use of your information. When processing is restricted,
                                we can still store your information, but may not use it further. We keep lists of people who have
                                asked for further use of their information to be 'blocked' to make sure the restriction is respected in
                                future.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to data portability
                                You have rights to obtain and reuse your personal data for your own purposes across different
                                services. For example, if you decide to switch to a new provider, this enables you to move, copy or
                                transfer your information easily between our IT systems and theirs safely and securely, without
                                affecting its usability.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to object to processing
                                You have the right to object to certain types of processing, including processing for direct marketing.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to make a complaint
                                You have the right to make a complaint about the way we handle or process your personal data with
                                your national data protection regulator.
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                The right to withdraw consent
                                You have the right to withdraw your consent at any time in regards to the use of your personal data
                                (although if you do so, it does not mean that anything we have done with your personal data with
                                your consent up to that point is unlawful). This includes your right to withdraw consent to us using
                                your personal data for marketing purposes.
                            </div>
                        </li>

                    </ol>
                    <p>The requests as described are usually free, however a fee may be charged to cover our
                        administrative costs in regards to the below:</p>

                    <p> - baseless or excessive/repeated requests, or</p>
                    <p> - further copies of the same information.</p>
                    <p>Alternatively, we may refuse to act on the request.
                        Please consider your request responsibly before submitting it. We'll respond as soon as we can.
                        Generally, this will be within one month from when we receive your request but, if the request is
                        going to take longer to deal with, we'll come back to you and let you know.</p>
                    <p><u>How can I contact you?</u></p>
                    <p>For enquiries, please contact us at <a href="mailto: toptierhireoutlook.com">toptierhireoutlook.com</a></p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
</section>

@endsection

