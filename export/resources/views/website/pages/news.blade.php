@extends('templates.template-website', ['title' =>  trans('website.meta.news-t') , 'description' => trans('website.meta.news-d')])  


@section('content') 

<section class="banner overly FWrap"> <img class="slider-img" src="{{asset('img/website/news/riccioli-di-ferro.jpg')}}" alt="" />
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column text-center">
        <ul>
          <li>@lang('website-text.subtitle_page_news')</li>
        </ul>
        <h1>News</h1>
      </div>
    </div>
  </div>
</section>

<!-- blog -->

<section class="main-blog FWrap">
  <div class="row">

    @foreach($news as $article)
    <div class="medium-6 large-4 column">
      <div class="latest-blog">
        <figure> <a href="{{route('website-single-news', ['blogslug' => $article->slug])}}" title="{{$article->title}}"><img src="{{asset($article->base->preview())}}" alt="{{$article->title}}" /></a> </figure>
        <a class="button border" >{{$article->base->created_at->formatLocalized('%d %h %Y')}}</a> 
        <h5><a href="{{route('website-single-news', ['blogslug' => $article->slug])}}" title="{{$article->title}}">{{$article->title}}</a></h5>
        {{$article->excerpt()}}<br><br>
        <a href="{{route('website-single-news', ['blogslug' => $article->slug])}}" title="{{$article->title}}" class="continue-btn">@lang('website-text.btn_read') &nbsp; <em class="fa fa-long-arrow-right" ></em></a> 
      </div> 
    </div>
    @endforeach

    <div class="medium-12 column">
      <!-- paginazione -->

      <div class="custom-pagination">
        {{ $news->links() }}
      </div>
    </div>
  </div>

</section>


@stop
     

@section('page-script')


@stop

