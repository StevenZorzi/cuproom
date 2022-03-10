@extends('templates.template-website', ['title' =>  trans('website.meta.projects-t') , 'description' => trans('website.meta.projects-d')])  


@section('content') 

<ul class="home-slider FWrap">
  <li class="home-slide overly slide-1"> <img class="slider-img" src="{{asset('img/website/projects/home_01.jpg')}}" alt="" /> 
  </li>
</ul> 

<section class="FWrap sez-puzzle-custom mt-50 mb-50">

  <div class="row header-sez">
    <div class="medium-6 column title-sez">
      <h2><span>model</span> flute spring</h2>
    </div>
    <div class="medium-3 column subtitle-sez">
      <h2><span>material</span> steel</h2>
    </div>
    <div class="medium-3 column link-sez">
      <a href="#" title="" class="">Scopri tutti i nostri progetti</a>
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

@stop
     

@section('page-script')


@stop

