@extends('templates.template-website', ['title' =>  trans('website.meta.projects-t') , 'description' => trans('website.meta.projects-d')])  


@section('content') 

<ul class="home-slider FWrap home-slider4">
  <li class="home-slide overly slide-1"> <img class="slider-img" src="{{asset('img/website/projects/home_01.jpg')}}" alt="" /> 
  </li>
</ul> 

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_1_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_1_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row">
    <div class="medium-6 column">
      <figure><img src="{{asset('img/website/projects/progetti_01.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-center">
      <figure><img src="{{asset('img/website/projects/progetti_01_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_01_D.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_01_C.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_01_B.jpg')}}" alt="" /></figure>
    </div>
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_2_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_2_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="small-6 medium-3 column order-sm-2 col-center">
      <figure><img src="{{asset('img/website/projects/progetti_02_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_02_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column order-sm-2 col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_02_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_02_D.jpg')}}" alt="" /></figure>
    </div>
    <div class="medium-6 column order-sm-1">
      <figure><img src="{{asset('img/website/projects/progetti_02.jpg')}}" alt="" /></figure>
    </div>
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_3_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_3_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="medium-6 column">
      <figure><img src="{{asset('img/website/projects/progetti_03.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-center">
      <figure><img src="{{asset('img/website/projects/progetti_03_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_03_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_03_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_03_D.jpg')}}" alt="" /></figure>
    </div> 
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_4_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_4_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="small-6 medium-3 column order-sm-2 col-center">
      <figure><img src="{{asset('img/website/projects/progetti_04_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_04_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column order-sm-2 col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_04_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_04_D.jpg')}}" alt="" /></figure>
    </div>
    <div class="medium-6 column order-sm-1">
      <figure><img src="{{asset('img/website/projects/progetti_04.jpg')}}" alt="" /></figure>
    </div>
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_5_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_5_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="medium-6 column">
      <figure><img src="{{asset('img/website/projects/progetti_05.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-center">
      <figure><img src="{{asset('img/website/projects/progetti_05_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_05_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_05_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_05_D.jpg')}}" alt="" /></figure>
    </div> 
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_6_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_6_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="small-6 medium-3 column order-sm-2 col-center">
      <figure><img src="{{asset('img/website/projects/progetti_06_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_06_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column order-sm-2 col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_06_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_06_D.jpg')}}" alt="" /></figure>
    </div>
    <div class="medium-6 column order-sm-1">
      <figure><img src="{{asset('img/website/projects/progetti_06.jpg')}}" alt="" /></figure>
    </div>
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_7_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_7_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="medium-6 column">
      <figure><img src="{{asset('img/website/projects/progetti_07.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-center">
      <figure><img src="{{asset('img/website/projects/progetti_07_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_07_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_07_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_07_D.jpg')}}" alt="" /></figure>
    </div> 
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_8_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_8_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="small-6 medium-3 column order-sm-2 col-center">
      <figure><img src="{{asset('img/website/projects/progetti_08_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_08_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column order-sm-2 col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_08_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_08_D.jpg')}}" alt="" /></figure>
    </div>
    <div class="medium-6 column order-sm-1">
      <figure><img src="{{asset('img/website/projects/progetti_08.jpg')}}" alt="" /></figure>
    </div>
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_9_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_9_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="medium-6 column">
      <figure><img src="{{asset('img/website/projects/progetti_09.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-center">
      <figure><img src="{{asset('img/website/projects/progetti_09_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_09_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_09_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_09_D.jpg')}}" alt="" /></figure>
    </div> 
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_10_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_10_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="small-6 medium-3 column order-sm-2 col-center">
      <figure><img src="{{asset('img/website/projects/progetti_10_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_10_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column order-sm-2 col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_10_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_10_D.jpg')}}" alt="" /></figure>
    </div>
    <div class="medium-6 column order-sm-1">
      <figure><img src="{{asset('img/website/projects/progetti_10.jpg')}}" alt="" /></figure>
    </div>
  </div>
</section>

<section class="FWrap sez-puzzle-custom mt-50 mb-50">
  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2>@lang('website-text.project_11_title')</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2>@lang('website-text.project_1_txt')</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">@lang('website-text.all_products')</a>
    </div>
  </div>
  <div class="row"> 
    <div class="medium-6 column">
      <figure><img src="{{asset('img/website/projects/progetti_11.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-center">
      <figure><img src="{{asset('img/website/projects/progetti_11_A.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_11_C.jpg')}}" alt="" /></figure>
    </div>
    <div class="small-6 medium-3 column col-dx">
      <figure><img src="{{asset('img/website/projects/progetti_11_B.jpg')}}" alt="" /></figure>
      <figure><img src="{{asset('img/website/projects/progetti_11_D.jpg')}}" alt="" /></figure>
    </div> 
  </div>
</section>

@stop
     

@section('page-script')


@stop

