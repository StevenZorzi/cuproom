 
{!! Html::script('js/pages/website/vendor/what-input.js') !!}
{!! Html::script('js/pages/website/vendor/foundation.min.js') !!}
{!! Html::script('js/pages/website/slick.min.js') !!} 
{!! Html::script('js/pages/website/countdown.js') !!}
{!! Html::script('js/pages/website/isotpe.min.js') !!}  
{!! Html::script('js/pages/website/magnific-popup.js') !!}
{!! Html::script('plugins/wow/wow.min.js') !!}

{!! Html::script('plugins/form-validation/js/formValidation.min.js') !!}
{!! Html::script('plugins/form-validation/js/framework/bootstrap.min.js') !!} 
{!! Html::script('plugins/form-validation/js/reCaptcha2.min.js') !!} 


{!! Html::script('js/pages/website/custom.js') !!}

 <script type="text/javascript">


// FORM VALIDATION
$('#form-contatti').formValidation({
    // I am validating Bootstrap form
    framework: 'bootstrap',
    // Feedback icons
    icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },

    addOns: {
        reCaptcha2: {
            element: 'captchaContainer',
            language: 'it',
            theme: 'light',
            siteKey: '6LfXaXYUAAAAAJ5aHABmpNIxrSpi9YDlTFZhHBHr',
            timeout: 120,
            message: 'Il captcha non è valido'
        }
    },

    // List of fields and their validation rules
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: "@lang('validation.custom.not-empty')"
                }
            }
        },
        surname: {
            validators: {
                notEmpty: {
                    message: "@lang('validation.custom.not-empty')"
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: "@lang('validation.custom.not-empty')"
                },
                emailAddress: {
                    message: "@lang('validation.custom.email-wrong')"
                }
            }
        }, 
        message: {
            validators: {
                notEmpty: {
                    message: "@lang('validation.custom.not-empty')"
                }
            }
        }, 
        auth_check: {
            validators: {
                notEmpty: {
                    message: "@lang('validation.custom.not-empty')"
                }
            }
        },  
    }
})
.on('success.field.fv', function(e, data) {
   // Non mostrare success
    var $parent = data.element.parents('.form-group');
    $parent.removeClass('has-success');
    data.element.data('fv.icon').hide();

});

 </script>

