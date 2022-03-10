<div id="img-info">
	          
    <form id="form-update-img-info" action="{{route('update-img-info')}}" method="POST">
      	{{ csrf_field() }}

      	<!--Modal body-->
      	<div class="modal-body">	

			<div class="tab-base tab-stacked-left">

				<div class="row">

					<div class="col-sm-9">
						@if(count($suppLangs) > 1)
						<!--Nav tabs-->
						<ul class="nav nav-tabs">

							@foreach($suppLangs as $localeCode => $lang)
							<li @if($loop->index == 0) class='active' @endif>
								<a data-toggle="tab" href="#tb-{{$img->id}}{{$localeCode}}" class="text-center tab-trans" data-trans="{{$localeCode}}">
									<img class="lang-flag" src="{{asset('img/flags/'.$localeCode.'.png')}}">
								</a>
							</li>
							@endforeach
							
						</ul>
						@endif

						<!--Tabs Content-->
						<div class="tab-content">
							
							<input type="hidden" class="text-thin" name="img" value="{{$img->id}}">
							@foreach($suppLangs as $localeCode => $lang)

								@php ($trans = $img->getText($localeCode))
								<div id="tb-{{$img->id}}{{$localeCode}}" class="tab-pane fade @if($loop->index == 0) active in @endif">

					            	<div class="col-md-12">
										
										<div class="form-group">
											<label class="label-control"><small>Titolo</small></label>
											<input type="text" class="form-control" name="title[{{$localeCode}}]" value="{{$trans->title}}">
										</div>
										<div class="form-group">
											<label class="label-control"><small>Alt</small></label>
											<input type="text" class="form-control" name="alt[{{$localeCode}}]" value="{{$trans->alt}}">
										</div>
										<div class="form-group">
											<label class="label-control"><small>Descrizione</small></label>
											<textarea class="form-control" name="description[{{$localeCode}}]" rows="4">{{$trans->description}}</textarea>
										</div>
										<div class="form-group">
											<label class="label-control"><small>Link esterno</small></label>
											<input type="text" class="form-control" name="link[{{$localeCode}}]" value="{{$trans->link}}">
										</div>
										<div class="form-group">
											<label class="label-control"><small>Tag</small></label>
											<input type="text" class="form-control" name="tag[{{$localeCode}}]" value="{{$trans->tag}}">
										</div>
									</div>
								</div>
							
							@endforeach

						</div>
					</div>

					<div class="col-sm-3">
						<img class="img-responsive" src="@if($img){{url(config('paths.'.$img->ref_type.'_img').$ref_id)}}/thumb-{{$img->filename}}@endif">
					</div>

				</div>
			</div>

		</div>
    </form>
</div>