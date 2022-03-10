$(window).on('load', function() {


	//ajax per riordinare le varianti
	$(function() {
	    $("#sortable").sortable({
	        update: function() {
	        	var ordering = $(this).sortable('serialize');
	          	$.post(getUrl('reorder_sizes'), ordering);
	          	success('ok-update');
	        }
	    });
    });

	$(function() {
	    $("#sortable2").sortable({
	        update: function() {
	        	var ordering = $(this).sortable('serialize');
	          	$.post(getUrl('reorder_colors'), ordering);
	          	success('ok-update');
	        }
	    });
    });



    $(document).on("change keyup",'input', function(){
		$(this).closest('.list-group-item').find('.save_variant').removeAttr('disabled');
	});


	$('.save_variant').on('click', function(){
		var id = $(this).closest('.list-group-item').attr('id');
		var id = id.substring(2, id.lenght);
		var form = $(this).closest('.list-group-item').find('form');
		var data = form.serialize(); //recupera tutti i valori del form automaticamente
		
		var url = $(this).attr("data-action");

		$.ajax({
			type: "PUT",
			url: url,
			data: '_method=put&'+data,
			dataType: "html",
			success: function(response){    
            	if(response == "ok"){
            		success('ok-update');
            		$(this).attr('disabled','disabled');
            	}else{
            		error('no-update');
            	}
            }
		});

	});


	$('.delete_variant').on('click', function(){
		var cur = $(this);
		var id = cur.attr('id');
		var url = cur.attr("data-action");

		bootbox.confirm({
				title: "<h4>Eliminazione variante</h4>",
			    message: "<p class='text-normal'>Sei sicuro di voler eliminare questa variante?</p>",
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
			        if(result === false)
				        return;
				    else{

				    	$.ajax({
			                type: 'DELETE',
			                url: url,
			                data: {_method: 'delete'},
			                success: function(response){    
			                	if(response == "ok"){
			                		success('ok-delete');
			                        cur.closest('.list-group-item').remove();
			                	}else{
			                		error('no-delete');
			                	}
			                }
			            }); 
				    }
			    }
			});

	});


});

