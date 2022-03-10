@extends('templates.template-admin', ['title' => 'menu.products'])  

@section('content')
    
	<div class="row">

		<div class="mar-btm">
			<a style="line-height:32px" class="text-danger text-normal" href="{{route('products-index-deleted')}}">@lang('interface.view-deleted') (<span class="num-del">{{$deleted}}</span>)</a>
			<button data-target="#global-add-product" data-toggle="modal" class="pull-right btn btn-primary btn-rounded btn-labeled btn-control fa fa-plus">@lang('interface.new')</button>
			<div class="clearfix"></div>
      	</div>

		<div class="panel panel-purple">
			
			<!--Panel heading-->
			<div class="panel-heading">
				@if(count($suppLangs) > 1)
				<div class="panel-control">

					<!--Nav tabs-->
					<ul class="nav nav-tabs">
						@foreach($suppLangs as $localeCode => $properties)

							<li @if($loop->first) class="active" @endif>
								<a data-toggle="tab" href="#list-{{$localeCode}}">
									<img class="lang-flag" src="{{ asset('img/flags/'.$localeCode.'.png') }}">
								</a>
							</li>

						@endforeach
					</ul>
				</div>
				@endif

				<h3 class="panel-title">@lang('interface.list') @lang('interface.products')</h3>
			</div>

			<!--Panel body-->
			<div class="panel-body">

				<!--Tabs content-->
				<div class="tab-content">

					@foreach($suppLangs as $localeCode => $properties)

					<div id="list-{{$localeCode}}" class="tab-pane fade @if($loop->first) in active @endif">

						    <div class="panel-body">
								<div class="row">
							    	<div class="col-sm-12">
							    		<div class="table-responsive">
									    	<table id="table-{{$localeCode}}" class="table table-striped" style="width:100%">

												<thead>
													<tr>
														<th class="text-center"></th>
														<th>@lang('interface.name')</th>
														<th class="text-center search">Categoria</th>
														<th class="text-center search">@lang('interface.created-at')</th>
														<th class="text-center search">@lang('interface.status')</th>
														<th class="text-center"></th>
													</tr>
												</thead>
												<tfoot>
										            <tr>
										                <th class="text-center"></th>
										                <th></th>
										                <th class="text-center"></th>
										                <th class="text-center"></th>
										                <th class="text-center"></th>
										                <th class="text-center"></th>
										            </tr>
										        </tfoot>
												<tbody>
													@forelse($products[$localeCode] as $product)
														<tr data-expanded="true">
															<td class="text-center" style="width:70px">
															<img src="{{asset($product->base->preview())}}" width="60" height="60"></td>
															<td class="max-width"><p class="text-overflow"><strong>{{$product->name}}</strong></p></td>
															<td class="max-width text-center">@foreach($product->base->categories()->orderBy('id')->take(2)->get() as $cat)<span class="label label-default">{{$cat->getText('it')->name}}</span>@endforeach</td>
															<td class="text-center" data-order="{{$product->base->created_at->timestamp}}" data-sort="{{$product->base->created_at->timestamp}}">{{$product->base->created_at->formatLocalized('%d %h %Y %H:%M')}}</td>
															<td class="text-center">{!!$product->base->getStatus()!!}</td>
															<td class="text-center">
																<div class="btn-group manage" data-id="{{$product->base->id}}">
													              	<a type="button" class="view btn btn-sm btn-default btn-icon btn-hover-primary fa fa-link add-tooltip" data-original-title="@lang('interface.view')" href="{{frontUrl($module_id, $localeCode, $product->slug)}}" target="_blank"></a>
													              	<a type="button" class="edit btn btn-sm btn-default btn-icon btn-hover-warning fa fa-edit add-tooltip" data-original-title="@lang('interface.edit')" href="{{route('products.edit', ['product' => $product->base->id])}}"></a>
													              	<button type="button" class="delete btn btn-sm btn-default btn-icon btn-hover-danger fa fa-times add-tooltip" data-original-title="@lang('interface.delete')" data-action="{{route('products.destroy', ['product' => $product->base->id])}}"></button>
													            </div>
															</td>
														</tr>
													@empty
								                        <tr class="nothing"><td colspan="6"><h5 class="text-center">@lang('interface.not-found') @lang('interface.products')</h5></td></tr>
								                    @endforelse
												</tbody>
											</table>
										</div>
									</div>
								</div>
						 	</div>
							
						</div>

						@endforeach
						
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

		var table = [];
		@foreach($suppLangs as $localeCode => $properties)
			
			@if($products[$localeCode]->count())
				table['{{$localeCode}}'] = $('#table-{{$localeCode}}').DataTable( {
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
				    ],
				    initComplete: function () {
			            this.api().columns('.search').every( function () {
			                var column = this;
			                var select = $('<select class="form-control"><option value="">Tutti</option></select>')
			                    .appendTo( $(column.footer()).empty() )
			                    .on( 'change', function () {
			                        var val = $.fn.dataTable.util.escapeRegex(
			                            $(this).val()
			                        );
			 
			                        column
			                            .search( val ? '^'+val+'$' : '', true, false )
			                            .draw();
			                    } );
			 
			                column.data().unique().sort().each( function ( d, j ) {
			                	d = d.replace(/(<([^>]+)>)/ig, '');
			                    select.append( '<option value="'+d.trim()+'">'+d.trim()+'</option>' )
			                } );
			            } );
			        }
				});
			@endif
		@endforeach

			$(document).on("click", ".manage .delete", function(){

	        	var button = $(this);

	        	button.parents('tr').addClass('del-row');

	        	bootbox.confirm({
					title: "<h4>{{trans_choice('interface.delete-this', 0)}} @lang('interface.product')?</h4>",
				    message: "<p class='text-normal'>@lang('interface.del-msg')</p>",
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

				        	$.post(url, { _method: 'DELETE' })
			                .done(function( response ) {
			                    success('success-{{$lang}}');
			                    var lang = button.parents('table').attr('id').substr(parseInt(button.parents('table').attr('id').indexOf('-'))+1);
			                    console.log(lang);
			                    table[lang].row(button.parents('tr')).remove().draw();
			                    $('.num-del').text(parseInt($('.num-del').text())+1);
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