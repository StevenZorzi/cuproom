<!--NAVBAR-->
<!--===================================================-->
<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <img src="{{ asset(config('paths.logo-min')) }}" alt="{{config('app.name')}}" class="brand-icon">
                <div class="brand-title">
                    <span class="brand-text">{{config('app.name')}}</span>
                </div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">

                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="pli-view-list"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->

                <!--Sidebar toggle-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li data-original-title="" title="">
                    <a id="demo-toggle-aside">
                        <i class="pli-arrow-inside"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                @if(App::isDownForMaintenance())
                <li id="maintenance-alert">
                    <a class="btn-hover-info add-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Modalità di Manutenzione attiva">
                        <i class="fa fa-exclamation-triangle"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                @endif

            </ul>
            <ul class="nav navbar-top-links pull-right">

                <li>
                    <a id="view-site" href="{{ route('website-home') }}" target="_blank">
                        <small>
                            <i class="ion-log-out fa-lg"></i> &nbsp; @lang('interface.view-site')
                        </small>
                    </a>
                </li>
                

                <!--Language selector-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">
                    <a id="demo-lang-switch" class="lang-selector dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="lang-selected">
                            <img class="lang-flag" src="{{ asset('img/flags/'.$lang.'.png') }}">
                        </span>
                    </a>

                    @if(array_key_exists('en', $suppLangs) && array_key_exists('it', $suppLangs))
                    <!--Language selector menu-->
                    <ul class="head-list dropdown-menu">
                    
                        {{-- 
                        @foreach($suppLangs as $localeCode => $properties)
                            <li><a rel="alternate" hreflang="{{$localeCode}}" href="{{Localization::getLocalizedURL($localeCode) }}" @if($lang == $localeCode) class="active" @endif>
                                <img class="lang-flag" src="{{ asset('img/flags/'.$localeCode.'.png') }}" alt="Italy">
                                <span class="lang-id">{{$localeCode}}</span>
                                <span class="lang-name">{{ $properties['native'] }}</span>
                            </a></li>
                        @endforeach
                        --}}

                        <li>
                            <!--Italy-->
                            <a rel="alternate" hreflang="{{ 'it' }}" href="{{Localization::getLocalizedURL('it') }}" 
                            @if($lang == 'it') class="active" @endif >
                                <img class="lang-flag" src="{{ asset('img/flags/it.png') }}" alt="Italy">
                                <span class="lang-id">IT</span>
                                <span class="lang-name">Italiano</span>
                            </a>
                        </li>

                        <li>
                            <!--English-->
                            <a rel="alternate" hreflang="{{ 'en' }}" href="{{Localization::getLocalizedURL('en') }}" 
                            @if($lang == 'en') class="active" @endif >
                                <img class="lang-flag" src="{{ asset('img/flags/en.png') }}" alt="English">
                                <span class="lang-id">EN</span>
                                <span class="lang-name">English</span>
                            </a>
                        </li>
                        
                    </ul>
                    @endif
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End language selector-->



                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                        <span class="pull-right">
                            <img class="img-circle img-user media-object" src="{{ asset($authUser->getImg()) }}">
                        </span>
                        <div class="username hidden-xs">{{ $authUser['name']." ".$authUser['surname'] }}</div>
                    </a>


                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">


                        <!-- User dropdown menu -->
                        <ul class="head-list">
                            <li>
                                <a href="{{ route('users.edit', ['user' => $authUser]) }}">
                                    <i class="pli-male icon-lg icon-fw"></i> {{ trans('menu.my-profile') }} 
                                </a>
                            </li>
                            
                        </ul>

                        <!-- Dropdown footer -->
                        <div class="pad-all text-right">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">
                                <i class="ion-ios-locked"></i> &nbsp; Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->

            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>
<!--===================================================-->
<!--END NAVBAR -->