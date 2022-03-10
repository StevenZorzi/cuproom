@extends('templates.template-admin', ['title' => 'menu.users'])  

@section('content')
    
	<div class="row">

		<!-- GESTIONE LINGUE -->

		<div class="col-md-12">

			<div class="mar-btm">
				<a style="line-height:32px" class="text-primary text-normal" href="{{route('users.index')}}">@lang('interface.view-actives')</a>
        		
        		<div class="clearfix"></div>
	      	</div>

			<div class="panel">

		      	<div class="panel-heading">

					<h3 class="panel-title">@lang('interface.list') @lang('interface.users') {{trans_choice('interface.deleted', 0)}}</h3>
				</div>


			    <div class="panel-body">
					<div class="row">
				    	<div class="col-sm-12">
				    		<div class="table-responsive">
						    	<table class="table table-striped">

									<thead>
										<tr>
											<th class="text-center"></th>
											<th class="text-center">@lang('interface.name')</th>
											<th class="text-center">@lang('interface.surname')</th>
											<th class="text-center">E-mail</th>
											<th class="text-center">@lang('interface.type')</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									
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
														<button type="button" class="restore btn btn-sm btn-default btn-icon btn-hover-info fa fa-reply add-tooltip" data-original-title="@lang('interface.restore')" data-action="{{route('user-restore', ['user' => $user->id])}}"></button>
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
			    ]
			});
			@endif


			$(".manage .restore").on("click", function(){

	        	var button = $(this);

	        	button.parents('tr').addClass('res-row');

	        	bootbox.confirm({
					title: "<h4>{{trans_choice('interface.restore-this', 0)}} @lang('interface.user')?</h4>",
				    message: "<p class='text-normal'>@lang('interface.resuser-msg')</p>",
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

	        /*$(".manage .delete").on("click", function(){

	        	var button = $(this);

	        	button.parents('tr').addClass('del-row');

	        	bootbox.confirm({
					title: "<h4>{{trans_choice('interface.forcedel', 0)}} @lang('interface.user')?</h4>",
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
	        });*/
		
	</script>
    
@stop

