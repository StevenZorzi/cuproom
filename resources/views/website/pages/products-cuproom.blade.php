@extends('templates.template-website', ['title' =>  trans('website.meta.products-cup-t') , 'description' => trans('website.meta.products-cup-d')])  


@section('content')  

<section class="banner overly FWrap"> <img class="slider-img" src='{{asset("img/website/cuproom/collection-$collection.jpg")}}' alt="" />
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column">
        <ul>

          <li><a href="{{route('website-cuproom')}}" title="{{trans('website.meta.cup-t')}}">
          @if($collection == 'cuproom') CUPROOM design @elseif($collection == '4season') 4 Season @else CUPROOM @endif</a></li>
          <li><a href="{{route('website-products-cuproom')}}" title="@lang('website-text.all-products') CUPROOM design">@lang('website-text.products')</a></li>
          @if($cat->name != "")
          <li>{{$cat->name}}</li>
          @endif
        </ul>
        <h1>@if($cat->name != ""){{$cat->name}}@else @lang('website-text.products')@endif @if($collection == 'cuproom') CUPROOM design @elseif($collection == '4season') 4 Season @else CUPROOM @endif</h1>
        <p class="medium-6 mt-40 text-white">@if(isset($meta)){{$meta->description}}@else{{trans('website.meta.products-cup-d')}}@endif</p>
      </div>
    </div>
  </div>
</section>

<!-- store -->
<section class="store FWrap">
  <div class="row">

    <div class="large-3 medium-4 column productbar">

      <div class="productbar-wrap">
        <h6>@lang('website-text.collection')</h6>
        <ul>
          @if($collection == '4season')
            <li><a href="{{route('website-products-cuproom')}}" title="@lang('website-text.all-products')" class="current">@lang('website-text.4season_collection')<span class="active">x</span></a></li>
          @else
            <li><a href="{{route('website-products-cuproom')}}?collection=4season" title="@lang('website-text.all-products')">@lang('website-text.4season_collection')</a></li>
          @endif

          @if($collection == 'cuproom')
            <li><a href="{{route('website-products-cuproom')}}" title="@lang('website-text.all-products')" class="current">@lang('website-text.cuproom_collection') @if($collection == 'cuproom')<span class="active">x</span>@endif</a></li>
          @else
            <li><a href="{{route('website-products-cuproom')}}?collection=cuproom" title="@lang('website-text.all-products')">@lang('website-text.cuproom_collection')</a></li>
          @endif
        </ul>
      </div>

      <div class="productbar-wrap">
        <h6>@lang('website-text.categories')</h6>
        <ul>
          <li><a href="{{route('website-products-cuproom').$param_collection}}" title="@lang('website-text.all-products')" @if($cat->slug == "") class="current" @endif>@lang('website-text.all') <span>{{$main_cat->count(3, $collection)}}</span></a></li>

          @foreach($categories as $category)

            @php $catMeta = $category->metaTag(); @endphp
            <li><a href="{{route('website-products-cuproom', ['categoria' => $category->slug ]).$param_collection}}" title="@if(!is_null($catMeta)){{$catMeta->title}}@else{{$category->name}} design by CUPROOM @endif" @if($cat->slug == $category->slug) class="current" @endif>{{$category->name}} <span>{{$category->base->count(3, $collection)}}</span></a></li>
            
            @php $subcats = $category->base->getChildsData(); @endphp
              
            @if($subcats->count())
            <li class="hide-for-small-only">
              <ul>
              @foreach($subcats as $subcat)
                  @php $catMeta = $subcat->metaTag(); @endphp
                  <li><a href="{{route('website-products-cuproom', ['categoria' => $category->slug, 's' => $subcat->base->id])}}{{str_replace('?', '&', $param_collection)}}" title="@if(!is_null($catMeta)){{$catMeta->title}}@else{{$subcat->name}} design by CUPROOM @endif" @if($s == $subcat->base->id) class="current" @endif>{{$subcat->name}} <span>{{$subcat->base->count(3, $collection)}}</span></a></li>
              @endforeach
              </ul>
            </li>
            @endif

          @endforeach
          
        </ul> 
      </div>

    </div>

    <div class="large-9 medium-8 column productlist">  
      <!-- Product List --> 
      <div class="row">

        @foreach($products as $product)
        <div class="product-list">
          <div class="medium-4 column">
            <figure class="center-outer"> <img class="thumbnail" src="{{asset($product->base->preview())}}" alt="{{$product->name}}" /> 
            </figure>
          </div>
          <div class="medium-8 column">
            <div class="product-info">
              <div class="float-left"> <span><a>{{$product->base->code}}</a></span>
                <h5><a href="{{route('website-single-product-cup', ['slug' => $product->slug ])}}" title="{{$product->name}}">{{$product->name}}</a></h5>
              </div>
            </div>
            <p>{{$product->excerpt()}}</p>
            <br>
            <img class="mb-20" src="{{asset('img/website/cuproom/metal-finishes-small.jpg')}}" width="250" /><br>
            <a href="{{route('website-single-product-cup', ['slug' => $product->slug ])}}" title="{{$product->name}}" class="button border small shop-now btn-cup">@lang('website-text.btn_view') <i class="fa fa-long-arrow-right"></i></a>
          </div>
        </div> 
        @endforeach

      </div>
      
      <!-- Pagination -->
      <div class="custom-pagination">
        {{ $products->appends(['s' => $s, 'collection' => $collection])->links() }}
      </div>

    </div>
  </div>
</section>

@stop
     

@section('page-script')


@stop
