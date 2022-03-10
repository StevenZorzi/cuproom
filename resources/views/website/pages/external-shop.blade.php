@extends('templates.template-website', ['title' =>  trans('website.meta.shop-t') , 'description' => trans('website.meta.shop-d')])  


@section('content') 

<section class="overly light FWrap">
  <img class="slider-img" src="{{asset('img/website/vasi-rame-villa.jpg')}}" alt="@lang('website.altitle.shop-slide')" />
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column text-center mt-60 mb-60">
          <h1 class="text-white"><i class="fa fa-shopping-basket" aria-hidden="true"></i><br>
          @lang('website-text.title_shop_online')</a></h1>
          <h5 class="text-white">@lang('website-text.subtitle_shop_online')</h5>
          <div class="mt-40">
             <a target="_blank" href="http://stores.ebay.it/VASI-PORTAOMBRELLI-MADEINITALY" title="Shop online" class="button white">Shop Now</a>
          </div>
      </div>
    </div>
  </div>
</section>

@stop
     

@section('page-script')
 

@stop

