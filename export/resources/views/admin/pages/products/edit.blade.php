@extends('templates.template-admin', ['title' => 'menu.products'])  

@section('content')
    
    <div class="row">

    	<div class="col-md-12">
	    	<form id="form-update-main" action="{{route('products.update', ['product' => $product->id])}}" method="POST">
	        
	        {{ csrf_field() }}

			<input type="hidden" name="main" value="{{$product->id}}">
			<input type="hidden" name="_method" value="PUT">

		    	<div class="panel">
				    <div class="panel-heading">
						<div class="panel-control">
							<button type="submit" class="btn btn-success btn-sm btn-rounded btn-labeled btn-control fa fa-refresh" disabled>@lang('interface.save')</button>
						</div>
						<h3 class="panel-title">
							@lang('interface.gen-data')
						</h3>
					</div>
					<div class="panel-body">
						
						<div class="col-sm-6 col-sm-push-6 col-md-5 col-md-push-7 ">
							<!-- STATO -->
							<table style="width:100%">
								<tr>
									<td>
										<label class="mar-btm"><small>@lang('interface.published')</small></label></td>
									<td class="text-right">
										<div class="mar-btm">
											<input name="active" id="active" class="form-control switchery" type="checkbox" value="1" @if($product->active) checked @endif >
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label><small>@lang('interface.created-at')</small></label>
									</td>
									<td class="text-right">
										<div id="date-created_at">
											<div class="form-group time">
				                                <input type="text" class="pull-right mar-btm form-control text-right" name="time_created_at" placeholder="ore:min" value="{{$product->created_at->format('H:i')}}" style="width:65px; background:#fff" readonly>
				                            </div>
				                            <div class="form-group date">
				                                <input type="text" class="pull-right mar-btm form-control text-right" name="date_created_at" placeholder="gg/mm/aaaa" value="{{$product->created_at->format('d/m/Y')}}" style="width:90px">
				                            </div>
				                            
				                        </div>
									</td>
								</tr>
								<tr>
									<td>
										<label><small>@lang('interface.updated-at')</small></label>
									</td>
									<td class="text-right">
										<small>{{$product->updated_at->formatLocalized('%d %h %Y %H:%M')}}</small>
									</td>
								</tr>
								<tr>
									<td>
										<label><small>@lang('interface.created-by')</small></label>
									</td>
									<td class="text-right">
										<small>{{$creator->name}} {{$creator->surname}}</small>
									</td>
								</tr>
							</table>
						</div>
						<hr class="visible-xs">
						<div class="col-sm-6 col-sm-pull-6 col-md-5 col-md-pull-5">
							
							<div class="form-group">
		                        <div class="input-group mar-btm">
		                          	<span class="input-group-addon"><i class="fa fa-folder-open-o fa-lg"></i></span>
		                          	<select name="collection" class="form-control">
		                          		<option>Collection...</option>
		                          		<option value="cuproom" @if($product->collection == 'cuproom') selected @endif>Cuproom Original</option>
		                          		<option value="4season" @if($product->collection == '4season') selected @endif>4 Season</option>
		                          	</select>
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <div class="input-group mar-btm">
		                          <span class="input-group-addon"><i class="fa fa-barcode fa-lg"></i></span>
		                          <input type="text" name="code" class="form-control" placeholder="Codice" value="{{$product->code}}">
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <div class="input-group mar-btm">
		                          <span class="input-group-addon"><i class="fa fa-eur fa-lg"></i></span>
		                          <input type="text" name="price" class="form-control" placeholder="Prezzo" value="{{$product->price}}">
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <div class="input-group mar-btm">
		                          <span class="input-group-addon"><i class="psi-structure fa-lg"></i></span>
		                          <input type="text" name="dimensions" class="form-control" placeholder="Dimensioni" value="{{$product->dimensions}}">
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <div class="input-group mar-btm">
		                          <span class="input-group-addon"><i class="ion-pinpoint fa-lg"></i></span>
		                          <textarea type="text" name="interactive" class="form-control" placeholder="Codice interattivo" cols="1" rows="5" style="resize: vertical; min-height: 80px">{{$product->interactive}}</textarea>
		                        </div>
		                    </div>
		                    
		                    
						</div>
					</div>
				</div>
			</form>
		</div>
    </div>



	<div class="row">

		<!-- COLONNA MAIN -->
		<div class="col-md-12">

	    	<div class="tab-base tab-stacked-left">
			<!--Nav tabs-->
			<ul id="main-tab" class="nav nav-tabs" style="width:140px">
				<li class="active">
					<a class="text-primary text-bg" data-toggle="tab" href="#tab-lang" aria-expanded="true">@lang('interface.lang-data')</a>
				</li>
				<li>
					<a class="text-primary text-bg" data-toggle="tab" href="#tab-assoc" aria-expanded="false">Associazioni</a>
				</li>
				<li>
					<a class="text-primary text-bg" data-toggle="tab" href="#tab-images" aria-expanded="false">@lang('interface.images')</a>
				</li>
				<li>
					<a class="text-primary text-bg" data-toggle="tab" href="#tab-files" aria-expanded="false">Documenti</a>
				</li>
				
			</ul>
			

			<!-- DATI IN LINGUA -->
			<div class="tab-content" style="overflow: visible;">

				<div id="tab-lang" class="tab-pane fade active in">

					<div class="panel">
					    <div class="panel-heading">
					    	@if(count($suppLangs) > 1 || $translates->count() > 1 )
							<div class="panel-control">
								<ul class="nav nav-tabs">
									@foreach($translates as $trans)
									<li @if($loop->first) class="active" @endif>
										<a data-toggle="tab" href="#tab-{{$trans->lang}}">
											<img class="lang-flag" src="{{ asset('img/flags/'.$trans->lang.'.png') }}">
										</a>
									</li>
									@endforeach

									@if($translates->count() < count($suppLangs))
									<li class="tab-add">
										<a class="btn-hover-info add-tooltip" data-placement="top" data-target="#add-trans" data-toggle="modal" data-original-title="@lang('interface.add') @lang('interface.trans')">
											<i class="fa fa-plus fa-lg" aria-hidden="true"></i>
										</a>
									</li>
									@endif
								</ul>
							</div>
							@endif
							<h3 class="panel-title">
								@lang('interface.lang-data')
							</h3>
						</div>

					    <div class="panel-body edit-page">

							<div class="tab-content">
							    @foreach($translates as $trans)

								    <div id="tab-{{$trans->lang}}" class="tab-pane fade @if($loop->first)active in @endif">
								    	
								    	<form class="form-update-trans" action="{{route('products.update', ['product' => $product->id])}}" method="POST">
			              					
			              					{{ csrf_field() }}

			              					<input type="hidden" name="obj" value="{{$product->id}}">
			              					<input type="hidden" name="trans" value="{{$trans->lang}}">
			              					<input type="hidden" name="trans_id" value="{{$trans->id}}">
			              					<input type="hidden" name="_method" value="PUT">

									    	<div class="row">
									    		<div class="col-sm-12">
											    	<div class="mar-btm mar-top">
											    		<a href="{{frontUrl($module_id, $trans->lang, $trans->slug)}}" target="_blank" class="view btn btn-default btn-sm btn-rounded btn-labeled btn-control fa fa-link"> @lang('interface.view')</a>
											    		<button type="submit" target="_blank" class="btn btn-success btn-sm btn-rounded btn-labeled btn-control fa fa-refresh pull-right" disabled> @lang('interface.save')</button>
											    	</div>
										    	</div>
									    	</div>

											<div class="row">
										    	<div class="col-sm-12">
										    		<div class="form-group">
										    			<input class="form-control title" name="name" placeholder="Nome" value="{{$trans->name or 'Nuovo Prodotto'}}">
										    		</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group url-slug">
										    			<p class="text-primary"><span class="url-prefix">{{frontUrl($module_id, $trans->lang)}}/</span><input class="slug" name="slug" value="{{$trans->slug or 'nuovo-prodotto' }}"></p>
										    		</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-12">
													<textarea class="content" name="content">{!!$trans->description!!}</textarea>
													<br>
												</div>
											</div>

											<div class="row mar-btm">
												<div class="col-sm-12">
													<textarea class="data_sheet" name="data_sheet">{!!$trans->data_sheet!!}</textarea>
													<br>
												</div>
											</div>

											<div class="row mar-top">
												<div class="col-sm-12">
													<h3 class="text-normal mar-btm">Metatag SEO</h3>
													<hr>
													<div class="form-group">
														<label>@lang('interface.page-title')</label>
														<input class="form-control" name="meta_title" value="{{$trans->metaTag() ? $trans->metaTag()->title : ''}}">
													</div>
													<div class="form-group">
														<label>@lang('interface.page-desc')</label>
														<textarea rows="4" class="form-control" name="meta_description">{{$trans->metaTag() ? $trans->metaTag()->description : ''}}</textarea>
													</div>
												</div>
											</div>

										</form>

									</div>
									<!-- fine tab traduzione -->
								@endforeach
							</div>

					 	</div>
					 	@if($translates->count() > 1)
					 	<div class="panel-footer text-center">
					 		<button class="delete-trans btn btn-danger btn-xs btn-rounded btn-labeled fa fa-trash" data-action="{{route('products.destroy', ['product' => $product->id])}}" data-lang="{{$trans->lang}}">@lang('interface.delete') @lang('interface.trans')</button>
					 	</div>
					 	@endif
					</div>
				</div>


				<!-- ASSOCIAZIONI VARIANTI CATEGORIE BRANDS -->
				<div id="tab-assoc" class="tab-pane fade" style="overflow: visible;">

					<form class="form-update-assoc" action="{{route('products.update', ['product' => $product->id])}}" method="POST">


						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="assoc" value="assoc">
						{{ csrf_field() }}

						<div class="col-sm-12">
					    	<div class="mar-btm">
					    		<button type="submit" target="_blank" class="btn btn-success btn-sm btn-rounded btn-labeled btn-control fa fa-refresh pull-right" disabled=""> Salva</button>
					    	</div>
				    	</div>

						<!-- ASSOCIAZIONE VARIANTI -->
						<div class="col-sm-7">

							
							<h3 class="text-normal mar-btm">Associazione varianti</h3>
							<hr>
							<div class="form-group">
						        <small class="control-label">{{ucfirst(trans('interface.size'))}}</small><br>
						        <select class="selectpicker" multiple title="Associa varianti {{ucfirst(trans('interface.size'))}} al prodotto" name="size[]" data-width="100%" data-container="body">
						          	@foreach ($sizes as $size)
						            	<option value="{{ $size->id }}" {{ select_if($size->id, $product->size) }}>{{ $size->getMainText()->name }}</option>
						          	@endforeach
						        </select>
					        </div>

					        <div class="form-group">
						        <small class="control-label">Colore / Tipo</small><br>
						        <select class="selectpicker" multiple title="Associa varianti colore al prodotto" name="color[]" data-width="100%" data-container="body">
						          	@foreach ($colors as $color)
						            	<option value="{{ $color->id }}" {{ select_if($color->id, $product->color) }}>{{ $color->getMainText()->name }}</option>
						          	@endforeach
						        </select>
					        </div>
							

					        @can('view', App\Models\Core\Module::find(6))
					        <br>
					        <h3 class="text-normal mar-btm">Associazione @lang('interface.brands')</h3>
							<hr>
							<div class="form-group">
						        <select id="demo-cs-multiselect" data-placeholder="Specificare uno o più @lang('interface.brands') per questo progetto" multiple name="brand[]">
								    @foreach ($brands as $brand)
						            	<option value="{{ $brand->id }}" {{ select_if($brand->id, $brands_assoc) }}>{{ $brand->getMainText()->name }}</option>
						          	@endforeach
								</select>
							</div>
							@endcan

							
							<br>
					        <h3 class="text-normal mar-btm">Varianti</h3>
							<hr>
							@forelse($variants as $variant)
								@if($loop->first)
									<p>Varianti di questo prodotto:</p>
									<div class="row">
								@endif
								<div class="col-xs-6 col-sm-4 bord-all">
									<img class="img-responsive" src="{{asset($variant->preview())}}">
									<p class="text-center"><a href="{{route('products.edit', ['product' => $variant->id])}}" class="text-primary">{{$variant->getMainText()->name}}</a></p>
	                            </div>
	                            @if($loop->last)
									</div>
								@endif
	                        @empty

	                        	<div class="form-group">
	                        		<label>Questo prodotto è una variante di:</label>
							        <select class="form-control selectpicker" name="parent" data-width="100%" data-container="body">
	                                  	<option value="">Nessuno...</option>
		                                @foreach($parents as $parent)
		                                <option value="{{$parent->id}}" data-content="{{select_products($parent, $product->parent_id)}}" @if($parent->id == $product->parent_id) selected @endif></option>
		                                @endforeach
	                              	</select>
								</div>

	                        @endforelse
	                        


						</div>

						<!-- CATEGORIE -->
						<div class="col-sm-4 col-sm-offset-1">
								
							<h3 class="text-normal mar-btm">@lang('interface.categories')</h3>
							<hr>
							<div class="mar-btm">
								<small>Selezionare le categorie in cui far comparire questo prodotto</small>
							</div>
							<div id="jstree">
								{!!print_cat_tree($categories, $module_id, $cat_assoc)!!}
							</div>
						</div>

					</form>

				</div>



				<!-- IMMAGINI -->
				<div id="tab-images" class="tab-pane fade">

					<div class="col-md-8">
						<div class="panel">
						    <div class="panel-heading">
						      	<h3 class="panel-title">@lang('interface.images')</h3>
						    </div>

						    <div class="panel-body">
						      	{!! Form::open(['url' => route('products-upload-img', ['product' => $product->id ]), 'class' => 'dropzone', 'files'=>true, 'id'=>'img-upload']) !!}
						      
							        <div class="dz-message">

							        </div>

							        <div class="fallback">
							            <input name="file" type="file" multiple />
							        </div>

							        <div class="dropzone-previews" id="dropzonePreview"></div>

						      	{!! Form::close() !!}
						    </div>
						</div>
					</div>

					<div class="col-md-4">
						
						<div class="panel preview @if($preview == 'img/noimg.jpg') hide @endif">
						    <div class="panel-heading">
						      <h3 class="panel-title">@lang('interface.preview-img')</h3>
						    </div>

						    <div class="panel-body">
						      	<img class="img-responsive" src="{{asset($product->preview())}}">
						    </div>
						</div>
					
					</div>

				</div>

				<!-- FILES -->
				<div id="tab-files" class="tab-pane fade">

					<div class="col-md-12">
						<div class="panel">
						    <div class="panel-heading">
						      	<h3 class="panel-title">Documenti</h3>
						    </div>

						    <div class="panel-body">
						      	{!! Form::open(['url' => route('products-upload-fls', ['product' => $product->id ]), 'class' => 'dropzone', 'files'=>true, 'id'=>'fls-upload']) !!}
						      
							        <div class="dz-message">

							        </div>

							        <div class="fallback">
							            <input name="file" type="file" multiple />
							        </div>

							        <div class="dropzone-previews" id="dropzoneFilesPreview"></div>

						      	{!! Form::close() !!}
						    </div>
						</div>
					</div>

				</div>

	
			</div>

		</div>
		</div>


	</div>

	<div class="row">
		<hr>
		<div class="mar-btm mar-top text-center">
			<button id="delete" class="btn btn-danger btn-rounded btn-sm btn-labeled fa fa-trash" data-action="{{route('products.destroy', ['product' => $product->id])}}">@lang('interface.delete') Prodotto</button>
		</div>
	</div>
	
@stop

@section('modals')
    
    <!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

	<div class="modal fade" id="add-trans" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <!-- BASIC FORM ELEMENTS -->
	            <!--===================================================-->
	            <form id="form-add-trans" action="{{route('products.store')}}" method="POST">
	              	{{ csrf_field() }}

		            <!--Modal header-->
		            <div class="modal-header ">
		                <button data-dismiss="modal" class="close" type="button">
		                 	<span aria-hidden="true">&times;</span>
		                </button>
		                <h4 class="modal-title">@lang('interface.add') @lang('interface.trans')</h4>
		            </div>

	              	<!--Modal body-->
	              	<div class="modal-body">

	              		<input type="hidden" value="{{$product->id}}" name="id">
		                <div class="row">
			                <div class="col-md-6">
			                    <div class="form-group">
				                    <select class="form-control selectpicker" name="lang">
				                        <option value="">Seleziona per quale lingua...</option>
				                        @foreach(Localization::getSupportedLocales() as $localeCode => $language)
					                        @if(!in_array($localeCode, array_pluck($translates, 'lang')))
					                        <option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
					                        @endif
				                        @endforeach
				                    </select>
			                    </div>
			                </div>
			           	</div>
			            <div class="row">
			                <div class="col-md-12">
			                    <div class="form-group">
			                      	<input type="text" class="form-control title-modal" name="name" placeholder="Inserire nome prodotto...">
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
	                	<button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
	              	</div>
	            </form>
	        </div>
	    </div>
	</div>

  <!--End Modal-->

@stop

@section('page-script')


	{!! Html::style('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}
    {!! Html::script('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}
    {!! Html::script('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.it.min.js') !!}
    {!! Html::style('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}
    {!! Html::script('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') !!}

	{!! Html::script('plugins/ui-jquery/jquery-ui.min.js') !!}

	{!! Html::script('plugins/switchery/switchery.min.js') !!}
	{!! Html::script('plugins/summernote/summernote.min.js') !!}
	
	<script>
		var lang = "{{ $lang }}";
		var ref_id = "{{ $product->id }}";
		url['change_cat'] = "{{route('products.update', ['product' => $product->id])}}";
		url['path_products_img'] = "{{url(config('paths.products_img').$product->id)}}";
		url['get_img'] = "{{route('products-get-img', ['product' => $product->id])}}";
		url['get_img_info'] = "{{route('get-img-info')}}";
		url['update_img_info'] = "{{route('update-img-info')}}";
		url['delete_img'] = "{{route('products-delete-img', ['product' => $product->id])}}";
		url['get_fls'] = "{{route('products-get-fls', ['product' => $product->id])}}";
		url['delete_fls'] = "{{route('products-delete-fls', ['product' => $product->id])}}";
		url['path_doc_thumb'] = "{{url(config('paths.doc_thumb'))}}";

		url['reorder_url'] = "{{route('reorder-images')}}";
		url['update'] = "{{route('products.update', ['product' => $product->id])}}";
		url['list'] = "{{route('products.index')}}";
		url['check_slug'] = "{{route('products-check-slug', ['product' => $product->id])}}";


		message['ok_reorder'] = "Ordinamento immagini aggiornato";
		message['ok_category'] = "Categorie aggiornate";
		message['ok_active'] = "Progetto pubblicato";
		message['no_active'] = "Progetto spostato in bozze";
		message['ok-update'] = 'Dati salvati con successo';
		message['no-delete'] = 'Attenzione! Errore durante la cancellazione.';
		message['img-delete'] = 'Immagine cancellata.';
		message['fls-delete'] = 'Documento cancellato.';

	</script>

	{!! Html::script('js/pages/admin/products/products-dropzone.js') !!}
	{!! Html::script('js/pages/admin/products/products.js') !!}
    
@stop