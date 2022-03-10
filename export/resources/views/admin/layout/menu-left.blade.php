<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <ul id="mainnav-menu" class="list-group">
                        <!--Category name-->
                        <li class="list-header">@lang('menu.generals')</li>

                        <!--Menu list item-->
                        <li class="@if((Route::currentRouteName() == 'dashboard')) active-link @endif">
                            <a href="{{ route('dashboard') }}">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="menu-title">
                                    <strong>@lang('menu.dashboard')</strong>
                                </span>
                            </a>
                        </li>
      

                        <!--Menu list item-->
                        <li class="@if((Route::currentRouteName() == 'users.edit') && Route::current()->parameter('user')->id == $authUser->id) active-link @endif">
                            <a href="{{ route('users.edit', ['user' => $authUser->id]) }}">
                                <i class="pli-male"></i>
                                <span class="menu-title">
                                    <strong>@lang('menu.my-profile')</strong>
                                </span>
                            </a>
                        </li>

                        @can('restricted-access')
                        <!--Menu list item-->
                        <li class="@if((Route::currentRouteName() == 'users')) active-link @endif">
                            <a href="{{ route('users.index') }}">
                                <i class="ion-person-stalker"></i>
                                <span class="menu-title">
                                    <strong>@lang('menu.users')</strong>
                                </span>
                            </a>
                        </li>
                        @endcan

                        @can('admin-access')
                        <li class="@if(Route::currentRouteName() == 'settings') active active-link @endif">
                            <a href="{{ route('settings') }}">
                                <i class="psi-gear-2"></i>
                                <span class="menu-title">
                                    <strong>@lang('menu.settings')</strong>
                                </span>
                            </a>
                        </li>
                        @endcan
            
                        <li class="list-divider"></li>
            

                        <!-- <li class="list-header">Homepage</li>

                        <li>
                            <a href="{{ route('favorites') }}">
                                <i class="pli-layout-grid"></i>
                                <span class="menu-title">In evidenza</span>
                            </a>
                        </li> -->

                        @php
                        $module = App\Models\Core\Module::find(1);
                        $text = $module->getText();
                        @endphp
                        @can('view', $module)
                        <!--Category name-->
                        <li class="list-header">{{$text->name}}</li>

                        <!--Menu list item-->
                        <li class="@if (\Request::is('*/blog*') || \Request::is('*/'.$text->slug.'*')) active active-link @endif">
                            <a href="#">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="menu-title">
                                    <strong>{{$text->name}}</strong>
                                    <i class="arrow"></i>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="@if (\Request::is('*/blog') || \Request::is('*/'.$text->slug)) active-link @endif"><a href="{{ route('blog.index') }}">@lang('menu.list') @lang('menu.articles')</a></li> 
                                <li class="@if (\Request::is('*/blog/create')) active-link @endif"><a href="#" data-target="#global-add-blog" data-toggle="modal">@lang('menu.add-new')</a></li>
                                <li class="@if (\Request::is('*/'.$text->slug.'/categories')) active-link @endif"><a href="{{ route('categories.index',['module' => $text->slug]) }}">@lang('menu.categories')</a></li>
                            </ul>
                        </li>
                        @endcan


                        @php
                        $module = App\Models\Core\Module::find(2);
                        $text = $module->getText();
                        @endphp
                        @can('view', $module)
                        <!--Category name-->
                        <li class="list-header">{{$text->name}}</li>

                        <!--Menu list item-->
                        <li class="@if (\Request::is('*/portfolio*') || \Request::is('*/'.$text->slug.'*')) active active-link @endif">
                            <a href="#">
                                <i class="ion-clipboard"></i>
                                <span class="menu-title">
                                    <strong>{{$text->name}}</strong>
                                    <i class="arrow"></i>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="@if (\Request::is('*/portfolio') || \Request::is('*/'.$text->slug)) active-link @endif"><a href="{{ route('portfolio.index') }}">@lang('menu.list') @lang('menu.projects')</a></li> 
                                <li class="@if (\Request::is('*/portfolio/create')) active-link @endif"><a href="#" data-target="#global-add-portfolio" data-toggle="modal">@lang('menu.add-new')</a></li>
                                <li class="@if (\Request::is('*/'.$text->slug.'/categories')) active-link @endif"><a href="{{ route('categories.index',['module' => $text->slug]) }}">@lang('menu.categories')</a></li>
                            </ul>
                        </li>
                        @endcan


                        @php
                        $module = App\Models\Core\Module::find(3);
                        $text = $module->getText();
                        @endphp
                        @can('view', $module)
                        
                        <!--Category name-->
                        <li class="list-header">{{$text->name}}</li>
                        
                        <!--Menu list item-->
                        <li class="@if ((\Request::is('*/products*') || \Request::is('*/'.$text->slug.'*')) && !\Request::is('*/products/rel/variants*')) active active-link @endif">
                            <a href="#">
                                <i class="ion-tshirt-outline"></i>
                                <span class="menu-title">
                                    <strong>{{$text->name}}</strong>
                                    <i class="arrow"></i>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="@if ((\Request::is('*/products') || \Request::is('*/'.$text->slug)) && !\Request::is('*/products/rel/variants*')) active-link @endif"><a href="{{ route('products.index') }}">@lang('menu.list') @lang('menu.products')</a></li>
                                <li class="@if (\Request::is('*/products/create')) active-link @endif"><a href="#" data-target="#global-add-product" data-toggle="modal">@lang('menu.add-new')</a></li>
                                <li class="@if (\Request::is('*/'.$text->slug.'/categories')) active-link @endif"><a href="{{ route('categories.index',['module' => $text->slug]) }}">@lang('menu.categories')</a></li>
                            </ul>
                        </li>

                        
                        <!--Menu list item-->
                        <li class="@if (\Request::is('*/products/rel/variants*')) active active-link @endif">
                            <a href="#">
                                <i class="fa fa-sitemap"></i>
                                <span class="menu-title">
                                    <strong>@lang('menu.variants')</strong>
                                    <i class="arrow"></i>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="@if (\Request::is('*/products/rel/variants')) active-link @endif"><a href="{{ route('variants.index') }}">@lang('menu.list') @lang('menu.variants')</a></li>
                                <li class="@if (\Request::is('*/products/variants/create')) active-link @endif"><a href="#" data-target="#variant-modal" data-toggle="modal">@lang('menu.add-new')</a></li>
                            </ul>
                        </li>
                        
                        @endif


                        @php
                        $module = App\Models\Core\Module::find(6);
                        $text = $module->getText();
                        @endphp
                        @can('view', $module)

                        <!--Category name-->
                        <li class="list-header">{{$text->name}}</li>

                        <!--Menu list item-->
                        <li class="@if (\Request::is('*/brands*') || \Request::is('*/'.$text->slug.'*')) active active-link @endif">
                            <a href="#">
                                <i class="ion-ios-color-filter-outline"></i>
                                <span class="menu-title">
                                    <strong>{{$text->name}}</strong>
                                    <i class="arrow"></i>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse ">
                                <li class="@if (\Request::is('*/brands') || \Request::is('*/'.$text->slug)) active-link @endif"><a href="{{ route('brands.index') }}">@lang('menu.list') @lang('menu.brands')</a></li>
                                <li class="@if (\Request::is('*/brands/create')) active-link @endif"><a href="#" data-target="#global-add-brand" data-toggle="modal">@lang('menu.add-new')</a></li>
                                <li class="@if (\Request::is('*/'.$text->slug.'/categories')) active-link @endif"><a href="{{ route('categories.index',['module' => $text->slug]) }}">@lang('menu.categories')</a></li>
                            </ul>
                        </li>
                        @endcan


                        @php
                        $module = App\Models\Core\Module::find(4);
                        $text = $module->getText();
                        @endphp
                        @can('view', $module)
                        <!--Category name-->
                        <li class="list-header">{{$text->name}}</li>

                        <!--Menu list item-->
                        <li class="@if (\Request::is('*/gallery*') || \Request::is('*/'.$text->slug.'*')) active active-link @endif">
                            <a href="#">
                                <i class="ion-images"></i>
                                <span class="menu-title">
                                    <strong>{{$text->name}}</strong>
                                    <i class="arrow"></i>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="@if (\Request::is('*/gallery') || \Request::is('*/'.$text->slug)) active-link @endif"><a href="{{ route('gallery.index') }}">@lang('menu.list') @lang('menu.gallery')</a></li> 
                                <li class="@if (\Request::is('*/gallery/create')) active-link @endif"><a href="#" data-target="#global-add-gallery" data-toggle="modal">@lang('menu.add-new')</a></li>
                                <li class="@if (\Request::is('*/'.$text->slug.'/categories')) active-link @endif"><a href="{{ route('categories.index',['module' => $text->slug]) }}">@lang('menu.categories')</a></li>
                            </ul>
                        </li>
                        @endcan


                        @php
                        $module = App\Models\Core\Module::find(5);
                        $text = $module->getText();
                        @endphp
                        @can('view', $module)
                        <!--Category name-->
                        <li class="list-header">{{$text->name}}</li>

                        <!--Menu list item-->
                        <li class="@if (\Request::is('*/requests*')) active active-link @endif">
                            <a href="#">
                                <i class="psi-mail icon-lg"></i>
                                <span class="menu-title">
                                    <strong>{{$text->name}}</strong>
                                    <i class="arrow"></i>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="@if (\Request::is('*/requests')) active-link @endif"><a href="{{ route('requests.index') }}">@lang('menu.list') @lang('menu.requests')</a></li> 
                            </ul>
                        </li>
                        @endcan


                        <li class="list-divider"></li>

                    </ul>

                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->