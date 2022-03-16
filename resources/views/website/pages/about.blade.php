@extends('templates.template-website', ['title' =>  trans('website.meta.about-t') , 'description' => trans('website.meta.about-d')])


@section('content') 

<div class="sez-banner fnt-small FWrap">
  <img src="{{asset('img/website/chi-siamo/chisiamo_01.jpg')}}"  alt="@lang('website.altitle.c-slide-1')">
  <div class="inner" style="top: 50%; left: 5%; width: 600px; transform: translateY(-50%);">
    <h1 class="text-white title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.about_sez1_title')</h1> 
    <p class="text-white wow fadeIn" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0">@lang('website-text.about_sez1_txt')</p> 
  </div>
</div>  

<div class="clearfix"></div>
<section class="product-counter2 p0 mb-50 mt-50 FWrap">
  <div class="row"> 
    <div class="medium-6 column pt-50 pt0-xs pt0-sm">
      <h6 class="text-left wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.about_sez2_title')</h6> 
      <div class="wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="lead">@lang('website-text.about_sez2_txt')</p> 
      </div>
    </div>
    <div class="medium-6 column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/chi-siamo/chisiamo_02.jpg')}}" alt="@lang('website-text.about_sez2_title')" /></figure>
    </div>
  </div> 
</section> 

<div class="sez-banner fnt-small FWrap">
  <img src="{{asset('img/website/chi-siamo/chisiamo_03.jpg')}}"  alt="@lang('website-text.about_sez5_title')">
  <div class="inner text-center" style="top: 50%; right: 10%; width: 400px; transform: translateY(-50%);">
    <img src="{{asset('img/logo-celatorito.png')}}" width="100" class="mb-30">
    <h2 class="text-white title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.about_sez3_title')</h2> 
    <div class="text-white wow fadeIn" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0">
      <p class="">@lang('website-text.about_sez3_txt')</p> 
      <a href="{{route('website-finishes')}}" title="@lang('website-text.about_sez5_txt')" class="button-type-1 white">
        @lang('website-text.about_sez3_link')
      </a> 
    </div>
  </div>
</div>   

<section class="product-counter2 p0 mb-50 mt-50 FWrap">
  <div class="row align-items: center;"> 
    <div class="medium-6 column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/chi-siamo/chisiamo_04.jpg')}}" alt="@lang('website-text.about_sez4_title')" /></figure>
    </div>
    <div class="medium-5 medium-offset-1 column pt-50 pt0-xs pt0-sm">
      <h6 class="text-left wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.about_sez4_title')</h6> 
      <div class="wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="lead">@lang('website-text.about_sez4_txt')</p> 
      </div>
    </div> 
  </div> 
</section>  

<div class="sez-banner fnt-small FWrap">
  <img src="{{asset('img/website/chi-siamo/chisiamo_05.jpg')}}"  alt="@lang('website-text.about_sez5_title')">
  <div class="inner" style="bottom: 10%; right: 10%; width: 600px;">
    <h2 class="text-center text-white title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.about_sez5_title')</h2>  
    <div class="text-center text-white wow fadeIn" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0"> 
      <a href="{{route('website-finishes')}}" title="@lang('website-text.about_sez5_txt')" class="button-type-1 white">@lang('website-text.about_sez5_txt')</a> 
    </div>
  </div>
</div>  

<section class="product-counter2 p0 mb-50 mt-50 FWrap">
  <div class="row"> 
    <div class="medium-5 column pt-50 pt0-xs pt0-sm">
      <h6 class="text-left wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.about_sez6_title')</h6> 
      <div class="wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="lead">@lang('website-text.about_sez6_txt')</p> 
      </div>
    </div>
    <div class="medium-6 medium-offset-1 column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/chi-siamo/chisiamo_06.jpg')}}" alt="@lang('website-text.about_sez6_title')" /></figure>
    </div>
  </div> 
</section> 

<section class="product-counter2 mb-50 mt-50  pt-30 pb-30 FWrap bg-grey">
  <div class="row"> 
    <div class="medium-6  column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/chi-siamo/chisiamo_07.jpg')}}" alt="@lang('website-text.about_sez7_title')" /></figure>
    </div>
    <div class="medium-5 medium-offset-1 column pt-50 pt0-xs pt0-sm text-left"> 
      <img src="{{asset('img/website/chi-siamo/sostenibilita.png')}}" width="100">
      <h6 class="text-left text-white wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.about_sez7_title')</h6> 
      <div class="wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="lead text-white">@lang('website-text.about_sez7_txt')</p> 
      </div>
    </div> 
  </div> 
</section> 


@stop
     

@section('page-script')
 

@stop

