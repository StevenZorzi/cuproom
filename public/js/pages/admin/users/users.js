$(document).ready(function () {

	$("#delete").on('click', function(){

    	var button = $(this);
    	var url_list = url['list'];

    	bootbox.confirm({
            title: "<h4>Disattivare questo utente?</h4>",
            message: "<p class='text-normal'>L\'utente disattivato sarà ripristinabile per accedere nuovamente.</p>",
            buttons: {
                confirm: {
                    label: 'Conferma',
                    className: 'btn-danger btn-rounded'
                },
                cancel: {
                    label: 'Annulla',
                    className: 'btn-default btn-rounded'
                }
            },
            callback: function (result) {
    			if (result) {

    	        	var url = button.attr('data-action');

    	        	$.post(url, { _method: 'DELETE' })
                    .done(function( response ) {
                       location.href = url_list;
                    }).error(function( response ) {
                        error('no-delete');
                    });

        		}
            }
    	});
    });


	$('#form-update-user').formValidation({
        // I am validating Bootstrap form
        framework: 'bootstrap',
        excluded: [':disabled'],
        // Feedback icons
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        // List of fields and their validation rules
        fields: {
            role: {
                validators: {
                    notEmpty: {
                        message: 'Tipo utente obbligatorio',
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'Nome utente obbligatorio'
                    }
                }
            },
            surname: {
                validators: {
                    notEmpty: {
                        message: 'Cognome utente obbligatorio'
                    }
                }
            },
            email: {
            	verbose: false, //verifica la validazione del campo regola per regola
                validators: {
                    notEmpty: {
                        message: 'Indirizzo e-mail utente obbligatorio'
                    },
                    emailAddress: {
                        message: 'L\'indirizzo e-mail inserito non è corretto'
                    },
                    remote: {
                    	message: 'Indirizzo email già esistente',
	                    url: getUrl('check_email'),
	                    type: 'POST'
	                }

                }
            },
            lang: {
                validators: {
                    notEmpty: {
                        message: 'Lingua utente preferita obbligatorio'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'Specificare il sesso dell\'utente'
                    }
                }
            },
            timezone: {
                validators: {
                    notEmpty: {
                        message: 'Specificare il fuso orario da cui si visualizza il panello, per la corretta visualizzazione degli orari'
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

    })
    .on('success.form.fv', function(e) {
        // Invio i dati in ajax
        e.preventDefault();

        var $form = $(e.target),
            fv = $form.data('formValidation');
        
        // Use Ajax to submit form data
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {
                success('ok-update');
                if (fv.getSubmitButton()) {
                	fv.disableSubmitButtons(true);   
            	}
            },
            error: function(result) {
            	//console.log(result.responseText);
            }
        });
    });



    $('#form-change-pwd').formValidation({
        // I am validating Bootstrap form
        framework: 'bootstrap',
        excluded: [':disabled'],
        // Feedback icons
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        // List of fields and their validation rules
        fields: {
            pwd: {
	            validators: {
	            	notEmpty: {
                        message: 'Inserire nuova password'
                    },
                    stringLength: {
                        min: 7,
                        message: 'La password deve essere lunga almeno 7 caratteri'
                    }
	            }
	        },
	        confirm_pwd: {
	        	verbose: false,
	        	trigger: 'blur',
	            validators: {
	            	notEmpty: {
                        message: 'Inserire nuovamente la nuova password per conferma'
                    },
	                identical: {
	                    field: 'pwd',
	                    message: 'Le due password inserite devono corrispondere',
	                }
	            }
	        }
        }
    })
    .on('success.field.fv', function(e, data) {
    	// Non mostrare success
        var $parent = data.element.parents('.form-group');
        $parent.removeClass('has-success');
        data.element.data('fv.icon').hide();

    })
    .on('success.form.fv', function(e) {
        // Invio i dati in ajax
        e.preventDefault();

        var $form = $(e.target),
            fv = $form.data('formValidation');
        
        // Use Ajax to submit form data
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {

                success('ok-update');
                if (fv.getSubmitButton()) {
                	fv.disableSubmitButtons(true);   
            	}
            	$form.trigger('reset');
            },
            error: function(result) {
            	console.log(result.responseText);
            }
        });
    });


});

