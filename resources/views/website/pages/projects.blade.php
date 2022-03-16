@extends('templates.template-website', ['title' =>  trans('website.meta.projects-t') , 'description' => trans('website.meta.projects-d')])  


@section('content') 
<div class="sez-banner FWrap">
  <img src="{{asset('img/website/projects/home_01.jpg')}}" > 
</div>  

@for ($i = 1; $i < 12; $i++)
  <section class="FWrap sez-puzzle-custom mt-50">
    <div class="row header-sez">
      <div class="medium-6 column title-sez">
        <h2>@lang('website-text.project_'.$i.'_title')</h2>
      </div>
      <div class="medium-3 column subtitle-sez">
        <h2>@lang('website-text.project_'.$i.'_txt')</h2>
      </div>
      <div class="medium-3 column link-sez">
        <a  href="{{route('website-products-cuproom')}}?collection=cuproom" title="@lang('website-text.collection') CUPROOM design" class="">@lang('website-text.all_products')</a>
      </div>
    </div> 
    <div class="row d-flex galleryzoom">
      <div class="medium-6 <?=($i%2==0 ? 'order-medium-2' : '')?> column">
        <div class="product">
          <figure class="center-outer">
            <img src="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'.jpg')}}" alt="" /> 
            <figcaption>
              <ul class="center-inner"> 
                <li><a href="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'.jpg')}}" title="">
                  <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                </li> 
              </ul>
            </figcaption>
          </figure>
        </div>
      </div>
      <div class="small-6 medium-3 column <?=($i%2==0 ? 'order-medium-1' : '')?> col-center">
        <div class="product">
          <figure>
            <img src="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_A.jpg')}}" alt="" />
            <figcaption>
              <ul class="center-inner"> 
                <li><a href="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_A.jpg')}}" title="">
                  <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                </li> 
              </ul>
            </figcaption> 
          </figure>
        </div>
        <div class="product">
          <figure>
            <img src="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_B.jpg')}}" alt="" />
            <figcaption>
              <ul class="center-inner"> 
                <li><a href="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_B.jpg')}}" title="">
                  <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                </li> 
              </ul>
            </figcaption>
          </figure> 
        </div>
      </div>
      <div class="small-6 medium-3 column <?=($i%2==0 ? 'order-medium-1' : '')?> col-dx">
        <div class="product">
          <figure>
            <img src="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_C.jpg')}}" alt="" />
            <figcaption>
              <ul class="center-inner"> 
                <li><a href="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_C.jpg')}}" title="">
                  <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                </li> 
              </ul>
            </figcaption> 
          </figure>
        </div>
        <div class="product">
          <figure>
            <img src="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_D.jpg')}}" alt="" />
            <figcaption>
              <ul class="center-inner"> 
                <li><a href="{{asset('img/website/projects/progetti_'.($i<10 ? '0'.$i : $i).'_D.jpg')}}" title="">
                  <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                </li> 
              </ul>
            </figcaption>
          </figure> 
        </div>
      </div>
    </div>
  </section>
@endfor


@stop
     

@section('page-script')


@stop

