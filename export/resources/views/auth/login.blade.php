@extends('templates.template-auth', ['page' => 'login', 'title' =>'Login'])    

@section('content')
    
    <!-- LOGIN FORM -->
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
                <p class="pad-btm">{{ trans('auth.sign-message') }}</p>
                <form method="POST" action="{{ url(config('app.locale').'/login') }}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                            <input type="password" name="password" class="form-control" placeholder="{{ trans('auth.passw') }}">
                        </div>
                    </div>
                    
                    <div class=" text-left checkbox">
                        <label class="form-checkbox form-icon">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>{{ trans('auth.remember') }}
                        </label>
                    </div><br>

                    <div>
                        <div class="form-group">
                        <button class="col-xs-12 btn btn-success text-uppercase" type="submit"><strong>{{ trans('auth.submit-log') }}</strong></button>
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
            <a href="{{ route('password.request') }}" class="btn-link mar-rgt">{{ trans('auth.forgot') }}</a>
        </div>

    </div>
        

@stop

@section('page-script')
    
@stop