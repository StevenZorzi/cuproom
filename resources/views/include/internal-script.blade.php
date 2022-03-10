<script>
	var message = new Array();
	message['success-up'] = "@lang('interface.success-up')";
	message['failed-up'] = "@lang('interface.failed-up')";
	message['success-it'] = "Dati aggiornati con successo";
	message['success-en'] = "Data saved successfully";
	message['error-it'] = "Errore durante l'operazione";
	message['error-en'] = "Error during the operation";

	var url = new Array();

	var v = new Array();

	v['not-empty'] = "@lang('validation.custom.not-empty')";
    v['required'] = "@lang('validation.custom.required')";
    v['reg-company'] = "@lang('validation.custom.reg-company')";
    v['sel-tipology'] = "@lang('validation.custom.sel-tipology')";
    v['email-wrong'] = "@lang('validation.custom.email-wrong')";
    v['email-just'] = "@lang('validation.custom.email-just')";
    v['create-pwd'] = "@lang('validation.custom.create-pwd')";
    v['pwd-7'] = "@lang('validation.custom.pwd-7')";
    v['pwd-check'] = "@lang('validation.custom.pwd-check')";
    v['pwd-retype'] = "@lang('validation.custom.pwd-retype')";
    v['pwd-new'] = "@lang('validation.custom.pwd-new')";
    v['not-empty-ue'] = "@lang('validation.custom.not-empty-ue')";
    v['not-empty-it'] = "@lang('validation.custom.not-empty-it')";
    v['sc-not-found'] = "@lang('validation.custom.sc-not-found')";
    v['date-format'] = "@lang('validation.custom.date-format')";

	function getMessage(key){
		return message[key];
	}
	function getUrl(key){
		return url[key];
	}

	function success(message){
		$.niftyNoty({
			type: 'success',
			icon : 'fa fa-plus',
			message : getMessage(message),
			container : 'floating',
			timer : 3000
		});
	}

	function error(message){
		$.niftyNoty({
			type: 'danger',
			icon : 'fa fa-minus',
			message : getMessage(message),
			container : 'floating',
			timer : 4000
		});
	}

	$( document ).ajaxStart(function() {
	    $( "#preloader-wrapper" ).removeClass('no-display');
	    $( ".preloader-wave-effect" ).removeClass('no-display');
	});

	$( document ).ajaxStop(function() {
	    $( "#preloader-wrapper" ).addClass('no-display');
	    $( ".preloader-wave-effect" ).addClass('no-display');
	});

</script>