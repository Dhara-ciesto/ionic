/******/ (function () { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!*************************************************!*\
      !*** ./resources/js/pages/form-repeater.int.js ***!
      \*************************************************/
    $(document).ready(function () {
        "use strict";
        let removeBtn = true;
        $(".repeater").repeater({
            initEmpty: false,
            defaultValues: {
                "textarea-input": "foo",
                "text-input": "bar",
                "select-input": "B",
                "checkbox-input": ["A", "B"],
                "radio-input": "B"
            },
            show: function show() {
                $(this).slideDown();

                $('.outer').each(function(key, val) {
                    if ($(val).children().length > 1) {
                        $(val).children().children('.delete').removeClass('d-none')
                    }
                })
                
            },
            hide: function hide(e) {
                // confirm("Are you sure you want to delete this element?") && $(this).slideUp(e);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).slideUp(function () {
                            e();
                            $('.outer').each(function (key, val) {
                                if ($(val).children().length <= 1) {
                                    $(val).children().children('.delete').addClass('d-none')
                                }
                            })
                        });
                        // $(this).slideUp(e)
                    }
                })
            },
            ready: function ready(e) { 
                
            },
            isFirstItemUndeletable: false
        }), window.outerRepeater = $(".outer-repeater").repeater({
            defaultValues: {
                "text-input": "outer-default"
            },
            show: function show() {
                console.log("outer show"), $(this).slideDown();
            },
            hide: function hide(e) {
                console.log("outer delete"), $(this).slideUp(e);
            },
            repeaters: [{
                selector: ".inner-repeater",
                defaultValues: {
                    "inner-text-input": "inner-default"
                },
                show: function show() {
                    console.log("inner show"), $(this).slideDown();
                },
                hide: function hide(e) {
                    console.log("inner delete"), $(this).slideUp(e);
                }
            }]
        });
    });
    /******/
})()
    ;
