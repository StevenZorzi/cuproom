@extends('templates.template-website', ['title' =>  $product->name , 'description' => $product->description])  


@section('content')  
 
<div class="clearfix"></div>    
<section class="banner FWrap gray">
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column">
        <ul>
          <li><a href="{{route('website-classic')}}" title="{{trans('website.meta.cr-t')}}">CELATORITO classic</a></li>
          <li><a href="{{route('website-products-classic')}}" title="@lang('website-text.all-products') CELATORITO classic">@lang('website-text.products')</a></li>
          @php $catMeta = $main_cat->metaTag(); @endphp
          <li><a href="{{route('website-products-classic', ['categoria' => $main_cat->slug])}}" title="@if(!is_null($catMeta)){{$catMeta->title}}@endif">{{$main_cat->name}}</a></li>
        </ul> 
        <h1>{{$product->name}}</h1>
      </div>
    </div>
  </div>
</section>

<!-- Product Detail -->

<section class="store FWrap">
  <div class="row">
    <div class="medium-6 column">
      
      <ul class="slider-for large-img">
        @foreach($images as $img)
        <li>
          <figure><img src="{{img_path($product->base, $img, 'full')}}" alt="{{$product->name}}" @if($loop->iteration == '1' && !is_null($productBase->interactive)) id="myimagelinks" @endif></figure>
        </li> 
        @endforeach
      </ul>
    </div>
    <div class="medium-6 column">
      <div class="product-detail"> <span>CELATORITO classic</span>
        <h3>{{$productBase->code}}</h3>
          <p>{!! $product->description !!}</p>
          
        <div class="medium-12">

          <h5>@lang('website-text.finishes')</h5>
          <hr>
          @foreach($productBase->colors() as $color)
            <div class="column medium-6 p0 thumb-finish">
              <img class="thumbnail mt-10" src="{{url($color->preview())}}" width="80" alt="{{$color->getText()->name}}">
              <p>{{$color->getText()->name}}</p><br>
            </div>
          @endforeach

          <div class="clearfix"></div>
          <div class="mt-40">
            <a class="button small golden internal" href="#datasheet">@lang('website-text.datasheet') &nbsp; <i class="fa fa-angle-double-down"></i></a>
            &nbsp; 
            <a class="button small golden" target="_blank" href="{{route('website-contact')}}?p={{$productBase->code}} - {{$product->name}}" title="@lang('website-text.title_form_contact')"> @lang('website-text.title_form_contact')</a>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>

<div class="clearfix"></div>
<!-- Product Tab -->

<section id="datasheet" class="mb-50">
  <div class="product-tab FWrap">
    <ul class="tabs" data-tabs id="example-tabs">
      <li class="tabs-title is-active"><a href="#panel1">@lang('website-text.datasheet')</a></li> 
    </ul>
      <div class="row">
        <div class="small-12 columns">
          <div class="table-scroll mt-20">
          {!! $product->data_sheet !!}
          </div>
        </div>
      </div>
  </div>
  <div class="clearfix"></div>
</section>

<!-- Realated Product -->
@if($related->count())
<section class="related-product FWrap">
  <div class="row">
    <div class="small-12 columns">
      <h2 class="title">@lang('website-text.related-p')</h2>
      <div class="row-10">
        <ul class="grid-4 angle-arrow wow fadeInUp">

          @foreach($related as $pd)
          <li class="column">
            <div class="product">
              <figure class="center-outer"> <img src="{{asset($pd->base->preview())}}" alt="{{$pd->name}}" /> 
                <figcaption>
                  <ul class="center-inner"> 
                    <li><a data-open="product-box" href="{{route('website-single-product-cr', ['slug' => $pd->slug ])}}" title="{{$pd->name}}"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                  </ul>
                </figcaption>
              </figure>
              <div class="product-info">
                <h5><a href="{{route('website-single-product-cr', ['slug' => $pd->slug ])}}" title="{{$pd->name}}">{{$pd->name}}</a></h5> 
              </div>
            </div>
          </li>
          @endforeach
           
        </ul>
      </div>
    </div>
  </div>
</section>
@endif

@stop
     

@section('page-script')

<script>
$(document).ready(function() {
 
  @if(!is_null($productBase->interactive))
    {!! $productBase->interactive !!}
  @endif
 
});
</script>

@stop

