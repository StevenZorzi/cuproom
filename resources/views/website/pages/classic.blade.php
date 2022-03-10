@extends('templates.template-website', ['title' =>  trans('website.meta.cr-t') , 'description' => trans('website.meta.cr-d')])


@section('content') 

<ul class="home-slider FWrap">

  <li class="home-slide overly"> <img class="slider-img" src="{{asset('img/website/home/brass-classic-planters.jpg')}}" alt="@lang('website.altitle.cr-slide-1')" />
    <div class="slider-caption">
      <div class="row">
        <div class="inner-caption float-center text-center">
          <h1 class="txt-shadow wow fadeInDown" data-wow-delay="1s" data-wow-duration="1.6s" data-wow-offset="0">@lang('slider-text.classic_slider_title_1')</h1>
          <p class="txt-shadow wow fadeInUp" data-wow-delay="1.4s" data-wow-duration="1.6s" data-wow-offset="0">CelatoRito Classic</p>
      </div>
    </div>
  </li>
  <li class="home-slide overly"> <img class="slider-img" src="{{asset('img/website/classic/steel-planters-pot.jpg')}}" alt="@lang('website.altitle.cr-slide-2')" />
    <div class="slider-caption slider-caption-high">
      <div class="row">
        <div class="inner-caption float-left text-left">
          <h3 class="txt-shadow wow fadeIn"><line class="wow fadeIn" data-wow-delay="5.8s" data-wow-duration="1.6s">@lang('slider-text.classic_slider_title_2')</line> <br> 
          <line class="wow fadeIn" data-wow-delay="6.2s" data-wow-duration="1.6s">@lang('slider-text.classic_slider_title_2_2')</line></h3>
          <div class="wow fadeInRight" data-wow-delay="7s" data-wow-duration="1.6s" style="padding-left:12px">
            <p class="txt-shadow">
              <a class="internal" href="#finishes">@lang('slider-text.classic_slider_btn_2') &nbsp;<i class="fa fa-angle-double-down"></i></a>
            </p>
          </div>
      </div>
    </div>
  </li>

</ul>

<section class="home-collection FWrap">
  <div class="row">
    <div class="small-12 columns">
      <div class="medium-3 float-left"> 
        <!-- Collection -->
        
        <div class="collection">
          <figure><img class="wow zoomIn fadeIn" data-wow-duration="0.3s" src="{{asset('img/website/classic/categories/metal-pot.jpg')}}" alt="@lang('website.altitle.cr-cat-a1')" /></figure>
          <h5>@lang('website-text.classic_cat_vase')</h5>
          <div class="collection-hover">  
            <div class="center-inner">
              <h5><a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-pots') ])}}" title="@lang('website.altitle.cr-cat-t1')">@lang('website-text.classic_cat_vase')</a></h5>
              <p>@lang('website.altitle.cr-cat-t1')</p>
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-pots') ])}}" title="@lang('website.altitle.cr-cat-t1')">@lang('website-text.btn_more_products') <em class="fa fa-chevron-circle-right"></em></a></div>
          </div>
        </div>
        
        <!-- Collection -->
        
        <div class="collection">
          <figure><img class="wow zoomIn fadeIn" data-wow-duration="1.2s" src="{{asset('img/website/classic/categories/metal-umbrella-stand.jpg')}}" alt="@lang('website.altitle.cr-cat-a2')" /></figure>
          <h5>@lang('website-text.classic_cat_umbrella_stand')</h5>
          <div class="collection-hover"> 
            <div class="center-inner">
              <h5><a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-umbrella-stands') ])}}" title="@lang('website.altitle.cr-cat-t2')">@lang('website-text.classic_cat_umbrella_stand')</a></h5>
              <p>@lang('website.altitle.cr-cat-t2')</p>
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-umbrella-stands') ])}}" title="@lang('website.altitle.cr-cat-t2')">@lang('website-text.btn_more_products') <em class="fa fa-chevron-circle-right"></em></a></div>
          </div>
        </div>
      </div>
      <div class="medium-6 float-left"> 
        <!-- Collection -->
        <div class="collection main-collection">
          <figure><img class="wow zoomIn fadeIn" data-wow-duration="0.9s" src="{{asset('img/website/classic/categories/metal-planters.jpg')}}" alt="@lang('website.altitle.cr-cat-a3')" width="420" /></figure>
          <h5>@lang('website-text.classic_cat_flowerpot')</h5>
          <div class="collection-hover"> 
            <div class="center-inner">
              <h5><a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-planters') ])}}" title="@lang('website.altitle.cr-cat-t3')">@lang('website-text.classic_cat_flowerpot')</a></h5>
              <p>@lang('website.altitle.cr-cat-t3')</p>
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-planters') ])}}" title="@lang('website.altitle.cr-cat-t3')">@lang('website-text.btn_more_products') <em class="fa fa-chevron-circle-right"></em></a></div>
          </div>
        </div>
      </div>
      <div class="medium-3 float-left"> 
        <!-- Collection -->
        <div class="collection">
          <figure><img class="wow zoomIn fadeIn" data-wow-duration="0.6s" src="{{asset('img/website/classic/categories/metal-amphorae.jpg')}}" alt="@lang('website.altitle.cr-cat-a4')" /></figure>
          <h5>@lang('website-text.classic_cat_amphorae')</h5>
          <div class="collection-hover">  
            <div class="center-inner">
              <h5><a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-amphorae') ])}}" title="@lang('website.altitle.cr-cat-t4')">@lang('website-text.classic_cat_amphorae')</a></h5>
              <p>@lang('website.altitle.cr-cat-t4')</p>
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-amphorae') ])}}" title="@lang('website.altitle.cr-cat-t4')">@lang('website-text.btn_more_products') <em class="fa fa-chevron-circle-right"></em></a></div>
          </div>
        </div>
        <!-- Collection -->
        <div class="collection">
          <figure><img class="wow zoomIn fadeIn" data-wow-duration="1.5s" src="{{asset('img/website/classic/categories/metal-accessories.jpg')}}" alt="@lang('website.altitle.cr-cat-a5')" /></figure>
          <h5>@lang('website-text.classic_cat_accessories')</h5>
          <div class="collection-hover"> 
            <div class="center-inner">
              <h5><a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-accessories') ])}}" title="@lang('website.altitle.cr-cat-t5')">@lang('website-text.classic_cat_accessories')</a></h5>
              <p>@lang('website.altitle.cr-cat-t5')</p>
            </div>
            <div class="more-product"> <a href="{{route('website-products-classic', ['categoria' => trans('website.mc-cr-accessories') ])}}" title="@lang('website.altitle.cr-cat-t5')">@lang('website-text.btn_more_products') <em class="fa fa-chevron-circle-right"></em></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- about -->
<section class="product-counter FWrap">
  <div class="row flex-center">
    <div class="medium-7 column"> <span><a href="javascript:void(0)">@lang('website-text.classic_intro_title')</a></span>
      <h2><a href="javascript:void(0)">CELATORITO classic</a></h2>
      <div class="counter-caption">
        <p> @lang('website-text.classic_intro_text')</p>
      </div> 
    </div>
    <div class="medium-5 column">
      <figure> <img class="wow fadeIn" data-wow-duration="2s" src="{{asset('img/website/classic/portariviste-mosaico-metallo.png')}}" alt="@lang('website.altitle.cr-txt-img')" /> </figure> 
    </div>
  </div>
  <div class="bg-font"> <span>classic</span> </div>
</section>
<!-- fine about -->

<!-- finiture -->
<section id="finishes" class="product-cover galleryzoom FWrap">
  <div class="row">
    <div class="medium-6 column">
      <div class="row">
        <div class="small-6 medium-4 column">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/copper/rame-cretese.jpg')}}" alt="@lang('website.altitle.cr-f-c1')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/copper/rame-cretese.jpg')}}" title="@lang('website.altitle.cr-f-c1')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/copper/rame-fantasia-brunito.jpg')}}" alt="@lang('website.altitle.cr-f-c2')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/copper/rame-fantasia-brunito.jpg')}}" title="@lang('website.altitle.cr-f-c2')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/copper/rame-liscio-quadrotti.jpg')}}" alt="@lang('website.altitle.cr-f-c3')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/copper/rame-liscio-quadrotti.jpg')}}" title="@lang('website.altitle.cr-f-c3')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/copper/rame-martellato-lucido.jpg')}}" alt="@lang('website.altitle.cr-f-c4')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/copper/rame-martellato-lucido.jpg')}}" title="@lang('website.altitle.cr-f-c4')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/copper/rame-martellato-opaco.jpg')}}" alt="@lang('website.altitle.cr-f-c5')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/copper/rame-martellato-opaco.jpg')}}" title="@lang('website.altitle.cr-f-c5')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/copper/rame-satinato-liscio.jpg')}}" alt="@lang('website.altitle.cr-f-c6')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/copper/rame-satinato-liscio.jpg')}}" title="@lang('website.altitle.cr-f-c6')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="column">
          <h2>@lang('website-text.materials_rame_title')</h2>
          <p>@lang('website-text.materials_rame_text')</p>
        </div>
      </div>
    </div>
    <div class="medium-6 column">
      <figure class="collecion-box"><img src="{{asset('img/website/classic/finishes/copper/copper-box.jpg')}}" alt="@lang('website.altitle.cr-f-copper')" />
      </figure>
    </div>
  </div> 
</section>

<section class="product-cover galleryzoom FWrap">
  <div class="row ">
    <div class="medium-6 large-push-6 column">
      <div class="row">
        <div class="small-6 medium-4 column">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/brass/ottone-brunito-quadrotti.jpg')}}" alt="@lang('website.altitle.cr-f-b1')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/brass/ottone-brunito-quadrotti.jpg')}}" title="@lang('website.altitle.cr-f-b1')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/brass/ottone-liscio-brunito-opaco.jpg')}}" alt="@lang('website.altitle.cr-f-b2')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/brass/ottone-liscio-brunito-opaco.jpg')}}" title="@lang('website.altitle.cr-f-b2')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/brass/ottone-liscio-brunito.jpg')}}" alt="@lang('website.altitle.cr-f-b3')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/brass/ottone-liscio-brunito.jpg')}}" title="@lang('website.altitle.cr-f-b3')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/brass/ottone-liscio-quadrotti.jpg')}}" alt="@lang('website.altitle.cr-f-b4')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/brass/ottone-liscio-quadrotti.jpg')}}" title="@lang('website.altitle.cr-f-b4')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/brass/ottone-lucido-martellato.jpg')}}" alt="@lang('website.altitle.cr-f-b5')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/brass/ottone-lucido-martellato.jpg')}}" title="@lang('website.altitle.cr-f-b5')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/brass/ottone-satinato-liscio.jpg')}}" alt="@lang('website.altitle.cr-f-b6')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/brass/ottone-satinato-liscio.jpg')}}" alt="@lang('website.altitle.cr-f-b6')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="column">
          <h2>@lang('website-text.materials_brass_title')</h2>
          <p>@lang('website-text.materials_brass_text')</p>
        </div>
      </div>
    </div>
    <div class="medium-6 large-pull-6 column mb-10">
      <figure class="collecion-box"><img src="{{asset('img/website/classic/finishes/brass/brass-planter.jpg')}}" alt="@lang('website.altitle.cr-brass')" />
      </figure>
    </div>
  </div>
</section>

<section class="product-cover galleryzoom FWrap">
  <div class="row">
    <div class="medium-6 column">
      <div class="row">
        <div class="small-6 medium-4 column">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/steel/acciaio-inox-bru-martellato.jpg')}}" alt="@lang('website.altitle.cr-f-s1')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/steel/acciaio-inox-bru-martellato.jpg')}}" title="@lang('website.altitle.cr-f-s1')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/steel/acciaio-inox-brunito-quad.jpg')}}" alt="@lang('website.altitle.cr-f-s2')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/steel/acciaio-inox-brunito-quad.jpg')}}" title="@lang('website.altitle.cr-f-s2')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/steel/acciao-liscio-quadrotti.jpg')}}" alt="@lang('website.altitle.cr-f-s3')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/steel/acciao-liscio-quadrotti.jpg')}}" title="@lang('website.altitle.cr-f-s3')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/steel/acciao-martellato-fantasia-lucido.jpg')}}" alt="@lang('website.altitle.cr-f-s4')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/steel/acciao-martellato-fantasia-lucido.jpg')}}" title="@lang('website.altitle.cr-f-s4')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/steel/inox-liscio-lucido.jpg')}}" alt="@lang('website.altitle.cr-f-s5')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/steel/inox-liscio-lucido.jpg')}}" alt="@lang('website.altitle.cr-f-s5')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-6 medium-4 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/classic/finishes/steel/inox-liscio-satinato.jpg')}}" alt="@lang('website.altitle.cr-f-s6')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/classic/finishes/steel/inox-liscio-satinato.jpg')}}" title="@lang('website.altitle.cr-f-s6')"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="column">
          <h2>@lang('website-text.materials_steel_title')</h2>
          <p>@lang('website-text.materials_steel_text')</p>
        </div>
      </div>
    </div>
    <div class="medium-6 column">
      <figure class="collecion-box"><img src="{{asset('img/website/classic/finishes/steel/steel-planter.jpg')}}" alt="@lang('website.altitle.cr-f-steel')"/>
      </figure>
    </div>
  </div> 
</section>
<!-- fine finiture -->


<div class="lookbook FWrap">
  <div class="medium-6 column">
    <figure class="grid-large"><img class="bg-img" src="{{asset('img/website/classic/gallery/brass-furnishing-thumb.jpg')}}" alt="@lang('website.altitle.cr-g-1')" />
      <a href="{{asset('img/website/classic/gallery/brass-furnishing.jpg')}}" title="@lang('website.altitle.cr-g-1')"><div class="center-inner"><img src="{{asset('img/website/icons/pluse-icon.png')}}" /></div></a>
    </figure>
  </div>
  <div class="medium-6 column">
    <div class="medium-6 column">
      <figure class="grid-small"><img class="bg-img" src="{{asset('img/website/classic/gallery/copper-amphorae-thumb.jpg')}}" alt="@lang('website.altitle.cr-g-2')" />
        <a href="{{asset('img/website/classic/gallery/copper-amphorae.jpg')}}" title="@lang('website.altitle.cr-g-2')"><div class="center-inner"><img src="{{asset('img/website/icons/pluse-icon.png')}}" /></div></a>
      </figure>
    </div>
    <div class="medium-6 column">
      <figure class="grid-small"><img class="bg-img" src="{{asset('img/website/classic/gallery/metal-magazine-rack-thumb.jpg')}}" alt="@lang('website.altitle.cr-g-3')" />
        <a href="{{asset('img/website/classic/gallery/metal-magazine-rack.jpg')}}" title="@lang('website.altitle.cr-g-3')"><div class="center-inner"><img src="{{asset('img/website/icons/pluse-icon.png')}}" /></div></a>
      </figure>
    </div>
    <div class="medium-6 column">
      <figure class="grid-small"><img class="bg-img" src="{{asset('img/website/classic/gallery/elegant-water-pitcher-thumb.jpg')}}" alt="@lang('website.altitle.cr-g-4')" />
        <a href="{{asset('img/website/classic/gallery/elegant-water-pitcher.jpg')}}" title="@lang('website.altitle.cr-g-4')"><div class="center-inner"><img src="{{asset('img/website/icons/pluse-icon.png')}}" /></div></a>
      </figure>
    </div>
    <div class="medium-6 column">
      <figure class="grid-small"><img class="bg-img" src="{{asset('img/website/classic/gallery/classic-planters-plots-thumb.jpg')}}" alt="@lang('website.altitle.cr-g-5')" />
        <a href="{{asset('img/website/classic/gallery/classic-planters-plots.jpg')}}" title="@lang('website.altitle.cr-g-5')"><div class="center-inner"><img src="{{asset('img/website/icons/pluse-icon.png')}}" /></div></a>
      </figure>
    </div>
  </div> 
</div>



<!-- Related Product --> 
<section class="realated-product FWrap">
  <div class="row">
    <div class="small-12 columns">
      <h2 class="title">@lang('website-text.section_products_title')</h2>
      <div class="row-10">
        <ul class="grid-4 angle-arrow wow fadeInUp">

          @foreach($products as $pd)
          <li class="column">
            <div class="product">
              <figure class="center-outer"> <img src="{{asset($pd->base->preview())}}" alt="{{$pd->name}}" /> 
                <figcaption>
                  <ul class="center-inner"> 
                    <li><a data-open="product-box" href="{{route('website-single-product-cr', ['slug' => $pd->slug ])}}"><img src="{{asset('img/website/icons/search.png')}}" /></a></li> 
                  </ul>
                </figcaption> 
              </figure>
              @php $cat = $pd->base->subCategoryCR()->getText(); @endphp
              <div class="product-info"> 
                @if(!is_null($cat))
                <span><a href="{{route('website-products-classic', ['categoria' => $cat->slug ])}}" title="{{$cat->name}}">{{$cat->name}}</a></span>
                @endif
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




@stop
     

@section('page-script')


@stop

