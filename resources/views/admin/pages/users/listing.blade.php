@extends('templates.template-admin', ['title' => 'menu.users'])  

@section('content')
    
	<div class="row">

		<!-- GESTIONE LINGUE -->

		<div class="col-md-12">

			<div class="mar-btm">
				<a style="line-height:32px" class="text-danger text-normal" href="{{route('user-index-deleted')}}">@lang('interface.view-disabled') (<span class="num-del">{{$deleted}}</span>)</a>
        		<button data-target="#global-add-user" data-toggle="modal" class="pull-right btn btn-primary btn-rounded btn-labeled btn-control fa fa-plus">@lang('interface.new')</button>
        		<div class="clearfix"></div>
	      	</div>

			<div class="panel">

			    <div class="panel-heading">
			      	<h3 class="panel-title">@lang('interface.list') @lang('interface.users')</h3>
			    </div>

			    <div class="panel-body">
					<div class="row">
				    	<div class="col-sm-12">
				    		<div class="table-responsive">
						    	<table class="table table-striped" style="width:100%">

									<thead>
										<tr>
											<th class="text-center"></th>
											<th class="text-center">@lang('interface.name')</th>
											<th class="text-center">@lang('interface.surname')</th>
											<th class="text-center">E-mail</th>
											<th class="text-center search">@lang('interface.type')</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tfoot>
							            <tr>
							                <th class="text-center"></th>
							                <th class="text-center"></th>
							                <th class="text-center"></th>
							                <th class="text-center"></th>
							                <th class="text-center"></th>
							                <th class="text-center"></th>
							            </tr>
							        </tfoot>
									<tbody>
										@forelse($users as $user)
											<tr data-expanded="true">
												<td class="text-center" style="width:70px">
												<img class="img-circle" src="{{ asset($user->getImg()) }}" width="32" height="32">
												</td>
												<td class="text-center" data-order="{{$user->name}}">{{$user->name}}</td>
												<td class="text-center">{{$user->surname}}</td>
												
												<td class="text-center">{{$user->email}}</td>
												<td class="text-center">{!!$user->getRole()!!}</td>
												<td class="text-center">
													<div class="btn-group manage" data-id="{{$user->id}}">
										              	<a type="button" class="edit btn btn-sm btn-default btn-icon btn-hover-warning fa fa-edit add-tooltip" data-original-title="@lang('interface.edit')" href="{{route('users.edit', ['user' => $user->id])}}"></a>
										              	<button type="button" class="delete btn btn-sm btn-default btn-icon btn-hover-danger fa fa-times add-tooltip" data-original-title="@lang('interface.disable')" data-action="{{route('users.destroy', ['user' => $user->id])}}" @if($authUser->id == $user->id) disabled @endif></button>
										            </div>
												</td>
											</tr>
										@empty
					                        <tr class="nothing"><td colspan="6"><h5 class="text-center">@lang('interface.not-found') @lang('interface.users')</h5></td></tr>
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
			
			@if($users->count())
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
					"aaSorting": [[ 1, "asc" ]],
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
			                    select.append( '<option value="'+d+'">'+d+'</option>' )
			                } );
			            } );
			        }
				});
			@endif


			$(document).on("click", ".manage .delete", function(){

	        	var button = $(this);

	        	button.parents('tr').addClass('del-row');

	        	bootbox.confirm({
					title: "<h4>{{trans_choice('interface.disable-this', 0)}} @lang('interface.user')?</h4>",
				    message: "<p class='text-normal'>@lang('interface.deluser-msg')</p>",
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
			                    table.row(button.parents('tr')).remove().draw();
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