<div class="sub-panel">
@foreach($categories as $category)
	<div class="panel single-category">

		<div class="panel-heading">
			<div class="panel-control"> @if($category->count($module->category_id)) <span class="badge badge-primary">{{$category->count($module->category_id)}}</span>@endif &nbsp; 
                <div class="btn-group cat-manage" data-id="{{$category->id}}">
	              	<button type="button" class="delete btn btn-sm btn-icon btn-hover-danger fa fa-times add-tooltip bord-all" data-original-title="Elimina" data-container="body" data-action="{{route('categories.destroy', ['module' => trans('settings.module-'.$module->category_id.'-slug'), 'category' => $category->id])}}"></button>
	            </div>
			</div>
			<h4 class="panel-title">
				<a data-parent="#accordion" data-toggle="collapse" href="#collapse{{$category->id}}" style="display:block;">{{$category->getMainName()}}</a>
			</h4>
		</div>

		<div class="panel-collapse collapse" id="collapse{{$category->id}}" style="height: 0px;">
			<div class="panel-body">
				<div class="tab-base tab-stacked-left">

					<!--Nav tabs-->
					<ul class="nav nav-tabs">

						@foreach($category->data as $trans)
							@if(array_key_exists($trans->lang, $suppLangs))
							<li @if($loop->index == 0) class='active' @endif>
								<a data-toggle="tab" href="#tab-{{$category->id}}{{$trans->lang}}" class="text-center tab-trans" data-trans="{{$trans->lang}}">
									<img class="lang-flag" src="{{asset('img/flags/'.$trans->lang.'.png')}}">
								</a>
							</li>
							@endif
						@endforeach
						
						<li class="tab-add @if($category->data->count() >= count($suppLangs)) no-display @endif" data-id="{{$category->id}}">
							<a class="btn-hover-info add-tooltip text-center" data-placement="top" data-target="#add-trans" data-toggle="modal" data-original-title="Aggiungi traduzione">
								<i class="fa fa-plus fa-lg" aria-hidden="true"></i>
							</a>
						</li>
						
					</ul>

					<!--Tabs Content-->
					<div class="tab-content">
						@foreach($category->data as $trans)

							<div id="tab-{{$category->id}}{{$trans->lang}}" class="tab-pane fade @if($loop->index == 0) active in @endif">
								<form class="form-update-trans" action="{{route('categories.destroy', ['module' => trans('settings.module-'.$module->category_id.'-slug'), 'category' => $category->id])}}" >

									<div class="col-md-12 text-right">
						                <div class="btn-group lang-manage" data-id="{{$trans->id}}">
							              	<button type="submit" class="save btn btn-sm btn-default btn-icon btn-hover-success fa fa-refresh add-tooltip" data-original-title="Salva" data-container="body" data-action="{{route('categories.update', ['module' => trans('settings.module-'.$module->category_id.'-slug'), 'category' => $category->id])}}"></button>
							              	@if($category->data->count() > 1)
							              		<button type="button" class="delete btn btn-sm btn-default btn-icon btn-hover-danger fa fa-times add-tooltip" data-original-title="Elimina" data-container="body" data-action="{{route('categories.destroy', ['module' => trans('settings.module-'.$module->category_id.'-slug'), 'category' => $category->id])}}"></button>
							              	@endif
							            </div>
				                	</div>

				                	<div class="col-md-12">
										
										{{ method_field('PUT') }}
										<input type="hidden" class="text-thin" name="trans" value="{{$trans->id}}">
										<input type="hidden" class="text-thin" name="category" value="{{$category->id}}">
										<div class="form-group">
											<label class="label-control">Nome</label>
											<input type="text" class="form-control" name="name" value="{{$trans->name}}" placeholder="Nome categoria">
										</div>
										<div class="form-group">
											<label class="label-control">Slug</label>
											<input type="text" class="form-control" name="slug" value="{{$trans->slug}}" placeholder="Slug URL categoria">
										</div>
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
						
						@endforeach

					</div>
				</div>
			</div>
		</div>
	</div>
	@if($category->getChilds()->count())
		@include('admin.pages.categories-tree',['categories' => $category->getChilds(), 'parentId' => $category->id])
	@endif
@endforeach
</div>
