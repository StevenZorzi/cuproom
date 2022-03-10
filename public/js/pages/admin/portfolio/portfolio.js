$(document).on('change','#active', function(){

	if($(this).is(':checked')){
		$.post(getUrl('update'), {active: '1', _method: 'PUT'}).done(function(response){
      		success('ok_active');
      	});
	}else{
		$.post(getUrl('update'), {active: '0', _method: 'PUT'}).done(function(response){
      		success('no_active');
      	});
	}

});

$(document).on("click", "#dropzonePreview .dz-preview", function() {
    
    var id_img = $(this).attr('id').substr(4, $(this).attr('id').length);
 	
	$.post(getUrl('get_img_info'), {id: id_img, ref_id: ref_id}).done(function(body){

		var modal = bootbox.dialog({
	        message: body,
	        size:'large',
	        title: "Informazioni immagine",
	        buttons: [
	          {
	            label: "Salva",
	            className: "btn btn-success btn-rounded pull-right",
	            callback: function() {

	                var data = $("#form-update-img-info").serialize();
	                
					$.post(getUrl('update_img_info'), data )
					.done(function(response){

						success('ok-update');

				  	})
				  	.error(function(response){
				  		//console.log(response.responseText);
				  	});
	             
	            }
	          },
	          {
	            label: "Annulla",
	            className: "btn btn-default btn-rounded pull-right mar-rgt",
	            callback: function() {
	              	modal.modal("hide");
	            }
	          }
	        ],
	        onEscape: function() {
	          modal.modal("hide");
	        }
	    });

  	}).error(function(body){ 
        //console.log(body.responseText);
    });
});

$(window).on('load', function() {

	new Switchery(document.getElementById('active'));

	//class="jstree-clicked"
	$('#jstree').jstree({
	  "core" : {
	    "themes" : {
	      "name" : "proton",
	      "responsive": true
	    }
	  },
	  "checkbox" : {
	    "keep_selected_style" : false,
	    "three_state" : false,
	  },
	  "plugins" : [ "wholerow", "checkbox" ]
	});

	$('#jstree').jstree(true).open_all();
    $('li[data-checkstate="checked"]').each(function() {
        $('#jstree').jstree('check_node', $(this));
    });

    $('#jstree').on("changed.jstree", function (e, data) {
    	
    	if(data.node != undefined){
			$.post(url['change_cat'], { _method: 'PUT' , id_category: data.node.id })
			.done(function(response){
	          	success('ok_category');
	        });
		}
		/*if(data.selected.length) {
			alert('The selected node is: ' + data.instance.get_node(data.selected[0]).text);
		}*/
	});
			

	
    $("#dropzonePreview").sortable({
        items:'.dz-preview',
        cursor: 'move',
        opacity: 0.5,
        containment: '#dropzonePreview',
        distance: 20,
        tolerance: 'pointer'
    });


    $("#dropzonePreview").on('sortupdate', function() {
    	var ordering = $(this).sortable('serialize');
      	
      	$.post(getUrl('reorder_url'), ordering).done(function(response){
      		success('ok_reorder');
      		$(".panel.preview img").attr('src', url['path_portfolio_img']+"/"+response);
      	});
    });
    


	$('#date-from .input-group.date input').datepicker({
        language: lang,
        format: 'dd/mm/yyyy',
        todayBtn: true,
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function(e) {
        $('#form-update-main').formValidation('revalidateField', $(this));
    });

    $('#date-to .input-group.date input').datepicker({
        language: lang,
        format: 'dd/mm/yyyy',
        todayBtn: true,
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function(e) {
        $('#form-update-main').formValidation('revalidateField', $(this));
    });


    $('#date-created_at .date input').datepicker({
        language: lang,
        format: 'dd/mm/yyyy',
        todayBtn: true,
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function(e) {
        $('#form-update-main').formValidation('revalidateField', $(this));
    });

    $('#date-created_at .time input').timepicker({
        language: lang,
        showMeridian: false,
        showSeconds: false, 
        maxHours: '23',
        autoclose: true
    }).on('change', function(e) {
        $('#form-update-main').formValidation('revalidateField', $(this));
    });


	$('.content').summernote({
	    height: 600,
	    placeholder: "Contenuto..."
	});

	$("#delete").on('click', function(){

    	var button = $(this);
    	var url_list = url['list'];

    	bootbox.confirm({
			title: "<h4>Eliminare questo progetto?</h4>",
		    message: "<p class='text-normal'>Il progetto eliminato finirà nel cestino.</p>",
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


	$(".delete-trans").on('click', function(){

    	var button = $(this);

    	bootbox.confirm({
			title: "<h4>Eliminare questa traduzione?</h4>",
		    message: "<p class='text-normal'>I dati cancellati non saranno recuperabili.</p>",
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
				if(result) {

		        	var url = button.attr('data-action');
		        	var lang = button.attr('data-lang');

		        	$.post(url, { _method: 'DELETE', trans: lang })
	                .done(function( response ) {
	                    location.reload();
	                }).error(function( response ) {
	                    error('no-delete');
	                });

	    		}
	    	}
    	});
    });
    


    $("#tab-lang .nav-tabs li").on('click', function(e){

    	if($(this).hasClass('active')){
    		e.stopPropagation();
    	
    	}else{

        	if($(".edit-page .tab-pane.active").find("button[type=submit].btn-success").attr('disabled') == undefined){
        		e.stopPropagation();

        		bootbox.alert({
				    message: "<br><h4 class='text-danger text-semibold'>Attenzione!</h4><p class='text-danger'>Salvare prima i dati di questa traduzione!</p>",
				    size: 'small'
				});
        	}
    	}
    });

    $('#mainnav a, #navbar a').on('click', function(e){

		var href = $(this).attr('href');
    	if(href != "#"){
			e.preventDefault();
    	
	    	if($("#page-content").find("button[type=submit].btn-success").not('[disabled=disabled]').length){
	    		bootbox.confirm({
				    message: "<br><h4 class='text-danger text-semibold'>Attenzione! Alcuni dati non sono ancora stati salvati.</h4><p class='text-danger'>Uscendo dalla pagina le modifiche non salvate saranno perse. Continuare?<p>",
				    buttons: {
				        confirm: {
				            label: 'Continua',
				            className: 'btn-primary'
				        },
				        cancel: {
				            label: 'Annulla',
				            className: 'btn-default'
				        }
				    },
				    callback: function (result) {
				    	if(result)
				    		location.href = href;
				    }
				});
	    	}else{
	    		location.href = href;
	    	}
	    }
    });

    $(document).ready(function() {

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
	            title: {
	                validators: {
	                    notEmpty: {
	                        message: 'Il titolo del progetto è obbligatorio'
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
	            title: {
	                validators: {
	                    notEmpty: {
	                        message: 'Il titolo del progetto è obbligatorio',
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
	                                id: validator.getFieldElements('obj').val(),
	                                //trans: validator.getFieldElements('trans_id').val()
	                            };
	                        },
	                        type: 'POST'
			            }
	                }
	            },
	            
	            content: { 
	            	validators: {
                        callback: {
                            callback: function(value, validator, $field) {
                                return true;
                            }
                        }
                    }	
                },
                subtitle: {},
	            meta_title: {},
	            meta_description: {}
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
                	var link = $(".tab-pane.active .url-slug span.url-prefix").text()+$(".tab-pane.active .url-slug input.slug").val();
                	$(".tab-pane.active a.btn.view").attr('href', link);
                },
                error: function(result) {
                	//console.log(result.responseText);
                }
            });
        })
        .find('[name=content]').summernote()
        .on('summernote.change', function(customEvent, contents, $editable) {
            $('.tab-pane.active .form-update-trans').formValidation('revalidateField', 'content');
        }).end();
	


	    $('#form-update-main')
        .formValidation({
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
	            date_to: {
	                validators: {
	                    date: {
	                        format: 'DD/MM/YYYY',
	                        message: 'Formato data errato'
	                    }
	                }
	            },
	            date_from: {
	                validators: {
	                    date: {
	                        format: 'DD/MM/YYYY',
	                        message: 'Formato data errato'
	                    }
	                }
	            },
	            date_created_at: {
	                validators: {
	                	notEmpty: {
	                        message: ' '
	                    },
	                    date: {
	                        format: 'DD/MM/YYYY',
	                        message: ' '
	                    }
	                }
	            },
	            time_created_at: {
	                validators: {
	                    notEmpty: {
	                        message: ' '
	                    },
	                }
	            },
	            place: {},
	            'brand[]': {},

	        }
	    })
	    .on('success.field.fv', function(e, data) {
	    	// Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

        })
        .on('success.form.fv', function(e, element) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $form.data('formValidation');

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
                	console.log(result.responseText);
                }
            });
        })
	    .find('[name="brand[]"]')
        .chosen({
                width: '100%',
                inherit_select_classes: true
        })
        .change(function(e) {
        	var $form = $('#form-update-main'),
                fv = $form.data('formValidation');
            $('#form-update-main').formValidation('revalidateField', 'brand[]');
            fv.disableSubmitButtons(false); 
        })
        .end();

	});

});
