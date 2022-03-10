
$(window).on('load', function() {

 
    $(".tab-add").on("click", function(){
    	var ref = $(this).attr('data-id');
    	$("#add-trans input[name=ref]").val(ref);
    	$("#add-trans select[name=lang] option").removeAttr('disabled').removeAttr('selected');
    	$(this).closest('.nav-tabs').find(".tab-trans").each(function( key, value ) {
    		var lang = $(this).attr("data-trans");
		  	$("#add-trans select[name=lang] option[value="+lang+"]").attr('disabled', 'disabled');
		});
		$("#add-trans select[name=lang]").selectpicker("refresh");
    });

    $("#form-update-meta .lang-manage .save").on("click", function(){

    	var data = $(this).closest('.tab-pane').find('form').serialize();
    	var url = $(this).attr('data-action');

    	$.post(url, data)
        .done(function( response ) {
            success('success-'+lang);
        }).error(function( response ) {
            error('error-'+lang);
        });
    	
    });


    $(".lang-manage .delete").on("click", function(){

    	var button = $(this);
    	bootbox.confirm("<h4>Eliminare traduzione?</h4><br><span>Questa traduzione verrà rimosssa e non sarà più disponibile.</span>",function(result) {
			if (result) {
	        	var url = button.attr('data-action');
	        	var id_trans = button.closest('.btn-group').attr('data-id');

	        	var tab = button.closest('.tab-base');

	        	tab.find('.nav-tabs li.active').remove();
	        	tab.find('.nav-tabs li').first().addClass('active').addClass('in');
	        	tab.find('.nav-tabs .tab-add').removeClass('no-display');

	        	$('.tooltip').remove();
	        	button.closest('.tab-pane').remove();
	        	
	        	tab.find('.tab-pane:first').addClass('active').addClass('in');
	        	if(tab.find(".tab-pane").length <= 1){
	        		tab.find(".tab-pane").each(function( key, value ) {
		        		$(this).find("button.delete").remove();
					});
	        	}

	        	$.post(url, { _method: 'DELETE', id: id_trans })
                .done(function( response ) {
                    success('success-'+lang);
                }).error(function( response ) {
                    error('error-'+lang);
                });
    		}
    	});
    });

    $(".cat-manage .delete").on("click", function(){

    	var button = $(this);

    	bootbox.confirm("<h4>Eliminare categoria?</h4><br><span>Tutti gli elementi associati perderanno il raggruppamento per questa categoria. Inoltre tutte le categorie derivanti da questa saranno agganciate alla categoria superiore più prossima.</span>",function(result) {
			if (result) {

				var panel = button.closest('.panel');
	        	var url = button.attr('data-action');

	        	$('.tooltip').remove();

	        	panel.find('+ .sub-panel').removeClass('sub-panel');
	        	panel.fadeOut();

	        	$.post(url, { _method: 'DELETE' })
                .done(function( response ) {
                    success('success-'+lang);
                }).error(function( response ) {
                    error('error-'+lang);
                });
    		}
    	});
    });


    $('#form-add-category').formValidation({
        // I am validating Bootstrap form
        framework: 'bootstrap',
        // Feedback icons
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        // List of fields and their validation rules
        fields: {
            lang: {
                validators: {
                    notEmpty: {
                        message: 'Selezione lingua obbligatoria'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'Il nome della categoria è obbligatorio'
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

    });


    $('#form-add-trans').formValidation({
        // I am validating Bootstrap form
        framework: 'bootstrap',
        // Feedback icons
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        // List of fields and their validation rules
        fields: {
            lang: {
                validators: {
                    notEmpty: {
                        message: 'Selezione lingua obbligatoria'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'Il nome della categoria è obbligatorio'
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

    });


   
    $('.form-update-trans').formValidation({
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
            name: {
                validators: {
                    notEmpty: {
                        message: 'Il nome della categoria è obbligatorio',
                    }
                }
            },
            slug: {
                validators: {
                    notEmpty: {
                        message: 'Lo slug è obbligatorio'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9-_]+$/,
                        message: 'Lo slug inserito non è valido'
                    },
                    remote: {
                        message: 'Slug già esistente',
                        url: getUrl('check_slug'),
                        data: function(validator, $field, value) {
                            return {
                                id: validator.getFieldElements('category').val(),
                                trans: validator.getFieldElements('trans').val()
                            };
                        },
                        type: 'POST'
        
                    }
                }
            },
            
        },
        live: 'submitted'
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
    	var url = $form.attr('action');

    	$.post(url, $form.serialize())
        .done(function( response ) {
            success('success-'+lang);
            if (fv.getSubmitButton()) {
            	fv.disableSubmitButtons(false);   
        	}
        }).error(function( response ) {
            error('error-'+lang);
        });

    });



});

