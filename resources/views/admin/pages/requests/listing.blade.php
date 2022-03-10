@extends('templates.template-admin', ['title' => 'menu.requests'])  

@section('content')
    
	<div class="row">

		<!-- GESTIONE LINGUE -->

		<div class="col-md-12">
			<div class="panel">
			    <div class="panel-heading">
			      	<div class="panel-control">
			        	
			      	</div>
			      	<h3 class="panel-title">@lang('interface.list') @lang('interface.requests')</h3>
			    </div>

			    <div class="panel-body">
					<div class="row">
				    	<div class="col-sm-12">
				    		<div class="table-responsive">
						    	<table class="table table-striped" style="width:100%">

									<thead>
										<tr>
											<th class="text-center search">@lang('interface.date')</th>
											<th>@lang('interface.subject')</th>
											<th class="search">@lang('interface.name')</th>
											<th class="search">@lang('interface.company')</th>
											<th>@lang('interface.message')</th>
											<th class="text-center" style="font-size:1.3em; vertical-align:text-bottom;">&nbsp; <i class="pli-mail-reply"></i></th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
							            <tr>
							                <th class="text-center"></th>
							                <th></th>
							                <th></th>
							                <th></th>
							                <th></th>
							                <th class="text-center"></th>
							                <th></th>
							            </tr>
							        </tfoot>
									<tbody>
										@forelse($requests as $request)
											<tr data-expanded="true">
												<td class="text-center" data-order="{{$request->created_at->timestamp}}" data-sort="{{$request->created_at->timestamp}}">{{$request->created_at->formatLocalized('%d %h %Y')}}</td>
												<td class="max-width"><p class="text-overflow"><strong>{{$request->subject}}</strong></p></td>
												<td class="max-width"><p class="text-overflow"><strong>{{$request->name}} {{$request->surname}}</strong></p></td>
												<td class="max-width"><p class="text-overflow">{{$request->company}}</p></td>
												
												<td class="max-width"><p class="text-overflow">{{ $request->message }}</p></td>
												<td class="text-center"><p>{!! $request->getStatus() !!}</p></td>
												<td class="text-center">
													<div class="btn-group manage" data-id="{{$request->id}}">
										              	<a type="button" class="view btn btn-sm btn-default btn-icon btn-hover-primary fa fa-link add-tooltip" data-original-title="@lang('interface.view')" href="{{route('requests.show', ['requests' => $request->id])}}"></a>
										              	<button type="button" class="delete btn btn-sm btn-default btn-icon btn-hover-danger fa fa-times add-tooltip" data-original-title="@lang('interface.delete')" data-action="{{route('requests.destroy', ['requests' => $request->id])}}"></button>
										            </div>
												</td>
											</tr>
										@empty
					                        <tr class="nothing"><td colspan="7"><h5 class="text-center">@lang('interface.not-found') @lang('interface.requests')</h5></td></tr>
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
			@if($requests->count())
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
			        { targets: [0,6], sorting: false },
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
		                    select.append( '<option value="'+d+'">'+d+'</option>' )
		                } );
		            } );
		        }
			});
			@endif


			$(document).on("click", ".manage .delete", function(){

	        	var button = $(this);

	        	button.parents('tr').addClass('del-row');

	        	bootbox.confirm("<h4>Eliminare questa @lang('interface.request')?</h4><br><span>La @lang('interface.request') non sarà più visibile.</span>",function(result) {
					
					if (result) {

			        	var url = button.attr('data-action');

			        	$.post(url, { _method: 'DELETE' })
		                .done(function( response ) {
		                    success('success-{{$lang}}');
		                    table.row(button.parents('tr')).remove().draw();
		                }).error(function( response ) {
		                    error('error-{{$lang}}');
		                });

	        		}else{
	        			button.parents('tr').removeClass('del-row');
	        		}
	        	});
	        });
		
	</script>
    
@stop