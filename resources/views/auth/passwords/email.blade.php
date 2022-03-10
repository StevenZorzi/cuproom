@extends('templates.template-auth', ['page' => 'forgot', 'title' => trans('passwords.forgot')])

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
                <p class="pad-btm">{{trans('passwords.forgot')}}</p>
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form role="form" method="POST" action="{{ route('password.email') }}">
                    
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{trans('passwords.email')}}" required>

                        </div>
                    </div><br>

                    <div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-xs-12">
                                {{trans('passwords.send-reset')}}
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
