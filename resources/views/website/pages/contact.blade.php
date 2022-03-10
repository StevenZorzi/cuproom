@extends('templates.template-website', ['title' =>  trans('website.meta.contacts-t') , 'description' => trans('website.meta.contacts-d')])  


@section('content')  
    
<section class="contact overly" style="min-height:680px"> <img class="slider-img" src="{{asset('img/website/contact/slide-123.jpg')}}" alt="@lang('website.altitle.contact-slide')" />
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column text-center">
        
        <h1>@lang('website-text.title_form_contact')</h1>
        <ul>
          <li>* @lang('validation.custom.required')</li>
        </ul>
      </div>
    </div>
    <div id="info-request" class="row pt-10 mt-30">

      <div class="medium-8 medium-offset-2 column">

        <form method="post" id="form-contatti" action="{{route('requests.store')}}">
          {{csrf_field()}}
          <div class="row">
            <div class="medium-6 column form-group">
              <input type="text" placeholder="@lang('website-text.form_name')*" class="input-clear" name="name"/>
            </div>
            <div class="medium-6 column form-group">
                <input type="text" placeholder="@lang('website-text.form_surname')*" class="input-clear" name="surname"/>
            </div>
            <div class="medium-6 column form-group">
              <input type="text" placeholder="Email*" class="input-clear" name="email"/>
            </div>
            <div class="medium-6 column form-group">
                <input type="text" placeholder="@lang('website-text.form_phone')" class="input-clear" name="phone"/>
            </div> 
            <div class="medium-12 column form-group">
                <textarea placeholder="@lang('website-text.form_message')*" class="input-clear" name="message">{{$text}}</textarea>
            </div>

            <div class="medium-6 column mt-20">
                <div class="form-group">
                    <div id="captchaContainer"></div>
                </div>
            </div>

            <div class="medium-6 column mt-20">
                <div class="form-group">
                  <span class="text-white text-left">
                    <input style="width: 20px" type="checkbox" name="auth_check" id="auth_check" value="1"/>
                    Ho letto e accetto l'informativa per il Trattamento dei miei dati personali secondo la <a href="//www.iubenda.com/privacy-policy/53980141" class="iubenda-nostyle no-brand iubenda-embed text-underline" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>* &nbsp;
                  </span>
                </div>
            </div>

            <div class="medium-12 column">
              <button type="submit" class="button golden">@lang('website-text.form_btn')</button>
            </div>
          </div>
        </form>

        <br>
        <div class="clearfix"></div>
        @if(Session::has('message'))
        <div class="display_msg">
           {{ Session::get('message') }}
        </div>
        @endif

      </div>
    </div>

  </div>

</section>


<!-- Contact -->
<section class="contact FWrap">
   <h2>@lang('website-text.title_page_contact')</h2>
    <div class="contact-box" style="padding:0">
      <div class="row">
        <div class="medium-4 column">
          <figure><img src="{{asset('img/website/icons/contacts.png')}}" alt="Contacs" /></figure>
          <h4>@lang('website-text.title_contact')</h4>
          <p>
            <a href="mailto:info@celatorito.it">info@celatorito.it</a><br>
            <a href="tel:(+39)0423 302292">+39 0423 302292 </a>
          </p> 
        </div>
        <div class="medium-4 column">
          <figure><img src="{{asset('img/website/icons/map-marker.png')}}" alt="Marker" /></figure>
          <h4>@lang('website-text.title_address')</h4>
          <p>Via Erizzo, 118, 31044 <br/>  Montebelluna (Treviso - Italy)</p>
        </div>
        <div class="medium-4 column">
          <figure><img src="{{asset('img/website/icons/times.png')}}" alt="Time" /></figure>
          <h4>@lang('website-text.title_times')</h4>
          <p> 08.30 - 12.00<br>14.00 - 18.30</p> 
        </div>
      </div>
      <div class="row pt-50">
        <div id="map" class="FWrap"></div>
      </div>
    </div>

    <div class="clearfix"></div>
    
</section>

<!-- Map -->
    

@stop
     

@section('page-script')

{!! Html::script('https://maps.googleapis.com/maps/api/js?key='.env('MAPS_API_KEY')) !!}
{!! Html::script('js/pages/website/map.js') !!}


@stop

