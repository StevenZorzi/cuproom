@extends('templates.template-auth', ['page' => 'register', 'title' => 'auth.registration'])

@section('title', 'Login')     

@section('content')
    
    <!-- REGISTRATION FORM -->
    <!--===================================================-->
    <div class="cls-content">
        <div class="pad-ver">
            <a href="{{ route('login') }}" class="btn-link mar-rgt">{{ trans('auth.login-message') }}</a>
        </div>
        <div class="cls-content-sm panel">
            <div class="errors">
                @if (count($errors))
                <ul>
                    @foreach($errors->all() as $error)
                        
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            
            <div class="panel-body text-left">

                <h4 class="pad-btm text-center">{{ trans('auth.registration') }}</h4>
                <p class="pad-btm text-center">{{ trans('auth.title-registration') }}</p>

                <form method="POST" action="{{ url('/registration') }}">
                    
                    {!! csrf_field() !!}
                    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="{{ trans('auth.name') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="surname" class="form-control" value="{{ old('surname') }}" placeholder="{{ trans('auth.surname') }}" autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                            <input type="password" name="password" class="form-control" placeholder="{{ trans('auth.passw') }}" autocomplete="off">
                        </div>
                    </div>

                    <hr>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select class="form-control selectpicker" name="gender" autocomplete="off">
                                <option value="M" @if(old('gender') == 'M') selected @endif>{{ trans('auth.gender1') }}</option>
                                <option value="F" @if(old('gender') == 'F') selected @endif>{{ trans('auth.gender2') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select class="form-control selectpicker" name="lang" autocomplete="off">
                                <option value="it" @if(old('lang') == 'it') selected @endif>{{ trans('auth.lang_it') }}</option>
                                <option value="en" @if(old('lang') == 'en') selected @endif>{{ trans('auth.lang_en') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        
                    </div>

                    
                    <div class="">
                        <div class="">
                            <div class="form-group">
                            <button class=" col-xs-12 btn btn-success text-uppercase" type="submit"><strong>{{ trans('auth.submit-registration') }}</strong></button>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mar-btm">
                    <hr>
                        <!--Italy-->
                        <a rel="alternate" hreflang="{{ 'it' }}" href="">
                            <img class="lang-flag" src="{{ asset('img/flags/it.png') }}" alt="Italy">
                            <span class="lang-id">IT</span>
                            <span class="lang-name">Italiano</span>
                        </a>
                    
                        <!--English-->
                        <a rel="alternate" hreflang="{{ 'en' }}" href="">
                            <img class="lang-flag" src="{{ asset('img/flags/en.png') }}" alt="English">
                            <span class="lang-id">EN</span>
                            <span class="lang-name">English</span>
                        </a>
                            
                    </div>

                    
                    
                </form>
            </div>
        </div>
        
    </div>
    <!--===================================================-->

        

@stop

@section('page-script')
    
@stop