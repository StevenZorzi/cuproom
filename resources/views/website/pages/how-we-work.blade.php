@extends('templates.template-website', ['title' =>  trans('website.meta.about-t') , 'description' => trans('website.meta.about-d')])


@section('content') 
<div class="sez-banner FWrap">
  <img src="{{asset('img/website/come-lavoriamo/comelavoriamo_01.jpg')}}" > 
</div>   

<div class="clearfix"></div>
<section class="product-counter2 p0 mb-50 mt-50 FWrap">
  <div class="row"> 
    <div class="medium-5 column pt-50 pt0-xs pt0-sm">
      <h6 class="text-left wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.work_sez2_title')</h6> 
      <div class="wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="lead">@lang('website-text.work_sez2_txt')</p> 
      </div>
    </div>
    <div class="medium-6 medium-offset-1 column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/come-lavoriamo/comelavoriamo_02.jpg')}}" alt="@lang('website-text.work_sez2_title')" /></figure>
    </div>
  </div> 
</section> 

<div class="sez-banner FWrap">
  <img src="{{asset('img/website/come-lavoriamo/comelavoriamo_03.jpg')}}"  alt="@lang('website-text.work_sez3_title')">
  <div class="inner" style="top: 50%; right: 10%; width: 400px; transform: translateY(-50%);">
    <h2 class="text-left text-white title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.work_sez3_title')</h2>  
    <div class="text-left text-white wow fadeIn" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0"> 
      <p>@lang('website-text.work_sez3_txt')</p>
    </div>
  </div>
</div>   

<section class="product-counter2 p0 mb-50 mt-50 FWrap">
  <div class="row"> 
    <div class="medium-5 column pt-50 pt0-xs pt0-sm">
      <h6 class="text-left wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.work_sez4_title')</h6> 
      <div class="wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="lead">@lang('website-text.work_sez4_txt')</p> 
      </div>
    </div>
    <div class="medium-6 medium-offset-1 column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/come-lavoriamo/comelavoriamo_04.jpg')}}" alt="@lang('website-text.work_sez4_title')" /></figure>
    </div>
  </div> 
</section> 

<section class="product-counter2 mb-50 mt-50  pt-30 pb-30 FWrap bg-grey">
  <div class="row"> 
    <div class="medium-6  column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/come-lavoriamo/comelavoriamo_05.jpg')}}" alt="" /></figure>
    </div>
    <div class="medium-5 medium-offset-1 column pt-50 pt0-xs pt0-sm text-left"> 
      <img src="{{asset('img/website/come-lavoriamo/antibatterico.png')}}" width="100">
      <div class="wow fadeInUp mt-30" data-wow-delay="100" data-wow-duration="1.5s">
        <div class="text-white text-left">@lang('website-text.work_sez5_title')</div> 
      </div>
    </div> 
  </div> 
</section> 

<section class="product-counter2 p0 mb-50 mt-50 FWrap">
  <div class="row"> 
    <div class="medium-5 column pt-50 pt0-xs pt0-sm">
      <h6 class="text-left wow fadeInDown" data-wow-duration="1.5s">@lang('website-text.work_sez6_title')</h6> 
      <div class="wow fadeInUp" data-wow-delay="100" data-wow-duration="1.5s">
        <p class="lead">@lang('website-text.work_sez6_txt')</p> 
      </div>
    </div>
    <div class="medium-6 medium-offset-1 column wow fadeInUp"  data-wow-duration="1.5s">
      <figure><img src="{{asset('img/website/come-lavoriamo/comelavoriamo_06.jpg')}}" alt="@lang('website-text.work_sez6_title')" /></figure>
    </div>
  </div> 
</section> 

<div class="sez-banner FWrap">
  <img src="{{asset('img/website/come-lavoriamo/comelavoriamo_07.jpg')}}">
  <div class="inner" style="top: 50%; left: 20%;">
    <div class="cta-box">
      <a href="">
        <h3>sei un designer?</h3>
        <p>condividi con noi il tuo progetto</p>
      </a>
    </div>
    <p class="p-small">Saremo lieti di collaborare con te per realizzarlo!</p>
  </div>
</div>   


@stop
     

@section('page-script')
 

@stop

