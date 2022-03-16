@extends('templates.template-website', ['title' =>  trans('website.meta.homepage-t') , 'description' => trans('website.meta.homepage-d')])  


@section('content') 

 
<div class="sez-banner FWrap">
  <img src="{{asset('img/website/homepage/home_01.jpg')}}"  alt="@lang('website.altitle.h-slide-1')">
  <div class="inner" style="bottom: 20%; left: 15%; width: 600px;">
    <h1 class="text-white text-center title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.home_sez_1_title')</h1> 
     <div class="text-center wow fadeIn" data-wow-delay="1.9s" data-wow-duration="2s" data-wow-offset="0">
      <a href="{{route('website-projects')}}" class="button-type-1 white">@lang('website-text.home_sez_1_txt')</a> 
    </div>
  </div>
</div>  

<!-- INTRO SERVIZI -->
<div class="about FWrap">
  <div class="row">
    <div class="small-12 columns"> 

      <ul class="tabs" data-tabs="data-tabs" id="example-tabs">
        <li class="small-4 tabs-title is-active wow fadeIn"><a href="#panel1">
          <figure class="mb-20">
            <img src="{{asset('img/website/homepage/home_02_A.jpg')}}" alt="@lang('website-text.home_sez_2A_title')" /> 
          </figure>
          <span>@lang('website-text.home_sez_2A_title')</span></a>
        </li>
        <li class="small-4 tabs-title wow fadeIn" data-wow-delay="0.5s"><a href="#panel2">
          <figure class="mb-20">
            <img src="{{asset('img/website/homepage/home_02_B.jpg')}}" alt="@lang('website-text.home_sez_2B_title')" /> 
          </figure>
          <span>@lang('website-text.home_sez_2B_title')</span> </a>
        </li>
        <li class="small-4 tabs-title wow fadeIn" data-wow-delay="1s"><a href="#panel3">
          <figure class="mb-20">
            <img src="{{asset('img/website/homepage/home_02_C.jpg')}}" alt="@lang('website-text.home_sez_2C_title')" /> 
          </figure>
          <span>@lang('website-text.home_sez_2C_title')</span></a> 
        </li>
      </ul>

      <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1">
          <p>@lang('website-text.home_sez_2A_txt')</p>
        </div>
        <div class="tabs-panel" id="panel2">
          <p>@lang('website-text.home_sez_2B_txt')</p>
        </div>
        <div class="tabs-panel" id="panel3">
          <p>@lang('website-text.home_sez_2C_txt')</p>
        </div>
      </div>
      
    </div>
  </div>
</div>  

<div class="sez-banner FWrap">
  <img src="{{asset('img/website/homepage/home_03.jpg')}}"  alt="@lang('website.altitle.h-slide-1')">
  <div class="inner" style="top: 30%; left: 15%; width: 600px;">
    <h1 class="text-white text-center title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.home_sez_2_title')</h1> 
    <div class="text-center wow fadeIn" data-wow-delay="1.9s" data-wow-duration="2s" data-wow-offset="0">
      <a href="{{route('website-about')}}" class="button-type-1 white">@lang('website-text.home_sez_2_txt')</a> 
    </div>
  </div>
</div>     

<section class="sez-custom-1 pt-30 pb-30 FWrap bg-grey mt-50">
  <div class="row align-items-center"> 
    <div class="small-6 medium-6 column pb-30">
      <figure><img src="{{asset('img/website/homepage/home_04_A.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-6 column pb-30">
      <figure><img src="{{asset('img/website/homepage/home_04_B.jpg')}}" alt="" /></figure>
    </div> 
    <div class="medium-6 column order-sm-2 wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/homepage/home_04_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="medium-6 column order-sm-1 mt-sm-3 mb-sm-3 column">
      <h3 class="text-center text-white wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.home_sez_3_title')</h3> 
      <div class="text-center text-white wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="subtitle-intro text-uppercase"><b>@lang('website-text.home_sez_3_txt')</b></p> 
        <div class="text-center"> 
          <a href="{{route('website-finishes')}}"  title="{{trans('website-text.finishes')}}" class="button-type-1 white"></a>
        </div> 
      </div>
    </div>
  </div> 
</section> 

<section class="FWrap sez-puzzle-custom mt-50 mb-50">

  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2><span>model</span> flute spring</h2>
    </div>
    <div class="medium-6  large-3 column subtitle-sez">
      <h2><span>material</span> steel</h2>
    </div>
    <div class="large-3 column link-sez">
      <a href="{{route('website-products-cuproom')}}?collection=cuproom" title="@lang('website-text.collection') CUPROOM design" class="">Scopri tutti i nostri progetti</a>
    </div>
  </div>

  <div class="row">
    <div class="medium-6 column">
      <figure><img src="{{asset('img/website/homepage/home_05.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-center">
      <figure><img src="{{asset('img/website/homepage/home_05_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/homepage/home_05_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-dx">
      <figure><img src="{{asset('img/website/homepage/home_05_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/homepage/home_05_D.jpg')}}" alt="" /></figure>
    </div>
  </div>
</section> 

<div class="sez-banner FWrap">
  <img src="{{asset('img/website/homepage/home_06.jpg')}}"  alt="@lang('website-text.home_sez_4_title')">
  <div class="inner" style="bottom: 22%; left: 5%; width: 600px;">
    <h1 class="text-white text-center title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.home_sez_4_title')</h1> 
    <div class="text-center wow fadeIn" data-wow-delay="1.9s" data-wow-duration="2s" data-wow-offset="0">
      <a href="{{route('website-about')}}" class="button-type-1 white">@lang('website-text.home_sez_4_txt')</a> 
    </div>
  </div>
</div>     

@stop
     

@section('page-script')


@stop

