@extends('templates.template-admin', ['title' => 'menu.categories'])  

@section('content')
    
    <div class="row">
    	<div class="col-md-4">
    		
    		<form id="form-add-category" action="{{route('categories.store', ['module' => trans('settings.module-'.$module->category_id.'-slug')])}}" method="POST">
    			{{ csrf_field() }}
	    		<div class="panel">
	    			<div class="panel-heading">
						<div class="panel-control">
							
						</div>
						<h3 class="panel-title">
							Nuova Categoria
						</h3>
					</div>

				    <div class="panel-body">
				    	
		              	<div class="row">
		                	<div class="col-md-12">
		                		
		                		<div class="form-group">
		                			<label class="label-control">Lingua</label>
			                		<select class="form-control selectpicker" name="lang">
						            	@foreach($suppLangs as $localeCode => $language)
						            		<option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
						            	@endforeach
					            	</select>
				            	</div>
				            	<div class="form-group">
				            		<label class="label-control">Sottocategoria di</label>
			                		<select class="form-control selectpicker" name="parent" data-live-search="true">
					            		<option value="{{$module->category_id}}">Nessuna...</option>
					            		{!!print_categories($categories, $module->category_id)!!}
					            	</select>
				            	</div>
				            	<div class="form-group">
				            		<label class="label-control">Nome</label>
			                    	<input type="text" class="form-control" name="name" placeholder="Nome categoria">
			                    </div>
			                    <div class="form-group">
									<label>Meta Title</label>
									<input class="form-control" name="meta_title" placeholder="Metatag title pagina listing">
								</div>
								<div class="form-group">
									<label>Meta Description</label>
									<textarea rows="4" class="form-control" name="meta_description" placeholder="Metatag description pagina listing"></textarea>
								</div>
		                	</div>
		              	</div>
				    </div>
				    <div class="panel-footer text-right">
				    	<button type="submit" class="btn btn-success btn-rounded btn-labeled btn-control fa fa-refresh">Salva</button>
				    </div>
	    		</div>
    		</form>
    	</div>
    	<div class="col-md-8">
 		
    		@include('admin.pages.categories-tree', ['categories' => $categories, 'parentId' => $module->category_id])
   
		</div>
	</div>
	<div class="row">
		<br><hr><br>
		<div class="col-md-12">
			
			<div class="panel single-category macro-category">
				<div class="panel-heading">
					<div class="panel-control">
						
					</div>
					<h3 class="panel-title">
						MetaTag {{$module->name}}
					</h3>
				</div>

			    <div class="panel-body">

			    	<div class="tab-base tab-stacked-left">

						<!--Nav tabs-->
						<ul class="nav nav-tabs">

							@foreach($main_category->data as $trans)
								@if(array_key_exists($trans->lang, $suppLangs))
								<li @if($loop->index == 0) class='active' @endif>
									<a data-toggle="tab" href="#tab-{{$main_category->id}}{{$trans->lang}}" class="text-center tab-trans" data-trans="{{$trans->lang}}">
										<img class="lang-flag" src="{{asset('img/flags/'.$trans->lang.'.png')}}">
									</a>
								</li>
								@endif
							@endforeach
							
							<li class="tab-add @if($main_category->data->count() >= count($suppLangs)) no-display @endif">
								<a class="btn-hover-info add-tooltip text-center" data-placement="top" data-target="#add-trans" data-toggle="modal" data-original-title="Aggiungi traduzione">
									<i class="fa fa-plus fa-lg" aria-hidden="true"></i>
								</a>
							</li>
							
						</ul>

						<!--Tabs Content-->
						<div class="tab-content">
							@foreach($main_category->data as $trans)
								
								@if(array_key_exists($trans->lang, $suppLangs))

								<div id="tab-{{$main_category->id}}{{$trans->lang}}" class="tab-pane fade @if($loop->index == 0) active in @endif">
									<form id="form-update-meta" action="{{route('categories.update', ['module' => trans('settings.module-'.$main_category->id.'-slug'), 'category' => $main_category->id])}}">

										<div class="col-md-12 text-right">
							                <div class="btn-group lang-manage" data-id="{{$trans->id}}">
								              	<button type="button" class="save btn btn-sm btn-default btn-icon btn-hover-success fa fa-refresh add-tooltip" data-original-title="Salva" data-container="body" data-action="{{route('categories.update', ['module' => trans('settings.module-'.$main_category->id.'-slug'), 'category' => $main_category->id])}}"></button>
								              	
								            </div>
					                	</div>
					                	
										<div class="col-md-12">
											{{ method_field('PUT') }}
											<input type="hidden" class="text-thin" name="trans" value="{{$trans->id}}">
											<div class="form-group">
												<label>Meta Title</label>
												<input class="form-control" name="meta_title" value="{{$trans->metaTag() ? $trans->metaTag()->title : ''}}" placeholder="Metatag title pagina listing">
											</div>
											<div class="form-group">
												<label>Meta Description</label>
												<textarea rows="4" class="form-control" name="meta_description" placeholder="Metatag description pagina listing">{{$trans->metaTag() ? $trans->metaTag()->description : ''}}</textarea>
											</div>
										</div>
										
									</form>	
								</div>
								@endif
								
							@endforeach

						</div>
					</div>

			    </div>
			</div>
		</div>

	</div>
	
@stop

@section('modals')


	<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

	<div class="modal fade" id="add-trans" role="dialog" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog">
		    <div class="modal-content">
		        <!-- BASIC FORM ELEMENTS -->
		        <!--===================================================-->

		        <form id="form-add-trans" action="{{route('categories.store', ['module' => trans('settings.module-'.$module->category_id.'-slug')])}}" method="POST">
    			{{ csrf_field() }}

			        <!--Modal header-->
			        <div class="modal-header">
			        	<button data-dismiss="modal" class="close" type="button">
			            <span aria-hidden="true">&times;</span>
			            </button>
			            <h4 class="modal-title">Aggiungi lingua</h4>
			        </div>

			        <!--Modal body-->
			        <div class="modal-body">

			            <div class="row">
		                	<div class="col-md-12">

		                		<input type="hidden" name="ref">
		                		
		                		<div class="form-group">
		                			<label class="label-control">Lingua</label>
			                		<select class="form-control selectpicker" name="lang">
					            		<option value="">Seleziona lingua...</option>
						            	@foreach($suppLangs as $localeCode => $language)
						            		<option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
						            	@endforeach
					            	</select>
				            	</div>
				            	<div class="form-group">
				            		<label class="label-control">Nome</label>
			                    	<input type="text" class="form-control" name="name" placeholder="Nome lingua" value="">
			                    </div>
			                    <div class="form-group">
									<label>Meta Title</label>
									<input class="form-control" name="meta_title" placeholder="Metatag title pagina listing">
								</div>
								<div class="form-group">
									<label>Meta Description</label>
									<textarea rows="4" class="form-control" name="meta_description" placeholder="Metatag description pagina listing"></textarea>
								</div>
		                	</div>
		              	</div>
			            
			        	<div class="clearfix"></div><br>
			          <!--===================================================-->
			          <!-- END BASIC FORM ELEMENTS -->
			        </div>
			        <!--Modal footer-->
			        <div class="modal-footer">
			        	<button type="submit" class="btn btn-success btn-rounded btn-labeled btn-control fa fa-refresh">Salva</button>
			        </div>
		        </form>
	      </div>
	    </div>
	</div>

	<!--End Modal-->
    

@stop

@section('page-script')
	
	<script>
		var lang = "{{$lang}}";
		
		url['check_slug'] = "{{route('categories-check-slug', ['table' => 'categories'])}}";

		$(window).on('load', function() {

    		//Messaggio impostazioni salvate
    		@if(Session::has("ok-add"))
    			message['ok-add'] = '{{Session::get("ok-add")}}';
    			success('ok-add');
	        @endif
	    });
	</script>

	{!! Html::script('js/pages/admin/category.js') !!}
    
@stop