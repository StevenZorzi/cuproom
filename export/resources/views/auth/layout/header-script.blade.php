
    <!--jQuery [ REQUIRED ]-->
   {!! Html::script('/js/jquery-2.2.1.min.js') !!}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    

    <!--STYLESHEET-->

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    {!! Html::style('css/bootstrap.min.css') !!}


    <!--Nifty Stylesheet [ REQUIRED ]-->
    {!! Html::style('css/nifty.css') !!}

    <!--Nifty Premium Icon [ DEMO ]-->
    {!! Html::style('css/demo/nifty-demo-icons.min.css') !!}

    
    <!--Font Awesome [ OPTIONAL ]-->
    {!! Html::style('plugins/font-awesome/css/font-awesome.min.css') !!}


    <!--Demo [ DEMONSTRATION ]-->
    {!! Html::style('css/demo/nifty-demo.css') !!}


    {!! Html::style('plugins/pace/pace.min.css') !!}



    <!--SCRIPT-->

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    
    {!! Html::script('plugins/pace/pace.min.js') !!}

        
