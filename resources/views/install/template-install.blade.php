<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang($title)</title>

    @include('admin.layout.header-script')

</head>
<body>
    <div id="container" class="mar-top">


        <div class="col-md-8 col-md-offset-2">

            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">@lang($title) {{config('app.name')}}</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                
                @yield('content')
                
            </div>
            <!--===================================================-->
            <!--End page content-->

        </div>

        @include('admin.layout.footer')

    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    @include('admin.layout.footer-script')

    @yield('page-script')

    </body>
</html>
