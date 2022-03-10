@extends('templates.template-auth', ['page' => 'reset', 'title' =>'Reset Password'])

@section('content')
    <!-- FORGOT PASSWORD FORM -->
    <!--===================================================-->
    <div class="cls-content">
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
            
            <div class="panel-body">
                <p class="pad-btm">Reset Password</p>
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form role="form" method="POST" action="{{ route('password.request') }}">
                     
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email }}" placeholder="{{trans('passwords.email')}}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                            <input id="password" type="password" class="form-control" name="password" placeholder="{{trans('passwords.new-pwd')}}" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{trans('passwords.confirm-pwd')}}" required>
                        </div>
                    </div><br>

                    <div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-xs-12">
                                Reset Password
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    

                    @if(array_key_exists('en', $suppLangs))
                    <div class="mar-btm">
                        <hr>
                        <!--Italy-->
                        <a rel="alternate" hreflang="{{ 'it' }}" href="{{Localization::getLocalizedURL('it') }}">
                            <img class="lang-flag" src="{{ asset('img/flags/it.png') }}" alt="Italy">
                            <span class="lang-id">IT</span>
                            <span class="lang-name">Italiano</span>
                        </a>
                    
                        <!--English-->
                        <a rel="alternate" hreflang="{{ 'en' }}" href="{{Localization::getLocalizedURL('en') }}">
                            <img class="lang-flag" src="{{ asset('img/flags/en.png') }}" alt="English">
                            <span class="lang-id">EN</span>
                            <span class="lang-name">English</span>
                        </a>
                            
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="pad-ver">
            <a href="{{ route('login') }}" class="btn-link mar-rgt">Torna alla login</a>
        </div>

    </div>

@endsection
