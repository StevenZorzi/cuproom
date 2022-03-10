@extends('templates.template-admin', ['title' => 'menu.blog'])  

@section('content')
    
	<div class="row">

		<div class="col-md-12">

			<div class="mar-btm">
				<a style="line-height:32px" class="text-primary text-normal" href="{{route('blog.index')}}">@lang('interface.view-actives')</a>
        		
        		<div class="clearfix"></div>
	      	</div>

			<div class="panel">

		      	<div class="panel-heading">

					<h3 class="panel-title">@lang('interface.list') @lang('interface.articles') {{trans_choice('interface.deleted', 0)}}</h3>
				</div>


			    <div class="panel-body">
					<div class="row">
				    	<div class="col-sm-12">
				    		<div class="table-responsive">
						    	<table class="table table-striped">

									<thead>
										<tr>
											<th class="text-center"></th>
											<th class="text-center">@lang('interface.created-at')</th>
											<th>@lang('interface.title')</th>
											<th>@lang('interface.content')</th>
											<th class="text-center">@lang('interface.status')</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										@forelse($articles as $article)
											<tr data-expanded="true">
												<td class="text-center" style="width:70px">
												<img src="{{asset($article->preview())}}" width="60" height="60"></td>
												<td class="text-center" data-order="{{$article->created_at->toDayDateTimeString()}}">{{$article->created_at->formatLocalized('%d %h %Y %H:%M')}}</td>
												<td class="max-width"><p class="text-overflow"><strong>{{$article->getMainText()->title}}</strong></p></td>
												<td class="max-width"><p class="text-overflow">{{$article->getMainText()->excerpt()}}</p></td>
												
												<td class="text-center">{!!$article->getStatus()!!}</td>
												<td class="text-center">
													<div class="btn-group manage" data-id="{{$article->id}}">
										              	<button type="button" class="restore btn btn-sm btn-default btn-icon btn-hover-info fa fa-reply add-tooltip" data-original-title="@lang('interface.restore')" data-action="{{route('blog-restore', ['blog' => $article->id])}}"></button>
										      
										              	<button type="button" class="delete btn btn-sm btn-default btn-icon btn-hover-danger fa fa-times add-tooltip" data-original-title="@lang('interface.forcedelete')" data-action="{{route('blog-destroy', ['blog' => $article->id])}}"></button>
										            </div>
												</td>
											</tr>
										@empty
					                        <tr class="nothing"><td colspan="6"><h5 class="text-center">@lang('interface.not-found') @lang('interface.articles') {{trans_choice('interface.deleted', 0)}} </h5></td></tr>
					                    @endforelse
									</tbody>
								</table>
							</div>
						</div>
					</div>
			 	</div>
				
			</div>
			
		</div>
	</div>
	
@stop

@section('modals')
    

@stop

@section('page-script')
	
	<script>

			@if($articles->count())
				var table = $('.table').DataTable( {
			    responsive: true,
			    "language": {
				    "sInfo": "{{trans_choice('interface.fto', 0)}} _START_ {{trans_choice('interface.fto', 1)}} _END_ {{trans_choice('interface.fto', 2)}} _TOTAL_",
				    "sLengthMenu": "@lang('interface.view') _MENU_",
				    "sSearch": "@lang('interface.search'):",
				    "paginate": { "first": "@lang('interface.first')", "last": "@lang('interface.last')" },
				    "infoEmpty": "@lang('interface.infoEmpty')",
        			"infoFiltered": "@lang('interface.infoFiltered')",
        			"zeroRecords": "@lang('interface.zeroRecords')"
				},
				"aaSorting": [[ 1, "desc" ]],
				columnDefs: [
			        { targets: [0,5], sorting: false },
			    ]
			});
			@endif


			$(".manage .restore").on("click", function(){

	        	var button = $(this);

	        	button.parents('tr').addClass('res-row');

	        	bootbox.confirm({
					title: "<h4>{{trans_choice('interface.restore-this', 0)}} @lang('interface.article')?</h4>",
				    message: "<p class='text-normal'>@lang('interface.res-msg')</p>",
				    buttons: {
				        confirm: {
				            label: "@lang('interface.confirm')",
				            className: 'btn-info btn-rounded'
				        },
				        cancel: {
				            label: "@lang('interface.canceling')",
				            className: 'btn-default btn-rounded'
				        }
				    },
				    callback: function (result) {
					
						if (result) {

				        	var url = button.attr('data-action');

				        	$.post(url)
			                .done(function( response ) {
			                    success('success-{{$lang}}');
			                    table.row(button.parents('tr')).remove().draw();
			                }).error(function( response ) {
			                    error('error-{{$lang}}');
			                });

		        		}else{
		        			button.parents('tr').removeClass('res-row');
		        		}
	        		}
		        });
	        });

	        $(".manage .delete").on("click", function(){

	        	var button = $(this);

	        	button.parents('tr').addClass('del-row');

	        	bootbox.confirm({
					title: "<h4>{{trans_choice('interface.forcedel', 0)}} @lang('interface.article')?</h4>",
				    message: "<p class='text-normal'>@lang('interface.forcedel-msg')</p>",
				    buttons: {
				        confirm: {
				            label: "@lang('interface.confirm')",
				            className: 'btn-danger btn-rounded'
				        },
				        cancel: {
				            label: "@lang('interface.canceling')",
				            className: 'btn-default btn-rounded'
				        }
				    },
				    callback: function (result) {
					
						if (result) {

				        	var url = button.attr('data-action');

				        	$.post(url)
			                .done(function( response ) {
			                    success('success-{{$lang}}');
			                    table.row(button.parents('tr')).remove().draw();
			                }).error(function( response ) {
			                    error('error-{{$lang}}');
			                });

		        		}else{
		        			button.parents('tr').removeClass('del-row');
		        		}
	        		}
		        });
	        });
		
	</script>
    
@stop