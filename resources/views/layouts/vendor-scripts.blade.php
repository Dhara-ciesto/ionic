<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

{{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

{{-- <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
    // window.OneSignalDeferred = window.OneSignalDeferred || [];
    // OneSignalDeferred.push(function(OneSignal) {
    //     OneSignal.init({
    //         appId: "7a7bd1be-a4d9-4560-9e6e-192ca172a246",
    //         allowLocalhostAsSecureOrigin: true,
    //     });
    // });
    window.OneSignalDeferred = window.OneSignalDeferred || [];
    window.OneSignal = window.OneSignal || [];
    OneSignalDeferred.push(function() {
        OneSignal.init({
            appId: "7a7bd1be-a4d9-4560-9e6e-192ca172a246",
            safari_web_id: "web.onesignal.auto.1b1338f0-ae7a-49c0-a5a1-0112be9b9bea",
            notifyButton: {
                enable: true,
            },
            allowLocalhostAsSecureOrigin: true,
        });
    });
    OneSignal.push(function() {
        OneSignal.isPushNotificationsEnabled(function(isEnabled) {
            if (isEnabled) {
                OneSignal.getUserId().then(function(userId) {
                    console.log("OneSignal User ID:", userId);

                    saveUserToken(userId)
                    // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
                    console.log("Push notifications are enabled!");
                });
            } else {

                console.log("Push notifications are not enabled yet.");
                OneSignal.showNativePrompt();
            }
        });
        OneSignal.push(function() {
            // Occurs when the user's subscription changes to a new value.
            OneSignal.on('subscriptionChange', function(isSubscribed) {
                console.log("The user's subscription state is now:", isSubscribed);
                OneSignal.getUserId().then(function(userId) {
                    console.log("OneSignal User ID:", userId);

                    saveUserToken(userId)
                });
            });

            // This event can be listened to via the `on()` or `once()` listener.
        });
    });
</script> --}}



<script>
    $('#change-password').on('submit', function(event) {
        event.preventDefault();
        var Id = $('#data_id').val();
        var current_password = $('#current-password').val();
        var password = $('#password').val();
        var password_confirm = $('#password-confirm').val();
        $('#current_passwordError').text('');
        $('#passwordError').text('');
        $('#password_confirmError').text('');
        $.ajax({
            url: "{{ url('update-password') }}" + "/" + Id,
            type: "POST",
            data: {
                "current_password": current_password,
                "password": password,
                "password_confirmation": password_confirm,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                $('#current_passwordError').text('');
                $('#passwordError').text('');
                $('#password_confirmError').text('');
                if (response.isSuccess == false) {
                    $('#current_passwordError').text(response.Message);
                } else if (response.isSuccess == true) {
                    setTimeout(function() {
                        window.location.href = "{{ route('root') }}";
                    }, 1000);
                }
            },
            error: function(response) {
                $('#current_passwordError').text(response.responseJSON.errors.current_password);
                $('#passwordError').text(response.responseJSON.errors.password);
                $('#password_confirmError').text(response.responseJSON.errors
                .password_confirmation);
            }
        });
    });
</script>

@yield('script')

<!-- App js -->
<script src="{{ asset('/assets/js/app.min.js') }}"></script>

@yield('script-bottom')
