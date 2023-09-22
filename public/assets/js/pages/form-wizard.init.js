/******/ (function () { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!************************************************!*\
      !*** ./resources/js/pages/form-wizard.init.js ***!
      \************************************************/
    $(function () {
        $("#basic-example").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slide",
        }), $("#vertical-example").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slide",
            stepsOrientation: "vertical"
        });

        let stepsWizard = $("#profile_form_step").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slide",
            onStepChanging: function (event, currentIndex, newIndex) {
                let form = $("#profile_form");
                
                form.validate({
                    errorPlacement: function (error, element) {
                        if (element.attr("name") == 'agree') {
                            $('.agreeError').text($(error).text());
                        } else {
                            element.after(error);
                        }
                    },
                    rules: {
                        agree: {
                            required: true
                        },
                        name: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        phone: {
                            required: true,
                            digits: true
                        },
                    },
                });
                $('.university').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.degree').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.grades_achieved').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.education_institutional').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.education_level').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.grades_achieved2').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.other_qualification').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.city').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });
                $('.industry').each(function () {
                    $(this).rules("add", {
                        required: true
                    });
                });

                if (form.valid()) {
                    return true;
                }
                if (currentIndex > newIndex) {
                    return true
                }
                return false;
            },
            onFinished: function (event, currentIndex) {
                let form = $('#profile_form')[0];
                let form_data = new FormData(form);
                $.ajax({
                    url: baseUrl,
                    type: "post",
                    contentType: false,
                    processData: false,
                    // data: $('#profile_form').serialize(),
                    data: form_data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data, textStatus, jqXHR) {
                        if(data.success) {
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
                            $("#profile_form_step-t-0").click();
                            $('#profile_form')[0].reset();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            
                            $.each(jqXHR.responseJSON.errors, function(index,  errorMessage) {
                                element = dotToArray(index);
                                $("input[name='" + element + "']").parent().next('span').remove();
                                $("select[name='" + element + "']").parent().next('span').remove();
                                
                                let spanEl = document.createElement('span')
                                $(spanEl).addClass('text-danger').text(errorMessage).insertAfter($("input[name='" + element + "']").parent())
                                $(spanEl).addClass('text-danger').text(errorMessage).insertAfter($("select[name='" + element + "']").parent())
                            });
                        }
                        $("#profile_form_step-t-0").click();
                    }
                });
            },
        })
        
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
    });
    /******/
})();