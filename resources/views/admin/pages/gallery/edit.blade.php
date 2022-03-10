@extends('templates.template-admin', ['title' => 'menu.gallery'])  

@section('content')
    
	<div class="row">

		<!-- COLONNA MAIN -->
		<div class="col-md-8">
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
						    	
						    	<form class="form-update-trans" action="{{route('gallery.update', ['gallery' => $gallery->id])}}" method="POST">
	              					
	              					{{ csrf_field() }}

	              					<input type="hidden" name="obj" value="{{$gallery->id}}">
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
								    			<input class="form-control title" name="title" placeholder="Titolo" value="{{$trans->title or 'Nuovo Gallery'}}">
								    		</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group url-slug">
								    			<p class="text-primary"><span class="url-prefix">{{frontUrl($module_id, $trans->lang)}}/</span><input class="slug" name="slug" value="{{$trans->slug or 'nuova-gallery' }}"></p>
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
										<div class="col-sm-6">
											<div class="form-group">
												<label><small>@lang('interface.date-period')</small></label>
												<input type="text" class="form-control" name="period" value="{{$trans->period}}">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label><small>@lang('interface.place')</small></label>
												<textarea rows="4" type="text" class="form-control" name="place">{{$trans->place}}</textarea>
											</div>
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
			 		<button class="delete-trans btn btn-danger btn-xs btn-rounded btn-labeled fa fa-trash" data-action="{{route('gallery.destroy', ['gallery' => $gallery->id])}}" data-lang="{{$trans->lang}}">@lang('interface.delete') @lang('interface.trans')</button>
			 	</div>
			 	@endif
			</div>
			<!-- fine pannello -->
		</div>



		<!-- COLONNA DESTRA DATI GENERALI-->

		<div class="col-md-4 others-data">

			<form id="form-update-main" action="{{route('gallery.update', ['gallery' => $gallery->id])}}" method="POST">
	            
	            {{ csrf_field() }}

				<input type="hidden" name="main" value="{{$gallery->id}}">
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
				</div>

				<!-- STATO -->
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-control">
							
						</div>
						<h3 class="panel-title">@lang('interface.status')</h3>
					</div>
					<div class="panel-body">
						<table style="width:100%">
							<tr>
								<td>
									<label class="mar-btm"><small>@lang('interface.published')</small></label></td>
								<td class="text-right">
									<div class="mar-btm">
										<input name="active" id="active" class="form-control switchery" type="checkbox" value="1" @if($gallery->active) checked @endif >
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
		                                    <input type="text" class="pull-right mar-btm form-control text-right" name="time_created_at" placeholder="ore:min" value="{{$gallery->created_at->format('H:i')}}" style="width:65px; background:#fff" readonly>
		                                </div>
		                                <div class="form-group date">
		                                    <input type="text" class="pull-right mar-btm form-control text-right" name="date_created_at" placeholder="gg/mm/aaaa" value="{{$gallery->created_at->format('d/m/Y')}}" style="width:90px">
		                                </div>
		                                
		                            </div>
								</td>
							</tr>
							<tr>
								<td>
									<label><small>@lang('interface.updated-at')</small></label>
								</td>
								<td class="text-right">
									<small>{{$gallery->updated_at->formatLocalized('%d %h %Y %H:%M')}}</small>
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
				</div>


				<!-- CATEGORIE -->
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-control">
							
						</div>
						<h3 class="panel-title">@lang('interface.categories')</h3>
					</div>
					<div class="panel-body">
						<div class="mar-btm">
							<small>Selezionare le categorie in cui far comparire questa gallery</small>
						</div>
						<div id="jstree">
							{!!print_cat_tree($categories, $module_id, $cat_assoc)!!}
						</div>
					</div>
				</div>

				@can('view', App\Models\Core\Module::find(3))
				<!-- BRANDS -->
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-control">
							
						</div>
						<h3 class="panel-title">@lang('menu.products')</h3>
					</div>
					<div class="panel-body">
						
						<label><small>Prodotti presenti in questa gallery</small></label>
						<div class="form-group">
					        <select id="demo-cs-multiselect" data-placeholder="Specificare uno o più brand per questo progetto" multiple name="product[]">
							    @foreach($products as $product)
					            	<option value="{{ $product->id }}" {{ select_if($product->id, $products_assoc) }}>{{ $product->getMainText()->name }}</option>
					          	@endforeach
							</select>
						</div>

					</div>
				</div>
				@endcan

			</form>

		</div>

	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="panel">
			    <div class="panel-heading">
			    	<div class="panel-control">
						<a class="fa fa-question-circle fa-lg fa-fw unselectable add-tooltip" href="#" data-original-title="<h4 class='text-thin'>Informazioni</h4><p style='width:150px'>Cliccando sull'anteprima delle immagini si possono visualizzare e impostare i dati relativi ad ognuna, mentre tenendo premuto il mouse sopra le anteprime si potranno spostare e cambiarne l'ordinamento istantaneamente.</p>" data-html="true"></a>
					</div>
			    	<h3 class="panel-title">@lang('interface.images')</h3>
			    </div>

			    <div class="panel-body">
			      	{!! Form::open(['url' => route('gallery-upload-img', ['gallery' => $gallery->id ]), 'class' => 'dropzone', 'files'=>true, 'id'=>'real-dropzone']) !!}
			      
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
			      <h3 class="panel-title">Immagine anteprima</h3>
			    </div>

			    <div class="panel-body">
			      	<img class="img-responsive" src="{{asset($gallery->preview())}}">
			    </div>
			</div>
		</div>

	</div>

	<div class="row">
	<hr>
		<div class="mar-btm mar-top text-center">
			<button id="delete" class="btn btn-danger btn-rounded btn-sm btn-labeled fa fa-trash" data-action="{{route('gallery.destroy', ['gallery' => $gallery->id])}}">@lang('interface.delete') Gallery</button>
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
	            <form id="form-add-trans" action="{{route('gallery.store')}}" method="POST">
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

	              		<input type="hidden" value="{{$gallery->id}}" name="id">
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
			                      	<input type="text" class="form-control title-modal" name="title" placeholder="Inserire titolo...">
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


  @include('admin.layout.dropzone-preview')

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
		var ref_id = "{{ $gallery->id }}";
		url['change_cat'] = "{{route('gallery.update', ['gallery' => $gallery->id])}}";
		url['path_gallery_img'] = "{{url(config('paths.gallery_img').$gallery->id)}}";
		url['get_img'] = "{{route('gallery-get-img', ['gallery' => $gallery->id])}}";
		url['get_img_info'] = "{{route('get-img-info')}}";
		url['update_img_info'] = "{{route('update-img-info')}}";
		url['delete_img'] = "{{route('gallery-delete-img', ['gallery' => $gallery->id])}}";
		url['reorder_url'] = "{{route('reorder-images')}}";
		url['update'] = "{{route('gallery.update', ['gallery' => $gallery->id])}}";
		url['list'] = "{{route('gallery.index')}}";
		url['check_slug'] = "{{route('gallery-check-slug', ['gallery' => $gallery->id])}}";
		

		message['ok_reorder'] = "Ordinamento immagini aggiornato";
		message['ok_category'] = "Categorie aggiornate";
		message['ok_active'] = "Gallery pubblicata";
		message['no_active'] = "Gallery spostata in bozze";
		message['ok-update'] = 'Dati salvati con successo';
		message['no-delete'] = 'Attenzione! Errore durante la cancellazione.';
		message['img-delete'] = 'Immagine cancellata.';

	</script>

	{!! Html::script('js/pages/admin/gallery/gallery-dropzone.js') !!}
	{!! Html::script('js/pages/admin/gallery/gallery.js') !!}
    
@stop