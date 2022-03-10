@extends('templates.template-email-out', ['title' => 'email.obj-change-pwd'])  

@section('content')
    
	<br>
	<div class="panel">
		<p>
		@lang('email.change-success')
		</p>
		<br>
		<p>
		@lang('email.new-data')
		</p>
		Username: {{ $user->email }}<br>
		Password: {{ $password }}
		
		<p><br> 
		<a class="link" href="{{ route('login') }}">@lang('email.login-now')</a>
		</p>
	</div>
	
@stop

	
