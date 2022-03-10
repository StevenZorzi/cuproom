<!DOCTYPE html>
<html lang="{{$lang}}">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang($title) - {{$appName}}</title>

    @include('include.analytics')
    @include('admin.layout.header-script')

</head>
<body>

    <div id="preloader-wrapper" class="no-display">
        <div class="preloader-wave-effect no-display"></div>
    </div>
    
    <div id="container" class="effect mainnav-lg @yield('sidebar-structure')">
        
        @include('admin.layout.navbar')

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">@lang($title)</h1>

                    <!--Searchbox-->
                    <!-- <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div> -->
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol> -->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->


                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
                    @yield('content')
                    
                </div>
                <!--===================================================-->
                <!--End page content-->

                @yield('modals')

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

            @include('admin.layout.menu-left')

            @yield('sidebar')

        </div>

        @include('admin.layout.global-modals')


        @include('admin.layout.footer')

    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    @include('admin.layout.footer-script')

    @yield('page-script')

    </body>
</html>
