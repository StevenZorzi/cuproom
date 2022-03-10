<!DOCTYPE html>
<html lang="{{$lang}}">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@lang($title) - {{config('app.name')}}</title>

    @include('include.analytics')
    @include('auth.layout.header-script')

</head>
<body>
    
   <div id="container" class="cls-container">
        
        <!-- BACKGROUND IMAGE -->
        <!--===================================================-->
        <div id="bg-overlay" class="bg-img" style="background-image: url({{ asset(config('paths.back-'.$page)) }})"></div>
        
        
        <!-- HEADER -->
        <!--===================================================-->
        <div class="cls-header cls-header-lg">
          <div class="cls-brand">
            <img class="logo" src="{{ asset(config('paths.logo')) }}" height="70" class="brand-icon"> &nbsp; &nbsp;
            <span class="brand-title">{{config('app.name')}} &nbsp;</span>
          </div>
        </div>
        <!--===================================================-->
        
        
        @yield('content')
        
        
        
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    @include('auth.layout.footer-script')

    @yield('page-script')

    </body>
</html>
