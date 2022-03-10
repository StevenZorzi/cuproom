@extends('templates.template-admin', ['title' => 'menu.requests'])  

@section('content')
    
	<div class="row">

		<!-- COLONNA MAIN -->
		<div class="col-md-7">
			<div class="panel">
			    <div class="panel-heading">
					<div class="panel-control">
						
					</div>
					<h3 class="panel-title">
						{{ucfirst(trans('interface.request'))}}
					</h3>
				</div>

			    <div class="panel-body edit-page">

					<div class="row">
				    	<div class="col-sm-12 text-2x">
				    		<p><b>
				    			{{ $request->subject }}
				    		</b></p>
						</div>
					</div>

					<div class="row mar-btm">
						<div class="col-sm-12 text-2x">
							{!! nl2br($request->message) !!}
						</div>
					</div>

			 	</div>
			 	<div class="panel-footer text-left">

			 		<b>Mittente:</b> &nbsp; {{$request->name}} {{$request->surname}}<br>
			 		<b>Azienda:</b> &nbsp; {{$request->company}}<br>
			 		<b>Contatti:</b> &nbsp; {{$request->email}} &nbsp; {{$request->phone}}<br> 
			 	</div>
			</div>
			<!-- fine pannello -->
		</div>



		<!-- COLONNA DESTRA DATI GENERALI-->

		<div class="col-md-5 others-data">

				<!-- STATO -->
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-control">
							
						</div>
						<h3 class="panel-title">@lang('interface.status')</h3>
					</div>
					<div class="panel-body">
						<div class="col-sm-12">
							<label class="mar-btm text-left">Risposta</label>
							<span class="mar-btm pull-right">
								<input name="response" id="response" class="form-control switchery" type="checkbox" value="1" @if($request->response) checked @endif >
							</span>	
						</div>
						<div class="col-sm-12">
							<label>@lang('interface.date') @lang('interface.request')</label>
							<span class="pull-right mar-btm text-right">{{$request->created_at->formatLocalized('%d %h %Y %H:%M')}}</span>
						</div>
						
						@if($request->referral)
						@php 
						$ref = $request->referral;
						@endphp
							<div class="col-sm-4">

								<label>Riferimento</label><br>
							
	                        	<a href="{{route($ref->getTable().'.edit', ['obj' => $ref->id])}}" target="_blank"><img class="img-responsive" src="{{$ref->preview()}}"></a>
	                        </div>
						@endif
						
					</div>
				</div>

		</div>

	</div>


	<div class="row">
		<hr>
		<div class="mar-btm mar-top text-center">
			<button id="delete" class="btn btn-danger btn-rounded btn-sm btn-labeled fa fa-trash" data-action="{{route('requests.destroy', ['request' => $request->id])}}">@lang('interface.delete') @lang('interface.request')</button>
		</div>
	</div>
	
@stop

@section('modals')
    

@stop

@section('page-script')

	{!! Html::script('plugins/switchery/switchery.min.js') !!}
	
	<script>
		var lang = "{{ $lang }}";
		var ref_id = "{{ $request->id }}";

		url['update'] = "{{route('requests.update', ['request' => $request->id])}}";
		url['list'] = "{{route('requests.index')}}";

		message['ok_response'] = "Richiesta aggiornata";
		message['no_response'] = "Errore durante l'operazione";
	</script>

	<script>
		new Switchery(document.getElementById('response'));

		$(document).on('change','#response', function(){

			if($(this).is(':checked')){
				$.post(getUrl('update'), {response: '1', _method: 'PUT'}).done(function(response){
		      		success('ok_response');
		      	});
			}else{
				$.post(getUrl('update'), {response: '0', _method: 'PUT'}).done(function(response){
		      		success('no_response');
		      	});
			}

		});


		$(window).on('load', function() {

			$("#delete").on('click', function(){

		    	var button = $(this);
		    	var url_list = url['list'];

		    	bootbox.confirm({
					title: "<h4>Eliminare questa richiesta?</h4>",
				    message: "<p class='text-normal'>La richiesta sarà eliminata definitivamente.</p>",
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

		});

	</script>

    
@stop