<header class="header3">
  <div class="row">
    <div class="small-12 column"> 
      <div class="top-bar">
        <div class="top-bar-title"> <a href="{{route('website-home')}}"><img src="{{asset('img/website/logo-cuproom.png')}}" alt="Logo Celato Rito" /></a> </div> 
        <ul class="utility"> 
          <li class="mobile"><a href="javascript:void(0)" class="menu-icon dark"></a></li>
        </ul>
        <div class="top-bar-left"> 
          <ul class="dropdown menu" data-dropdown-menu="data-dropdown-menu"> 
            <li><a href="{{route('website-home')}}" title="{{trans('website.meta.homepage-t')}}">Home</a></li>  
            <li><a href="{{route('website-about')}}" title="{{trans('website.meta.about-t')}}">@lang('website-text.m_about')</a></li>
            <li><a href="{{route('website-how-we-work')}}"  title="{{trans('website.meta.team-t')}}">@lang('website-text.m_how-we-work')</a></li>
            <li><a href="{{route('website-projects')}}"  title="@lang('website-text.m_projects')">@lang('website-text.m_projects')</a></li>
            <li><a href="{{route('website-finishes')}}" title="{{trans('website-text.finishes')}}">@lang('website-text.finishes')</a></li> 
            <li><a href="{{route('website-contact')}}" title="{{trans('website.meta.contacts-t')}}">@lang('website-text.m_contact')</a></li>
          </ul>
        </div>
        <ul class="utility">
          <li class="setting-menu submenu">
            <a><img src="{{asset('img/flags/'.$lang.'.png')}}" alt="{{$lang}}" /> &nbsp; {{ucfirst($lang)}} &nbsp;</a>
            
            <ul>
              @if($lang == 'en')
              <li><a rel="alternate" hreflang="{{ 'it' }}" href="@if(isset($url)){{$url}}@else{{Localization::getLocalizedURL('it') }}@endif" title="Italiano">
                <img src="{{asset('img/flags/it.png')}}" title="it"/> It</a>
              </li>
              @else
              <li><a rel="alternate" hreflang="{{ 'en' }}" href="@if(isset($url)){{$url}}@else{{Localization::getLocalizedURL('en') }}@endif" title="Eglish">
                <img src="{{asset('img/flags/en.png')}}" title="en"/> En</a>
              </li>
              @endif 
            
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </div>
</header>

<!-- MENU MOBILE  -->

<div class="side-menu">
  <nav class="navbar">
    <ul> 
      <li><a href="{{route('website-home')}}" title="{{trans('website.meta.homepage-t')}}">Home</a></li>  
      <li><a href="{{route('website-about')}}" title="{{trans('website.meta.about-t')}}">@lang('website-text.m_about')</a></li>
      <li><a href="{{route('website-how-we-work')}}"  title="{{trans('website.meta.team-t')}}">@lang('website-text.m_how-we-work')</a></li>
      <li><a href="{{route('website-projects')}}"  title="@lang('website-text.m_projects')">@lang('website-text.m_projects')</a></li>
      <li><a href="{{route('website-finishes')}}" title="{{trans('website-text.finishes')}}">@lang('website-text.finishes')</a></li> 
      <li><a href="{{route('website-contact')}}" title="{{trans('website.meta.contacts-t')}}">@lang('website-text.m_contact')</a></li>
    </ul>
  </nav>
</div>


<style type="text/css">
.top-bar .dropdown > li.mega-menu ul.menu.menu-classic{
  width: 500px !important;
  left: 0% !important;
} 
.mega-menu ul.menu.menu-classic li.cat{
  /* width: 50% !important; */
  float: left;
}

.mega-menu ul.menu.menu-classic li.cat span a{
  border-bottom: 2px solid #e2e2e2 !important;
  margin-top: 10px;
} 
.mega-menu ul.menu.menu-classic li.cat span a i{
  font-size: 15px;
  margin-left: 8px;
  opacity: 0.7;
}
.li-column ul li a i, .li-column h5 i{
  font-size: 15px;
  margin-left: 8px;
  opacity: 0.7;
}  
</style>

