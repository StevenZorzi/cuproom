@extends('templates.template-website', ['title' =>  trans('website.meta.cr-t') , 'description' => trans('website.meta.cr-d')])


@section('content') 

<!-- Modifica di prova -- Slider -- --> 
<div class="sez-banner">
  <img src="{{asset('img/website/finiture/finiture_01.jpg')}}" alt="@lang('website.altitle.c-slide-1')">
  <div class="inner" style="top: 50%; right: 10%; width: 600px; transform: translateY(-50%);">
    <h1 class="text-white text-center title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.finiture_sez1_title')</h1>
    <p class="text-white wow fadeIn  text-center" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0">@lang('website-text.finiture_sez1_txt')</p> 
  </div>
</div> 

<section class="product-cover FWrap finiture-row" id="finiture">
  <div class="row d-flex">
    <div class="medium-6 order-sm-2 column">
      <div class="row-10 galleryzoom"> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/rame_01.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/rame_01.jpg')}}" title="@lang('website-text.fin-rame_01')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/rame_02.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/rame_02.jpg')}}" title="@lang('website-text.fin-rame_02')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/rame_03.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/rame_03.jpg')}}" title="@lang('website-text.fin-rame_03')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/rame_04.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/rame_04.jpg')}}" title="@lang('website-text.fin-rame_04')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/rame_05.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/rame_05.jpg')}}" title="@lang('website-text.fin-rame_05')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/rame_06.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/rame_06.jpg')}}" title="@lang('website-text.fin-rame_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>   
      </div>
      <div class="clearfix"></div>

      <div class="row vertical menu finiture-accordion" data-accordion-menu> 
        <ul class="menu vertical nested is-active">
          <li> 
            <a class="button link-accordion" type="button" data-toggle="example-dropdown" aria-controls="example-dropdown" data-is-focus="false" data-yeti-box="example-dropdown" aria-haspopup="true" aria-expanded="false">@lang('website-text.vedi_tutte')</a> 
            <ul class="menu vertical nested galleryzoom"> 
              <div class="small-4 column item-small">
                <div class="product">
                  <figure class="center-outer"> 
                    <img src="{{asset('img/website/finiture/rame_04.jpg')}}" alt="">  
                      <figcaption>
                      <ul class="center-inner"> 
                        <li><a href="{{asset('img/website/finiture/rame_04.jpg')}}" title="@lang('website-text.fin-rame_04')">
                          <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                        </li> 
                      </ul>
                    </figcaption>
                  </figure>  
                </div>
              </div> 

              <div class="small-4 column item-small">
                <div class="product">
                  <figure class="center-outer"> 
                    <img src="{{asset('img/website/finiture/rame_05.jpg')}}" alt="">  
                      <figcaption>
                      <ul class="center-inner"> 
                        <li><a href="{{asset('img/website/finiture/rame_05.jpg')}}" title="@lang('website-text.fin-rame_05')">
                          <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                        </li> 
                      </ul>
                    </figcaption>
                  </figure>  
                </div>
              </div> 

              <div class="small-4 column item-small">
                <div class="product">
                  <figure class="center-outer"> 
                    <img src="{{asset('img/website/finiture/rame_06.jpg')}}" alt="">  
                      <figcaption>
                      <ul class="center-inner"> 
                        <li><a href="{{asset('img/website/finiture/rame_06.jpg')}}" title="@lang('website-text.fin-rame_06')">
                          <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                        </li> 
                      </ul>
                    </figcaption>
                  </figure>  
                </div>
              </div> 
            </ul>
          </li> 
        </ul>  
      </div>
      <div class="clearfix"></div>

      <div class="mt-20 col-text">
        <h2 class="title-col">Rame</h2>
        <p class="par-col">Metallo nobile, disponibile nelle versioni liscia e martellata, con finiture: lucida, satinata, brunita, verde scavo, rame cretese.</p>
        <div>
          <img src="{{asset('img/website/finiture/_sostenibile.jpg')}}" width="150" class="mr-20">
          <img src="{{asset('img/website/finiture/_anti-batterico.jpg')}}" width="150">
        </div> 
      </div>
    </div>
    <div class="medium-6 order-sm-1 column">
      <div class="height-100" style="background-image: url({{asset('img/website/finiture/rame.jpg')}});"></div> 
    </div>
  </div>
</section>

<section class="product-cover FWrap finiture-row">
  <div class="row d-flex">
    <div class="medium-6 column">
      <div class="height-100" style="background-image: url({{asset('img/website/finiture/ottone.jpg')}});"></div>
      {{--
      <figure class="collecion-box"><img src="{{asset('img/website/finiture/ottone.jpg')}}" title="@lang('website-text.fin-ott_00')"> 
      </figure> --}}
    </div>
    <div class="medium-6 column">
      <div class="row-10 galleryzoom"> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/ottone_01.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/ottone_01.jpg')}}" title="@lang('website-text.fin-ott_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/ottone_02.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/ottone_02.jpg')}}" title="@lang('website-text.fin-ott_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/ottone_03.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/ottone_03.jpg')}}" title="@lang('website-text.fin-ott_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/ottone_04.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/ottone_04.jpg')}}" title="@lang('website-text.fin-ott_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/ottone_05.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/ottone_05.jpg')}}" title="@lang('website-text.fin-ott_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/ottone_06.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/ottone_06.jpg')}}" title="@lang('website-text.fin-ott_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>  
      </div>
      <div class="clearfix"></div>

      <div class="row vertical menu finiture-accordion" data-accordion-menu> 
          <ul class="menu vertical nested is-active">
            <li> 
              <a class="button link-accordion" type="button" data-toggle="example-dropdown" aria-controls="example-dropdown" data-is-focus="false" data-yeti-box="example-dropdown" aria-haspopup="true" aria-expanded="false">@lang('website-text.vedi_tutte')</a> 
              <ul class="menu vertical nested galleryzoom"> 
                <div class="small-4 column item-small">
                  <div class="product">
                    <figure class="center-outer"> 
                      <img src="{{asset('img/website/finiture/ottone_04.jpg')}}" alt="">  
                        <figcaption>
                        <ul class="center-inner"> 
                          <li><a href="{{asset('img/website/finiture/ottone_04.jpg')}}" title="@lang('website-text.fin-ott_06')">
                            <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                          </li> 
                        </ul>
                      </figcaption>
                    </figure>  
                  </div>
                </div> 

                <div class="small-4 column item-small">
                  <div class="product">
                    <figure class="center-outer"> 
                      <img src="{{asset('img/website/finiture/ottone_05.jpg')}}" alt="">  
                        <figcaption>
                        <ul class="center-inner"> 
                          <li><a href="{{asset('img/website/finiture/ottone_05.jpg')}}" title="@lang('website-text.fin-ott_06')">
                            <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                          </li> 
                        </ul>
                      </figcaption>
                    </figure>  
                  </div>
                </div> 

                <div class="small-4 column item-small">
                  <div class="product">
                    <figure class="center-outer"> 
                      <img src="{{asset('img/website/finiture/ottone_06.jpg')}}" alt="">  
                        <figcaption>
                        <ul class="center-inner"> 
                          <li><a href="{{asset('img/website/finiture/ottone_06.jpg')}}" title="@lang('website-text.fin-ott_06')">
                            <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                          </li> 
                        </ul>
                      </figcaption>
                    </figure>  
                  </div>
                </div>  
              </ul>
            </li> 
          </ul>  
        </div>
        <div class="clearfix"></div>

      <div class="mt-20 col-text">
        <h2 class="title-col">Ottone</h2>
        <p class="par-col">Lega del rame, disponibile nelle versioni liscia e martellata, con finiture: lucida, satinata e brunita.</p>
        <div>
          <img src="{{asset('img/website/finiture/_sostenibile.jpg')}}" width="150" class="mr-20">
          <img src="{{asset('img/website/finiture/_anti-batterico.jpg')}}" width="150">
        </div>
      </div>
    </div> 
  </div>
</section>

<section class="product-cover FWrap finiture-row">
  <div class="row d-flex">
    <div class="medium-6 order-sm-2 column">
      <div class="row-10 galleryzoom"> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/alluminioeacciaio_01.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/alluminioeacciaio_01.jpg')}}" title="@lang('website-text.fin-all_01')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/alluminioeacciaio_02.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/alluminioeacciaio_02.jpg')}}" title="@lang('website-text.fin-all_02')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/alluminioeacciaio_03.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/alluminioeacciaio_03.jpg')}}" title="@lang('website-text.fin-all_03')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/alluminioeacciaio_04.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/alluminioeacciaio_04.jpg')}}" title="@lang('website-text.fin-all_04')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/alluminioeacciaio_05.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/alluminioeacciaio_05.jpg')}}" title="@lang('website-text.fin-all_05')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div> 

        <div class="small-4 column item-small">
          <div class="product">
            <figure class="center-outer"> 
              <img src="{{asset('img/website/finiture/alluminioeacciaio_06.jpg')}}" alt="">  
                <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/alluminioeacciaio_06.jpg')}}" title="@lang('website-text.fin-all_06')">
                    <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                  </li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>  

      </div>
      <div class="clearfix"></div>

      <div class="row vertical menu finiture-accordion" data-accordion-menu> 
          <ul class="menu vertical nested is-active">
            <li> 
              <a class="button link-accordion" type="button" data-toggle="example-dropdown" aria-controls="example-dropdown" data-is-focus="false" data-yeti-box="example-dropdown" aria-haspopup="true" aria-expanded="false">@lang('website-text.vedi_tutte')</a> 
              <ul class="menu vertical nested galleryzoom"> 
                <div class="small-4 column item-small">
                  <div class="product">
                    <figure class="center-outer"> 
                      <img src="{{asset('img/website/finiture/alluminioeacciaio_01.jpg')}}" alt="">  
                        <figcaption>
                        <ul class="center-inner"> 
                          <li><a href="{{asset('img/website/finiture/alluminioeacciaio_01.jpg')}}" title="@lang('website-text.fin-all_01')">
                            <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                          </li> 
                        </ul>
                      </figcaption>
                    </figure>  
                  </div>
                </div> 

                <div class="small-4 column item-small">
                  <div class="product">
                    <figure class="center-outer"> 
                      <img src="{{asset('img/website/finiture/alluminioeacciaio_02.jpg')}}" alt="">  
                        <figcaption>
                        <ul class="center-inner"> 
                          <li><a href="{{asset('img/website/finiture/alluminioeacciaio_02.jpg')}}" title="@lang('website-text.fin-all_02')">
                            <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                          </li> 
                        </ul>
                      </figcaption>
                    </figure>  
                  </div>
                </div> 

                <div class="small-4 column item-small">
                  <div class="product">
                    <figure class="center-outer"> 
                      <img src="{{asset('img/website/finiture/alluminioeacciaio_03.jpg')}}" alt="">  
                        <figcaption>
                        <ul class="center-inner"> 
                          <li><a href="{{asset('img/website/finiture/alluminioeacciaio_03.jpg')}}" title="@lang('website-text.fin-all_03')">
                            <span><img src="{{asset('img/website/icons/search.png')}}" alt=""></span></a>
                          </li> 
                        </ul>
                      </figcaption>
                    </figure>  
                  </div>
                </div>  
              </ul>
            </li> 
          </ul>  
        </div>
        <div class="clearfix"></div>

      <div class="mt-20 col-text">
        <h2 class="title-col">Alluminio e acciaio inox</h2>
        <p class="par-col">Alluminio e acciaio inox, disponibile nelle versioni liscia e martellata, con finiture: lucida, satinata e brunita.</p>
      </div>
    </div>
    <div class="medium-6 order-sm-1 column">
      {{--
      <figure class="collecion-box">
        <img src="{{asset('img/website/finiture/alluminioeacciaio.jpg')}}" title="@lang('website-text.fin-all_00')"> 
      </figure> --}}
      <div class="height-100" style="background-image: url({{asset('img/website/finiture/alluminioeacciaio.jpg')}});"></div>
    </div>
  </div>
</section>


<!-- Modifica di prova -- Slider -- --> 
<div class="sez-banner FWrap">
  <img src="{{asset('img/website/finiture/finiture_02.jpg')}}" alt="@lang('website-text.finiture_sez2_title')">
  <div class="inner" style="top: 15%; width: 400px; left: 20%;">
    <h1 class="text-white text-center title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.finiture_sez2_title')</h1>
    <p class="text-white wow fadeIn  text-center" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0">@lang('website-text.finiture_sez2_txt')</p> 
  </div>
</div>  


<section class="product-cover galleryzoom FWrap">
  <div class="row">
    <div class="medium-12 column">

      <div class="row">
        <div class="small-4 medium-3 column">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_01.jpg')}}" alt="@lang('website-text.fin-106')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_01.jpg')}}" title="@lang('website-text.fin-106')"><span>@lang('website-text.fin-106')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_02.jpg')}}" alt="@lang('website-text.fin-111')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_02.jpg')}}" title="@lang('website-text.fin-111')"><span>@lang('website-text.fin-111')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_03.jpg')}}" alt="@lang('website-text.fin-120')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_03.jpg')}}" title="@lang('website-text.fin-120')"><span>@lang('website-text.fin-120')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_04.jpg')}}" alt="@lang('website-text.fin-130')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_04.jpg')}}" title="@lang('website-text.fin-130')"><span>@lang('website-text.fin-130')</span></a></li> 
                </ul>
              </figcaption>
            </figure>
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_05.jpg')}}" alt="@lang('website-text.fin-142')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_05.jpg')}}" title="@lang('website-text.fin-142')"><span>@lang('website-text.fin-142')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_06.jpg')}}" alt="@lang('website-text.fin-144')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_06.jpg')}}" title="@lang('website-text.fin-144')"><span>@lang('website-text.fin-144')</span></a></li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_07.jpg')}}" alt="@lang('website-text.fin-150')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_07.jpg')}}" title="@lang('website-text.fin-150')"><span>@lang('website-text.fin-150')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_08.jpg')}}" alt="@lang('website-text.fin-203')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_08.jpg')}}" title="@lang('website-text.fin-203')"><span>@lang('website-text.fin-203')</span></a></li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_09.jpg')}}" alt="@lang('website-text.fin-212')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_09.jpg')}}" title="@lang('website-text.fin-212')"><span>@lang('website-text.fin-212')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_10.jpg')}}" alt="@lang('website-text.fin-214')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_10.jpg')}}" title="@lang('website-text.fin-214')"><span>@lang('website-text.fin-214')</span></a></li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_11.jpg')}}" alt="@lang('website-text.fin-218')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_11.jpg')}}" title="@lang('website-text.fin-218')"><span>@lang('website-text.fin-218')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_12.jpg')}}" alt="@lang('website-text.fin-230')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_12.jpg')}}" title="@lang('website-text.fin-230')"><span>@lang('website-text.fin-230')</span></a></li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_13.jpg')}}" alt="@lang('website-text.fin-277')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_13.jpg')}}" title="@lang('website-text.fin-277')"><span>@lang('website-text.fin-277')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_14.jpg')}}" alt="@lang('website-text.fin-290')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_14.jpg')}}" title="@lang('website-text.fin-290')"><span>@lang('website-text.fin-290')</span></a></li> 
                </ul>
              </figcaption>
            </figure>  
          </div>
        </div>
        <div class="small-4 medium-3 column mb-20">
          <div class="product">
            <figure class="center-outer"> <img src="{{asset('img/website/finiture/lavorazioni_15.jpg')}}" alt="@lang('website-text.fin-309')" />
              <figcaption>
                <ul class="center-inner"> 
                  <li><a href="{{asset('img/website/finiture/lavorazioni_15.jpg')}}" title="@lang('website-text.fin-309')"><span>@lang('website-text.fin-309')</span></a></li> 
                </ul>
              </figcaption>
            </figure> 
          </div>
        </div>
        
      </div>
    </div>

  </div> 
</section>
<!-- fine finiture -->
 
<div class="sez-banner FWrap">
  <img src="{{asset('img/website/finiture/finiture_03.jpg')}}" alt="@lang('website-text.finiture_sez3_title')">
  <div class="inner" style="top: 50%; left: 20%; width: 600px; transform: translateY(-50%);">
    <h1 class="text-white text-center title-intro wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1.6s" data-wow-offset="0">@lang('website-text.finiture_sez3_title')</h1> 
    <div class="text-center mt-50 wow fadeIn" data-wow-delay="1.5s" data-wow-duration="2.5s" data-wow-offset="0">
      <a href="{{route('website-projects')}}" class="button-type-1 white">@lang('website-text.finiture_sez3_txt')</a>  
    </div>
  </div>
</div>  



@stop
     

@section('page-script')

<style>
  figcaption ul { height: 100%; }
  figcaption ul li{ display:block; width: 100%; height: 100%; }
  figcaption ul li a{ display:block !important; width: 100% !important; height: 100% !important; background: none !important; position: relative; }
  figcaption ul li a span{ display:block; top: 48%; position: relative; font-size: 18px; }
</style>


@stop

