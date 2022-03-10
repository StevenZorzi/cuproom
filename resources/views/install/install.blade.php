@extends('install.template-install', ['title' =>'interface.installation'])    

@section('content')
    
    <!-- INSTALLAZIONE DATABASE E DATI -->
    
    <div class="panel">
                
        <!--Panel heading-->
        <div class="panel-heading">
            <div class="panel-control">
                <a href="{{url('/login')}}" class="btn btn-primary btn-rounded btn-labeled btn-control fa fa-user">Login</a>
            </div>
            <h3 class="panel-title">Migrazione database</h3>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Database selezionato</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td><span class="text-semibold">DBMS</span></td><td>{{config('database.connections.mysql.driver')}}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-semibold">Host</span></td><td>{{config('database.connections.mysql.host')}}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-semibold">Porta</span></td><td>{{config('database.connections.mysql.port')}}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-semibold">Nome</span></td><td>{{config('database.connections.mysql.database')}}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-semibold">Utente</span></td><td>{{config('database.connections.mysql.username')}}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-semibold">Password</span></td><td>***</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h4>Operazioni</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Generazione database</h4>
                                </div>
                                <div class="col-sm-4">
                                    <button id="generate" class="pull-right btn btn-warning btn-rounded btn-labeled btn-control fa fa-database">Genera</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Caricamento dati di default</h4>
                                </div>
                                <div class="col-sm-4">
                                    <button id="upload" class="pull-right btn btn-warning btn-rounded btn-labeled btn-control fa fa-upload">Carica</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Ripristino database</h4>
                                </div>
                                <div class="col-sm-4">
                                    <button id="empty" class="pull-right btn btn-warning btn-rounded btn-labeled btn-control fa fa-inbox">Ripristina</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Migrazione completa database</h4>
                                </div>
                                <div class="col-sm-4">
                                    <button id="migrate" class="pull-right btn btn-warning btn-rounded btn-labeled btn-control fa fa-cogs">Lancia</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mar-top">
                <div id="responses" class="mar-top">
                    
                </div>
            </div>
        </div>
    </div>


@stop

@section('page-script')

    <script>
        $(document).ready(function() {

            $('#generate').on('click', function(){
                $.post("{{route('artisan-migrate')}}", { command: "migrate" })
                .done(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-success media fade in"><strong>Risposta: </strong>Database generato correttamente.</div>');
                })
                .error(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-danger media fade in" style="overflow: scroll;"><button class="close" data-dismiss="alert"><span>×</span></button>'+response.responseText+'</div>');
                });
            });
            $('#upload').on('click', function(){
                $.post("{{route('artisan-migrate')}}", { command: "db:seed" })
                .done(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-success media fade in"><strong>Risposta: </strong>Dati di default caricati con successo.</div>');
                })
                .error(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-danger media fade in" style="overflow: scroll;"><button class="close" data-dismiss="alert"><span>×</span></button>'+response.responseText+'</div>');
                });
            });
            $('#empty').on('click', function(){
                $.post("{{route('artisan-migrate')}}", { command: "migrate:reset" })
                .done(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-success media fade in"><strong>Risposta: </strong>Database ripristinato correttamente.</div>');
                })
                .error(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-danger media fade in" style="overflow: scroll;"><button class="close" data-dismiss="alert"><span>×</span></button>'+response.responseText+'</div>');
                });
            });
            $('#migrate').on('click', function(){
                $.post("{{route('artisan-migrate')}}", { command: "migrate:refresh", parameter: "--seed" })
                .done(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-success media fade in"><strong>Risposta: </strong>Migrazione database effettuata con successo.</div>');
                })
                .error(function( response ) {
                    $('#responses').html($('#responses').html()+'<div class="alert alert-danger media fade in" style="overflow: scroll;"><button class="close" data-dismiss="alert"><span>×</span></button>'+response.responseText+'</div>');
                });
            });

        });
        
    </script>
    
@stop

