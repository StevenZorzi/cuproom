@extends('templates.template-email-in', ['title' => 'Richiesta di contatto'])  

@section('content')
    
	<p>
		
		Da: &nbsp; <strong>{{$cr->name}} {{$cr->surname}}</strong><br>
		
		Contatti: &nbsp; <strong>{{$cr->email}} &nbsp; {{$cr->phone}}</strong><br><br>

		Messaggio:<br><br>

		<i>{!!nl2br($cr->message)!!}</i>

	</p>
	
@stop