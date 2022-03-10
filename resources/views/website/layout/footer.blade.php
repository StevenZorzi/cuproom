<footer>
  <div class="row">

    <div class="small-12 medium-5 columns">
      <div class="footer-logo small-6 medium-3">
        <div class="text-left">
          <img src="{{asset('img/website/logo-cuproom.png')}}" width="70" alt="Logo Celato Rito" />
        </div>  
      </div>

      <div class="footer-menu small-6 medium-9">
        <h5 class="title-footer">Celato Rito S.R.L.</h5>
        <p>
          P.IVA/C.F. 04301020261
          <br>Via Erizzo 118, 31044 <br> Montebelluna (Treviso) - Italy<br>
          Tel. &nbsp; <a href="tel:+390423302292">+39 0423 302292</a><br>
          E-mail: &nbsp; <a href="mailto:info@celatorito.it">info@celatorito.it</a><br> 
        </p> 
      </div> 
    </div>

    
    <div class="small-12 medium-5 columns">
      <div class="small-6 medium-4 columns">
        <h5 class="title-footer">Brand</h5>
        <ul>
          <li><a href="{{route('website-about')}}" title="{{trans('website.meta.about-t')}}">@lang('website-text.m_about')</a></li>
          <li><a href="{{route('website-team')}}"  title="{{trans('website.meta.team-t')}}">@lang('website-text.m_team')</a></li>
          <li><a href="{{route('website-finishes')}}" title="{{trans('website-text.finishes')}}">@lang('website-text.finishes')</a></li> 
        </ul>  
      </div>  

      <div class="small-6 medium-4 columns">
        <h5 class="title-footer">Policy</h5>
        <ul>
          <li><a href="#" title="">Privacy policy</a></li>
          <li><a href="#" title="">Cookie policy</a></li>
          <li><a href="#" title="">@lang('website-text.m_gest_dati')</a></li>
        </ul>   
      </div> 
    </div>

    <div class="small-12 medium-2 columns">
      <h5 class="title-footer">Seguici su</h5>
      <ul class="social-icon">
        <li><a href="https://www.facebook.com/CelatoRito/" class="fa fa-facebook-f" title="Facebook page"></a></li>
      </ul>
    </div>

    <div class="small-12 columns mt-20">
      <p class="float-left text-left text-white">© <?=date('Y')?> Celato Rito. All rights reserved - Made by <a href="http://web.stevenzorzi.it/" target="_blank">Steven Zorzi</a></p>
    </div>

  </div>
</footer>


 