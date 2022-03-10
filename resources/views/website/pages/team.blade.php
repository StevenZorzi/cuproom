@extends('templates.template-website', ['title' =>  trans('website.meta.about-t') , 'description' => trans('website.meta.about-d')])


@section('content') 

<!-- Modifica di prova -- Slider -- --> 
<ul class="home-slider home-slider4 sez-slogan">
  <li class="home-slide"> <img class="slider-img" src="{{asset('img/website/squadra/bg-testata.jpg')}}" alt="@lang('website.altitle.c-slide-1')" />
    <div class="slider-caption slide2-cp slider-caption-high">
      <div class="row">
        <div class="inner-caption float-right text-right mt-50">
          <div class="text-center">
            <h1 class="title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0" style="padding-right:40px">@lang('website-text.team_slide_title')</h1>
            <div class="wow fadeIn" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0" style="padding-right:40px">
              <a href="#gallery" class="internal shop-now">@lang('website-text.team_slide_txt')</a> 
            </div>
          </div> 
        </div>
      </div>
    </div>
  </li>
</ul>

<div class="clearfix"></div>

<section class="top-product3 white FWrap">
  <div class="row">
    <div class="small-12 columns"> 
      <div class="row-10">
        <ul class="">

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_A.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_1')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_B.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_2')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_C.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_3')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_D.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_4')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_E.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_5')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_F.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_6')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_G.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_7')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_H.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_8')</h5>  
            </div>
          </li> 

          <li class="medium-4 column item-team">
            <div class="product">
              <figure class="center-outer"> 
                <img src="{{asset('img/website/squadra/squadra_02_I.jpg')}}" alt="">  
              </figure> 
              <h3>@lang('website-text.team_item_9')</h5>  
            </div>
          </li> 

        </ul>
      </div>
    </div>
  </div>
</section>


<!-- Modifica di prova -- Slider -- --> 
<ul class="home-slider home-slider4 sez-intro-2">
  <li class="home-slide"> <img class="slider-img" src="{{asset('img/website/squadra/squadra_03.jpg')}}" alt="@lang('website.altitle.c-slide-1')" />
    <div class="slider-caption slide2-cp slider-caption-high">
      <div class="row">
        <div class="inner-caption float-left text-right mt-50">
          <div class="text-center">
            <h1 class="title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0" style="padding-right:40px">@lang('website-text.team_sez_2_title')</h1>
            <div class="wow fadeIn" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0" style="padding-right:40px">
              <a href="{{route('website-about')}}" class="internal btn-style-2">@lang('website-text.team_sez_2_btn') <i class="fa fa-angle-double-right"></i></a> 
            </div> 
          </div> 
        </div>
      </div>
    </div>
  </li>
</ul>

<section class="home-collection FWrap">
  <div class="row">
    <div class="small-12 columns col-inner">

      <div class="medium-4 float-left"> 
        <!-- Collection --> 
        <div class="small-6 column collection">
          <figure><img src="{{asset('img/website/homepage/specchi.jpg')}}" alt=""></figure> 
          <div class="collection-hover">
            <div class="center-inner">
              <h5 class="text-white">@lang('website-text.home_collection_1_title')</h5> 
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-pots') ])}}" title="@lang('website.altitle.cr-cat-t1')" class="btn-style-2">@lang('website-text.home_collection_1_url') <i class="fa fa-angle-double-right"></i></a></div>
          </div>
        </div>
        
        <!-- Collection -->
        
        <div class="small-6 column collection">
          <figure><img src="{{asset('img/website/homepage/portaombrelli.jpg')}}" alt=""></figure> 
          <div class="collection-hover">
            <div class="center-inner">
              <h5 class="text-white">@lang('website-text.home_collection_2_title')</h5> 
            </div>
           <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-umbrella-stands') ])}}" title="@lang('website.altitle.cr-cat-t2')" class="btn-style-2">@lang('website-text.home_collection_2_url') <i class="fa fa-angle-double-right"></i></a></div>
          </div>
        </div> 
      </div>

      <div class="small-6 medium-4 column float-left main-col"> 
        <!-- Collection -->
        <div class="collection main-collection">
          <figure><a href="javascript:void(0)"><img src="{{asset('img/website/homepage/fioriere.jpg')}}" alt=""></a></figure> 
          <div class="collection-hover">
            <div class="center-inner">
              <h5 class="text-white">@lang('website-text.home_collection_3_title')</h5> 
            </div>
           <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-planters') ])}}" title="@lang('website.altitle.cr-cat-t3')" class="btn-style-2">@lang('website-text.home_collection_3_url') <i class="fa fa-angle-double-right"></i></a></div>
          </div>
        </div>
      </div>

      <div class="small-6 medium-4 float-left column col-right"> 
        <!-- Collection -->
        <div class="collection">
          <figure><img src="{{asset('img/website/homepage/anfore.jpg')}}" alt=""></figure> 
          <div class="collection-hover">  
            <div class="center-inner">
              <h5 class="text-white">@lang('website-text.home_collection_4_title')</h5> 
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-amphorae') ])}}" title="@lang('website.altitle.cr-cat-t4')" class="btn-style-2">@lang('website-text.home_collection_4_url') <i class="fa fa-angle-double-right"></i></a></div>
          </div>
        </div>
        <!-- Collection -->
        <div class="collection">
          <figure><img src="{{asset('img/website/homepage/accessori.jpg')}}" alt=""></figure> 
          <div class="collection-hover">  
            <div class="center-inner">
              <h5 class="text-white">@lang('website-text.home_collection_5_title')</h5> 
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-accessories') ])}}" title="@lang('website.altitle.cr-cat-t5')" class="btn-style-2">@lang('website-text.home_collection_5_url') <i class="fa fa-angle-double-right"></i></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  


@stop
     

@section('page-script')
 

@stop

