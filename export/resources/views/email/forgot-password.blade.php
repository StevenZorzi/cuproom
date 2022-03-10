@extends('templates.template-email-out', ['title' => 'email.obj-forgot-pwd'])  

@section('content')
    
	<br>
	<div class="panel">
		<p>
		@lang('email.reset-msg1')
		</p>
		<p><br> 
		<a class="link" href="{{ route('password.reset', ['token' => $token]) }}">@lang('email.reset-pwd')</a>
		</p>
		<p><br> 
		@lang('email.reset-msg2')
		</p><br>
		<hr>
		<small>@lang('email.reset-msg3')<br>
		<a href="{{ route('password.reset', ['token' => $token]) }}">{{ route('password.reset', ['token' => $token]) }}</a></small>
	</div>
	
@stop

	
