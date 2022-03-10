@extends('templates.template-email-out', ['title' => 'email.obj-new-user'])  

@section('content')
    
	<p>
		@lang('email.new-access') {{ config('app.name') }}.
	</p>
	<p>
		@lang('email.data-access')
	</p>
	<b>Username:</b> {{ $user->email }}<br>
	<b>Password:</b> {{ $password }}
	
	<p><br> 
		<a class="link" href="{{ route('login') }}">@lang('email.login-now')</a>
	</p>
	
@stop

	
