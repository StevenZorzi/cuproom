@extends('templates.template-website', ['title' =>  trans('website-text.promo-1-h1') , 'description' => trans('website-text.promo-1-h1')])

@section('content') 


<section class="banner overly dark FWrap"> <img class="slider-img" src="{{asset('img/website/promo/promo-borse-website.jpg')}}" alt="" />
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column">
        <h1 class="text-center">@lang('website-text.promo-1-h1')</h1>
        <p class="medium-10 medium-offset-1 mt-40 text-white text-center hide-xs">@lang('website-text.promo-1-p')</p>
      </div>
    </div>
  </div>
</section>


<section class="product-cover FWrap">
  <div class="row">
    <div class="medium-12 column">

      <div class="row">
        <div class="small-6 medium-4 column">
          <div class="text-center">
            <figure class="center-outer"> <img src="{{asset('img/website/promo/bags/thumb/borsa-acciaio.jpg')}}" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="https://www.ebay.it/itm/323969290097?ViewItem=&item=323969290097&ssPageName=ADME:L:LCA:IT:1123" title="@lang('website-text.fin-106')" target="_blank"></a></li> 
                </ul>
              </figcaption>
            </figure> 
            <p class="desc"><b>@lang('website-text.promo-1-p1') + Prosecco</b><br><span class="big">180€</span></p>
            <a href="https://www.ebay.it/itm/323969290097?ViewItem=&item=323969290097&ssPageName=ADME:L:LCA:IT:1123" title="@lang('website-text.promo-callto-acq')" class="button border small mt-20" target="_blank">@lang('website-text.promo-callto-acq')</a>
          </div>
        </div>
        <div class="small-6 medium-4  column mb-20">
          <div class="text-center">
            <figure class="center-outer"> <img src="{{asset('img/website/promo/bags/thumb/borsa-ottone.jpg')}}" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="https://www.ebay.it/itm/borsa-in-ottone-Prosecco-Valdobbiadene-cesto-regalo-natalizio/323969280968?hash=item4b6e12ebc8:g:o9MAAOSwCDxdv~ZJ" title="@lang('website-text.promo-callto-acq')" target="_blank"></a></li> 
                </ul>
              </figcaption>
            </figure>
            <p class="desc"><b>@lang('website-text.promo-1-p2') + Prosecco</b><br><span class="big">185€</span></p>
            <a href="https://www.ebay.it/itm/borsa-in-ottone-Prosecco-Valdobbiadene-cesto-regalo-natalizio/323969280968?hash=item4b6e12ebc8:g:o9MAAOSwCDxdv~ZJ" title="@lang('website-text.promo-callto-acq')" class="button border small mt-20" target="_blank">@lang('website-text.promo-callto-acq')</a>
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="text-center">
            <figure class="center-outer"> <img src="{{asset('img/website/promo/bags/thumb/borsa-mosaico.jpg')}}" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="https://www.ebay.it/itm/CESTO-REGALO-NATALIZIO-BORSA-IN-METALLO-MOSAICO-PROSECCO-DI-VALDOBBIADENE/323969294698?hash=item4b6e13216a:g:qmAAAOSwMyFdv~-4"  title="@lang('website-text.promo-callto-acq')" target="_blank"></a></li> 
                </ul>
              </figcaption>
            </figure>
            <p class="desc"><b>@lang('website-text.promo-1-p3') + Prosecco</b><br><span class="big">270€</span></p>
            <a href="https://www.ebay.it/itm/CESTO-REGALO-NATALIZIO-BORSA-IN-METALLO-MOSAICO-PROSECCO-DI-VALDOBBIADENE/323969294698?hash=item4b6e13216a:g:qmAAAOSwMyFdv~-4" title="@lang('website-text.promo-callto-acq')" class="button border small mt-20" target="_blank">@lang('website-text.promo-callto-acq')</a>
          </div>
        </div>
        

      </div>
    </div>

  </div> 
</section>
<!-- fine finiture -->





@stop
     

@section('page-script')

<style>
  figcaption ul { height: 100%; }
  figcaption ul li{ display:block; width: 100%; height: 100%; }
  figcaption ul li a{ display:block !important; width: 100% !important; height: 100% !important; background: none !important; position: relative; }
  figcaption ul li a span{ display:block; top: 48%; position: relative; font-size: 18px; }


  .banner{ background-position: center center !important; }
  @media (max-width: 767px){
      .banner p{ font-size: 13px; line-height: 17px; padding: 0 20px; }
      .banner h1{ font-size: 32px; line-height: 35px; }
  }

  p.desc span{ font-size: 20px;  }

</style>


@stop

