@extends('templates.template-website', ['title' =>  $meta_t , 'description' => $meta_d])  


@section('content')  

 <section class="banner gray FWrap">
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column">
        <ul>
          <li>Home</a></li>
          <li><a href="{{route('website-news')}}" title="{{trans('website.meta.news-t')}}">News</a></li>
        </ul>
        <h1>{{$article->title}}</h1>
      </div>
    </div>
  </div>
</section>

<!-- blog -->

<section class="main-blog FWrap">
  <div class="row">
    <div class="large-9 medium-8 column">
      <div class="latest-blog p30">
        <img src="{{asset($article->base->preview('full'))}}" alt="" />
        <a class="button border" tabindex="0">{{$article->base->created_at->formatLocalized('%d %h %Y')}}</a> 
        <h5><a tabindex="0">{{$article->subtitle}}</a></h5>
        {!!$article->content!!}
      </div>  
    </div>

    <div class="large-3 medium-4 column productbar blogbar p30"> 
      <h6>@lang('website-text.title_sez_news')</h6>
      <ul>
        @foreach($news as $new)
        <li><a href="{{route('website-single-news', ['blogslug' => $new->slug])}}" title="{{$article->title}}">{{$new->title}}</a></li>
        @endforeach
      </ul>  
    </div>
  </div>
</section>

@stop
     

@section('page-script')



@stop

