@extends('templates.template-website', ['title' => trans('website.meta.products-cr-t'), 'description' => trans('website.meta.products-cr-d')])  


@section('content')  

<section class="banner overly FWrap"> <img class="slider-img" src="{{asset('img/website/classic/brass-rows.jpg')}}" alt="" />
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column">
        <ul>
          <li><a href="{{route('website-classic')}}" title="{{trans('website.meta.cr-t')}}">CELATORITO classic</a></li>
          <li><a href="{{route('website-products-classic')}}" title="@lang('website-text.all-products') CELATORITO classic">@lang('website-text.products')</a></li>
          @if($cat->name != "")
          <li>{{$cat->name}}</li>
          @endif
        </ul>
        <h1>@if($cat->name != ""){{$cat->name}}@else @lang('website-text.products')@endif CELATORITO Classic</h1>
        <p class="medium-6 mt-40 text-white">@if(isset($meta)){{$meta->description}}@else{{trans('website.meta.products-cr-d')}}@endif</p>
      </div>
    </div>
  </div>
</section>

<!-- store -->
<section class="store FWrap">
  <div class="row">

    <div class="large-3 medium-4 column productbar">
      <div class="productbar-wrap">
        <h6>@lang('website-text.categories')</h6>
        <ul>
          <li><a href="{{route('website-products-classic')}}" title="@lang('website-text.all-products') CELATORITO classic" @if($cat->slug == "") class="current" @endif>@lang('website-text.all') <span>{{$main_cat->count(3)}}</span></a></li>

          @foreach($categories as $category)
          @php $catMeta = $category->metaTag(); @endphp
          <li><a href="{{route('website-products-classic', ['categoria' => $category->slug ])}}" title="@if(!is_null($catMeta)){{$catMeta->title}}@else{{$category->name}} CELATORITO classic @endif" @if($cat->slug == $category->slug) class="current" @endif>{{$category->name}} <span>{{$category->base->count(3)}}</span></a></li>
          @endforeach
        </ul> 
      </div>

      <div class="productbar-wrap hide-for-small-only">
        <h6>@lang('website-text.finishes')</h6>
        <ul>
          @foreach($finishes as $finish)
            @if($finish->images()->count())
            <li><a href="@if($f == $finish->id){{route('website-products-classic', ['categoria' => $cat->slug ])}}@else{{route('website-products-classic', ['categoria' => $cat->slug, 'f' => $finish->id ])}}@endif" class="mt-5 @if($f == $finish->id) current @endif" title="{{$finish->getText()->name}}"><img src="{{url($finish->preview())}}" width="30" style="border-radius:15px;" alt="{{$finish->getText()->name}}">&nbsp; {{$finish->getText()->name}} @if($f == $finish->id)<span class="active">x</span>@endif</a></li>
            @endif
          @endforeach
        </ul> 
      </div>

    </div>

    <div class="large-9 medium-8 column productlist">  
      <!-- Product List --> 
      <div class="row">

        @forelse($products as $product)
        <div class="product-list">
          <div class="medium-4 column">
            <figure class="center-outer"> <img class="thumbnail" src="{{asset($product->base->preview())}}" alt="{{$product->name}}" /> 
            </figure>
          </div>
          <div class="medium-8 column">
            <div class="product-info">
              <div class="float-left"> <span><a>{{$product->base->code}}</a></span>
                <h5><a href="{{route('website-single-product-cr', ['slug' => $product->slug ])}}" title="{{$product->name}}">{{$product->name}}</a></h5>
              </div>
            </div>
            <p>{{$product->excerpt()}}</p><br>
            @foreach($product->base->colors() as $color)
              
              <img class="mt-10" src="{{url($color->preview())}}" width="40" style="border-radius:20px;" alt="{{$color->getText()->name}}"> &nbsp;
            @endforeach
            <br><br>
            <a href="{{route('website-single-product-cr', ['slug' => $product->slug ])}}" title="{{$product->name}}" class="button border small">@lang('website-text.btn_view')</a>
          </div>
        </div> 
        @empty
        <p class="text-center">@lang('website-text.no-content')</p>
        @endforelse

      </div>
      
      <!-- Pagination -->
      <div class="custom-pagination">
        @if(isset($f))
          {{ $products->appends(['f' => $f])->links() }}
        @else
        {{ $products->links() }}
        @endif
      </div>

    </div>
  </div>
</section>

@stop
     

@section('page-script')


@stop

