<!DOCTYPE html>
<html lang="{{$lang}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@if(isset($meta)){{$meta->title}}@else{{ucfirst(trans($title))}} | {{$appName}}@endif</title>
    <meta name="description" content="@if(isset($meta)){{$meta->description}}@else{{ucfirst(trans($description))}}@endif">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('img/website/favicon.png')}}" sizes="32x32"> 
    @if(isset($canonical))
        {!!$canonical!!}
    @endif


    @if($lang == 'it')
        <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = {"invalidateConsentWithoutLog":true,"consentOnContinuedBrowsing":false,"perPurposeConsent":true,"whitelabel":false,"lang":"it","siteId":1084426,"askConsentAtCookiePolicyUpdate":true,"cookiePolicyId":12125931, "banner":{ "closeButtonRejects":true,"acceptButtonDisplay":true,"customizeButtonDisplay":true,"acceptButtonColor":"#ea2e2b","acceptButtonCaptionColor":"white","customizeButtonColor":"#212121","customizeButtonCaptionColor":"white","rejectButtonDisplay":true,"rejectButtonColor":"#212121","rejectButtonCaptionColor":"white","listPurposes":true,"explicitWithdrawal":true,"position":"float-bottom-center","textColor":"white","backgroundColor":"#000001" }};
        </script>
        <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>

    @else

        <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = {"invalidateConsentWithoutLog":true,"consentOnContinuedBrowsing":false,"perPurposeConsent":true,"whitelabel":false,"lang":"en","siteId":1084426,"askConsentAtCookiePolicyUpdate":true,"cookiePolicyId":53980141, "banner":{ "closeButtonRejects":true,"acceptButtonDisplay":true,"customizeButtonDisplay":true,"acceptButtonColor":"#ea2e2b","acceptButtonCaptionColor":"white","customizeButtonColor":"#212121","customizeButtonCaptionColor":"white","rejectButtonDisplay":true,"rejectButtonColor":"#212121","rejectButtonCaptionColor":"white","listPurposes":true,"explicitWithdrawal":true,"position":"float-bottom-center","textColor":"white","backgroundColor":"#000001" }};
        </script>
        <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>

    @endif

    @include('include.analytics')
    @include('website.layout.header-script')

</head>
    <body>

        <!-- preloader -->
        <div id="preloader">
          <div id="status">&nbsp;</div>
        </div>

        <div class="app-container">
        
            @include('website.layout.navbar')

            <div class="body-container">
                
                @yield('content')

                @include('website.layout.footer')

            </div>

        </div>

    @include('website.layout.footer-script')

    @yield('page-script')

    </body>
</html>
