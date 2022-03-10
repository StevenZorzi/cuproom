//---------------- AL CARICAMENTO DELLA PAGINA

$(window).on('load', function() {

	var switch_maintenance = new Switchery(document.getElementById('maintenance'));

	$("input.switchery").each(function( index ) {
	  	var switchery = new Switchery($(this)['context'], { color: '#8cc74f'});
	});

	$('#maintenance-text').summernote({
	    height: 154,
	    toolbar: [
	        // [groupName, [list of button]]
	        ['style', ['bold', 'italic', 'underline', 'clear']],
	        ['color', ['color']],
	        ['para', ['ul', 'ol']]
	      ],
	    //placeholder: maintenance_text
	});
	//DA TOGLIERE QUANDO IMPLEMENTATO
	$('#maintenance-text').summernote('disable');

	//riordinamento le varianti
	$(function() {
      	$("#sortable").sortable({
	        update: function() {
	        	var ordering = $(this).sortable('serialize');
	          	$.post(getUrl('reorder_url'), ordering);
	        }
     	});
    });

});



//---------------- EVENTI

//MODULI
$(document).on('change','#modules .switchery', function(){

	if($(this).is(':checked'))
		$(this).closest('.tab-base').find('li.active').find('span.badge').addClass('badge-success');
	else
		$(this).closest('.tab-base').find('li.active').find('span.badge').removeClass('badge-success');
});


//ADD LINGUE
$(document).on('change','select[name=slug]', function(){
	var current = $(this);
	var name = current.find('option:selected').attr('data-desc');
	current.closest('.row').find('input[name=name]').val(name);
});


//UPDATE LINGUE
$(document).on('click','.btn-group.languages .save', function(){
	var current = $(this);
	var id = current.closest('.btn-group').attr('data-id');
	var data = current.closest('form').serialize();

	$.ajax({
        type: 'POST',
        url: getUrl('update_url'),
        data: data+"&id="+id,
        dataType: 'html',
        success: function(data){
        	success('ok_update_text');
        },
        error: function(data){
            error('ko_update_text');
        }
    });
});

//DELETE LINGUE
$(document).on('click','.btn-group.languages .delete', function(){
	var current = $(this);
	var name = current.closest('form').find('input[name=name]').val();
	var id = current.closest('.btn-group').attr('data-id');

	bootbox.confirm("<h4>Eliminare lingua \""+name+"\"?</h4><br><span>Le traduzioni relative già impostate non saranno perse, e saranno disponibili ad un successivo ripristino di questa lingua.</span>", function(result) {
		if (result) {

			$.ajax({
	            type: 'POST',
	            url: getUrl('delete_url'),
	            data: {id: id},
	            dataType: 'html',
                success: function(data){
                	current.closest('.list-group-item').remove();
                },
                error: function(data){
	                
	                error('ko_delete_text');
	            }
	        });
		}
	});
});


//MODALITA' MANUTENZIONE
$(document).on('change','#maintenance', function(){
	if($(this).is(':checked')){
		$.post(getUrl('artisan_maintenance'), { command: "down" })
		.done(function(){
			$('#maintenance-alert').fadeIn();
		});

	}
	else{
		$.post(getUrl('artisan_maintenance'), { command: "up" })
		.done(function(){
			$('#maintenance-alert').fadeOut();
		});
	}
});




