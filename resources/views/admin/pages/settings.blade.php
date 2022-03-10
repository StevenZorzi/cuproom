@extends('templates.template-admin', ['title' => 'menu.settings'])    

@section('content')
		
	<div class="row">

		<!-- GESTIONE LINGUE -->

		<div class="col-md-6">
			<div class="panel">
			    <div class="panel-heading">
			      	<div class="panel-control">
			        	<button class="btn btn-primary btn-rounded btn-labeled btn-control fa fa-plus" data-target="#add-language-modal" data-toggle="modal">Aggiungi</button>
			      	</div>
			      	<h3 class="panel-title">Lingue Attive <small>(Front-end)</small></h3>
			    </div>

			    <div class="panel-body">
			    	<small>La prima lingua in lista sarà impostata come lingua principale.</small><br><br>
			      	<div class="list-group ui-sortable" id="sortable">
			        	
			        	@foreach($languages as $language)
				        <a id="v_{{$language->id}}" class="ui-state-default list-group-item ui-sortable-handle @if(!array_key_exists($language->slug, $suppLangs)) bg-danger @endif">
				            <form>
				              	<div class="row">
					                <div class="col-md-3">
					                    <label class="form-control">{{$language->slug}}</label>
					                </div>
				                	<div class="col-md-6">
					                    <input type="text" class="form-control" name="name" placeholder="Nome lingua" value="{{$language->name}}">
				                	</div>
				                	<div class="col-md-3 text-center">
						                <div class="btn-group languages" data-id="{{$language->id}}">
							              	<button type="button" class="save btn btn-sm btn-default btn-icon btn-hover-success fa fa-refresh add-tooltip" data-original-title="Salva"></button>
							              	<button type="button" class="delete btn btn-sm btn-default btn-icon btn-hover-danger fa fa-times add-tooltip" data-original-title="Elimina"></button>
							            </div>
				                	</div>
				              	</div>
				            </form>
				        </a>
				        @endforeach
			    	</div>
			 	</div>
			</div>
		</div>


		<!-- GESTIONE MODULI -->

		<div class="col-md-6">
			<form id="modules" action="{{route('update-settings-modules')}}" method="POST">
				{{ csrf_field() }}
				<div class="panel only-header">
					<!--Panel heading-->
					<div class="panel-heading">
						<div class="panel-control">
							<button type="submit" class="btn btn-success btn-rounded btn-labeled btn-control fa fa-refresh">Salva</button>
						</div>
						<h3 class="panel-title">Configurazione Moduli</h3>
					</div>
				</div>
				
				<div class="tab-base tab-stacked-left">
					<!--Nav tabs-->
					<ul class="nav nav-tabs">
						@foreach($modules as $module)
							<li class="@if($loop->first) active @endif">
								<a class="text-primary text-bg" data-toggle="tab" href="#tab-{{$loop->iteration}}" aria-expanded="{{$loop->first ? 'true' : 'false'}}"><span class="badge @if($module->active) badge-success @endif"> </span> &nbsp; @lang('settings.module-'.($loop->iteration))</a>
							</li>
						@endforeach
						
					</ul>
					<!--Tabs Content-->
					<div class="tab-content">

						@foreach($modules as $module)
						<div id="tab-{{$loop->iteration}}" class="tab-pane fade @if($loop->first) active in @endif">
							<div class="row">
								<div class="col-sm-12 text-center mar-btm">
									<small class="text-muted">Attivato</small> &nbsp;
									<input name="module_active[{{$module->id}}]" id="active{{$loop->iteration}}" class="form-control switchery" type="checkbox" value="1" @if($module->active) checked @endif>
								</div>
							</div>
							<div class="mar-top">
								<p class="text-center mar-top"><small>Accesso</small></p>
								<select name="module_roles[{{$module->id}}][]" class="selectpicker" multiple data-container="body" data-width="100%">
									<option value="superadmin" selected disabled>Superadmin</option>
									<option value="admin" @if(in_array("admin", $module->roles)) selected @endif>Admin</option>
									<option value="user" @if(in_array("user", $module->roles)) selected @endif>User</option>
								</select>
							</div>

							<p class="text-center mar-top"><small>Nome modulo</small></p>
							@foreach($suppLangs as $localeCode => $language)
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
					                    <span class="input-group-addon"><img src="{{ asset('img/flags/'.$localeCode.'.png') }}"></span>
					                    <input type="text" class="form-control" name="module_data[{{$module->id}}][{{$localeCode}}][name]" value="{{$module->getText($localeCode)->name}}">
					                </div>
				                </div>
			                </div>
			                @endforeach
			                <p class="text-center mar-top"><small>Slug</small></p>
			                @foreach($suppLangs as $localeCode => $language)
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group">
					                    <span class="input-group-addon"><img src="{{ asset('img/flags/'.$localeCode.'.png') }}"></span>
					                    <input type="text" class="form-control" name="module_data[{{$module->id}}][{{$localeCode}}][slug]" value="{{$module->getText($localeCode)->slug}}">
					                </div>
				                </div>
			                </div>
			                @endforeach

						</div>
						@endforeach
						
					</div>
				</div>
			</form>
		</div>
	</div>


	<!-- ATTIVAZIONE MODALITA' MANUTENZIONE -->
	
	<div class="panel">
				
		<!--Panel heading-->
		<div class="panel-heading">
			<div class="panel-control">
				<small class="text-muted">Attivazione modalit&agrave; manutenzione</small>
				<input name="maintenance" id="maintenance" class="route_enabled form-control" type="checkbox" value="1" @if(App::isDownForMaintenance()) checked @endif>
			</div>
			<h3 class="panel-title">Modalit&agrave; manutenzione</h3>
		</div>

		<!--Panel body-->
		<div class="panel-body">
			<textarea name="maintenance-text" id="maintenance-text"></textarea>
		</div>
	</div>


@stop



@section('modals')

	<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

	<div class="modal fade" id="add-language-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
	    <div class="modal-dialog">
		    <div class="modal-content">
		        <!-- BASIC FORM ELEMENTS -->
		        <!--===================================================-->
		        <form action="{{ route('add-settings-language') }}" method="POST">
			        {{ csrf_field() }}

			        <!--Modal header-->
			        <div class="modal-header ">
			        	<button data-dismiss="modal" class="close" type="button">
			            <span aria-hidden="true">&times;</span>
			            </button>
			            <h4 class="modal-title">Aggiungi lingua</h4>
			        </div>

			        <!--Modal body-->
			        <div class="modal-body">

			            <div class="row">
				            <div class="col-md-4 col-md-offset-1">
				            	<div class="form-control">
					            	<label class="control-label">Slug</label>
					            	<select class="form-control selectpicker" name="slug">
					            		<option data-desc="" value="">Seleziona lingua...</option>
						            	@foreach($suppLangs as $localeCode => $language)
						            		@if(!in_array($localeCode, array_pluck($languages, 'slug')))
						            			<option data-desc="{{$language['native']}}" value="{{$localeCode}}">{{$localeCode}} &nbsp; ({{$language['native']}})</option>
						            		@endif
						            	@endforeach
					            	</select>
					            </div>
				            </div>
				            <div class="col-md-6">
				            	<div class="form-control">
					            	<label class="control-label">Rinomina</label>
						            <input type="text" class="form-control" name="name" placeholder="Inserire nome lingua...">
					            </div>
				              	
				            </div>
				        </div>
			            
			        	<div class="clearfix"></div><br>
			          <!--===================================================-->
			          <!-- END BASIC FORM ELEMENTS -->
			        </div>
			        <!--Modal footer-->
			        <div class="modal-footer">
			        	<button data-dismiss="modal" class="btn btn-default btn-rounded">Annulla</button>
			          	<button class="btn btn-primary btn-rounded">Aggiungi</button>
			        </div>
		        </form>
	      </div>
	    </div>
	</div>

	<!--End Modal-->

@stop



@section('page-script')
	{!! Html::script('plugins/ui-jquery/jquery-ui.min.js') !!}
    {!! Html::script('plugins/switchery/switchery.min.js') !!}
    {!! Html::script('plugins/summernote/summernote.min.js') !!}

    <script>

		//url
		url['reorder_url'] = "{{route('reorder-settings-languages')}}";
		url['update_url'] = "{{route('update-settings-language')}}";
		url['delete_url'] = "{{route('delete-settings-language')}}";

		url['artisan_maintenance'] = "{{route('artisan-maintenance')}}";

		//messaggi

		message['already-exist'] = '{{Session::get("already-exist")}}';
		message['maintenance_text'] = 'Inserire il testo che comparirà nella pagina di manutenzione...';
		message['ko_delete_text'] = 'Attenzione! Si è verificato un errore, lingua non cancellata.';
		message['ok_update_text'] = 'Dati lingua aggiornati';
		message['ko_update_text'] = 'Attenzione! Si è verificato un errore durante il salvataggio dei dati.';

    </script>

    {!! Html::script('js/pages/admin/settings.js') !!}

    <script>
    	$(window).on('load', function() {

    		//Messaggio impostazioni salvate
    		@if(Session::has("ok-update"))
    			message['ok-update'] = '{{Session::get("ok-update")}}';
    			success('ok-update');
	        @endif

	        //Messaggio variante aggiunta già esistente
	        @if(Session::has("already-exist"))
	        	message['already-exist'] = '{{Session::get("already-exist")}}';
    			error('already-exist');
	        @endif

        });
    </script>

@stop