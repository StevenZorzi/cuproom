<!DOCTYPE html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @lang('errors.error') {{ $code }} - {{config('app.name')}}</title>


    <!--STYLESHEET-->
    <!--=================================================-->



    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    {!! Html::style('css/bootstrap.min.css') !!}


    <!--Nifty Stylesheet [ REQUIRED ]-->
    {!! Html::style('css/nifty.min.css') !!}

    <!--Nifty Premium Icon [ DEMO ]-->
    {!! Html::style('css/demo/nifty-demo-icons.min.css') !!}

    
    <!--Font Awesome [ OPTIONAL ]-->
    {!! Html::style('plugins/font-awesome/css/font-awesome.min.css') !!}




    <!--SCRIPT-->
    <!--=================================================-->

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    {!! Html::style('plugins/pace/pace.min.css') !!}
    {!! Html::script('plugins/pace/pace.min.js') !!}

        
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="container" class="cls-container">
        
         
        <div class="cls-header cls-header-lg">
          <div class="cls-brand">
            <img class="logo" src="{{ asset(config('paths.logo')) }}" height="70" class="brand-icon"> &nbsp; &nbsp;
            <span class="brand-title">{{config('app.name')}} &nbsp;</span>
          </div>
        </div>
        
        <!-- CONTENT -->
        <!--===================================================-->
        <div class="cls-content">
            
            @if($code != "503")
                <h1 class="error-code text-warning">{{ $code }}</h1>
                <p class="h4 text-thin pad-btm mar-btm">
                    <i class="fa fa-exclamation-circle fa-fw"></i>
                    
                     @lang('errors.'.$code.'-error');
                     <br>
                    <div class="pad-top"><a class="btn-link" href="{{ url('/') }}">@lang('errors.back') &crarr; </a></div>
                   
                </p>
            @else
                <br>
                <h3 class="h1 text-warning">@lang('errors.503-error')</h3>
            @endif
     
            
        </div>

    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    {!! Html::script('js/jquery-2.2.1.min.js') !!}


    <!--BootstrapJS [ RECOMMENDED ]-->
    {!! Html::script('js/bootstrap.min.js') !!}


    <!--Fast Click [ OPTIONAL ]-->
    {!! Html::script('plugins/fast-click/fastclick.min.js') !!}

    
    <!--Nifty Admin [ RECOMMENDED ]-->
    {!! Html::script('js/nifty.min.js') !!}

    </body>
</html>