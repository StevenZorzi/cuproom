@extends('templates.template-email-out', ['title' => 'email.obj-thanks'])  

@section('content')
    
	<p>

		@lang('email.thanks-t') @lang('email.thanks-ut')
		<br>
		<br>
		@lang('email.thanks-msg')<br>
		<i>{!!nl2br($cr->message)!!}</i>
		
 	</p>
	<br>
@stop