@extends('templates.template-website', ['title' =>  $product->name.' by CUPROOM design' , 'description' => $product->excerpt(320)])  


@section('content')  
 
    
<section class="banner FWrap gray">
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column">
        <ul>
          <li><a href="{{route('website-cuproom')}}" title="{{trans('website.meta.cup-t')}}">CUPROOM design</a></li>
          <li><a href="{{route('website-products-cuproom')}}" title="@lang('website-text.all-products') CUPROOM design">@lang('website-text.products')</a></li>
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
      @if($images->count() > 1)
      <ul class="slider-nav poplet">
        @foreach($images as $img)
        <li>
          <figure><img src="{{img_path($product->base, $img)}}" alt="Thumb {{$product->name}}" /></figure>
        </li>
        @endforeach
      </ul>
      @endif
    </div>
    <div class="medium-6 column">
      <div class="product-detail"> 
        
        <p>{!! $product->description !!}</p>
        <div>
          @if($productBase->dimensions != "")
            <span>@lang('website-text.dimensions') (cm): </span>{{$productBase->dimensions}}
            <br>
          @endif

          @foreach($finishes as $color)
            @if($loop->first)
                <span>@lang('website-text.finishes'): </span>
            @endif
            <a>{{$color->getText()->name}}</a>
            @if(!$loop->last) - @endif
            @if($loop->last) <br> @endif
          @endforeach

          @foreach($brands as $designer)
              @if($loop->first)
                <span>Designer: </span>
              @endif
              @php $designerData = $designer->getText(); @endphp
              <a href="{{route('website-designers')}}">{{$designerData->name}}</a> @if(!$loop->last) - @endif
          @endforeach

        </div>
        <div class="mt-20">
          <h5>@lang('website-text.categories')</h5>
          @foreach($categories as $category)
              @php $catData = $category->getText(); @endphp
              @if($category->parent_id != '8')
                @php $parentData = $category->parent()->getText(); @endphp
                <a class="cat-list" href="{{route('website-products-cuproom', ['categoria' => $parentData->slug, 's' => $catData->base->id])}}" title="{{$catData->name}}">{{$catData->name}}</a> &nbsp;
              @else
              
              <a class="cat-list" href="{{route('website-products-cuproom', ['categoria' => $catData->slug])}}" title="{{$catData->name}}">{{$catData->name}}</a> &nbsp;
              @endif

          @endforeach
          <br>
        </div>
        <div class="mt-20 cup-info">
          <a class="button border small shop-now btn-cup" target="_blank" href="{{route('website-contact')}}?p={{$product->name}}"> @lang('website-text.title_form_contact') <i class="fa fa-long-arrow-right"></i></a>
          </div>
        <div class="mt-30">
          @foreach($documents as $doc)

            @if($loop->first) <div class="column medium-5"> @endif
              <img src="{{img_path($productBase, $doc, 'small')}}" style="max-height:315px" alt="@lang('website-text.dim-product')" />
            @if($loop->last) </div> @endif
          @endforeach
          
          @if($finishes->count() < 1)
          <div class="column medium-7">
            <img class="mt-10" width="300" src="{{asset('img/website/cuproom/metal-finishes-product.jpg')}}" alt="@lang('website-text.metal-finishes')" />
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
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
                    <li><a data-open="product-box" href="{{route('website-single-product-cup', ['slug' => $pd->slug ])}}" title="{{$pd->name}}"><img src="{{asset('img/website/icons/search.png')}}" alt="" /></a></li> 
                  </ul>
                </figcaption>
              </figure>
              <div class="product-info">
                <h5><a href="{{route('website-single-product-cup', ['slug' => $pd->slug ])}}" title="{{$pd->name}}">{{$pd->name}}</a></h5> 
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

