@extends('templates.template-admin', ['title' => 'menu.dashboard'])  

@section('content')
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel middle">
		        <div class="media-left pad-all">
		            <canvas id="demo-weather-xs-icon" width="48" height="48"></canvas>
		        </div>

		        <div class="media-body text-center">
		            <p class="text-2x mar-no">Benvenuti nell'area riservata!</p>
		            <p class="text-sm mar-no text-uppercase">Da qui sarà possibile amministrare i contenuti dinamici del vostro sito web.</p>
		        </div>
		    </div>

	        <div class="row">

	        	@foreach($modules as $key => $module)

	        		@can('view', $module['module'])
		            <div class="col-sm-6">
		            	<form class="form-update-fav" action="{{route('favorites.update', ['table' => $module['table']])}}" method="POST">
			                <div class="panel {{$module['color']}} panel-colorful">
			                    <div class="pad-all">
			                    	<div class="row">
			                    		<div class="col-md-12">
					                        <p class="pull-left text-2x text-semibold">{{$module['text']->name}}</p>
					                        <i class="pull-right {{$module['icon']}} fa-2x"></i>
				                        </div>
			                        </div>
			                        <div class="row">
				                        <div class="col-md-6">
				                        	@if($key != '5')
			                        		<span>In evidenza</span>
				                        	<div class="form-group" style="margin-top:4px">
										        <select class="multiselect" data-placeholder="Selezionare elementi" multiple name="fav[]">
												    @foreach($module['actives'] as $element)
										            	<option value="{{ $element->id }}" class="text-overflow" @if($element->fav == '1') selected @endif>{{ $element->getMainText()->name }}{{ $element->getMainText()->title }}</option>
										          	@endforeach
												</select>
											</div>
											@endif
				                        </div>
				                        <div class="col-md-6">
					                        <p class="mar-top pad-hor bord-all clearfix">
					                        	<span class="pull-left text-bold" style="line-height: 40px;">@if($key == 5) Totali @else Pubblicati @endif</span>
					                            <span class="pull-right text-bold text-3x">{{$module['count_a']}}</span>
					                        </p>
					                        <p class="mar-top pad-hor bord-all clearfix">
					                        	<span class="pull-left text-bold" style="line-height: 40px;">@if($key == 5) Nuovi contatti @else Bozze @endif</span>
					                            <span class="pull-right text-bold text-3x">{{$module['count_i']}}</span>
					                        </p>
					                        @if($key != '5')
					                        <button type="submit" class="mar-top pull-right  btn btn-success btn-sm btn-rounded btn-labeled btn-control fa fa-refresh bord-all" @if($module['count_a'] < 1) disabled @endif>@lang('interface.save')</button>
					                        @endif
				                        </div>
			                        </div>
			                    </div>
			                </div>
		                </form>
		            </div>
		            @endcan

		            @if($loop->iteration %2 == 0)
		            	<div class="clearfix"></div>
		            @endif

	        	@endforeach

	        </div>

	    </div>
    </div>

@stop

@section('modals')
    

@stop

@section('page-script')

	<script>
		message['ok-update'] = 'Dati salvati con successo';

    	$(".multiselect").chosen({max_selected_options: 10, width: "100%", disable_search: false,});

    	$(".form-update-fav").on('submit', function(e){

    		e.preventDefault();
    		var url = $(this).attr('action');

    		e.preventDefault();
	    	$.post(url, $(this).serialize()).done(function(response){
	      		success('ok-update');
	      	});
    	});
	</script>
    
@stop