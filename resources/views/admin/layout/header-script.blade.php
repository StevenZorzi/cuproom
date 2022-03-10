
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
    
    {!! Html::style('/css/bootstrap.min.css') !!}


    <!--Nifty Stylesheet [ REQUIRED ]-->
    {!! Html::style('/css/nifty.css') !!}

    <!--Nifty Premium Icon [ DEMO ]-->
    {!! Html::style('/css/demo/nifty-demo-icons.min.css') !!}

    
    <!--Font Awesome [ OPTIONAL ]-->
    {!! Html::style('/plugins/font-awesome/css/font-awesome.min.css') !!}


    <!--Animate.css [ OPTIONAL ]-->
    {!! Html::style('/plugins/animate-css/animate.min.css') !!}


    <!--Morris.js [ OPTIONAL ]-->
    {!! Html::style('/plugins/morris-js/morris.min.css') !!}


    <!--Switchery [ OPTIONAL ]-->
    {!! Html::style('/plugins/switchery/switchery.min.css') !!}


    <!--Bootstrap Select [ OPTIONAL ]-->
    {!! Html::style('/plugins/bootstrap-select/bootstrap-select.min.css') !!}


    <!--Demo script [ DEMONSTRATION ]-->
    {!! Html::style('/css/demo/nifty-demo.min.css') !!}

    <!--Icon pack -->
    {!! Html::style('/css/premium/line-icons/premium-line-icons.css') !!}
    {!! Html::style('/css/premium/solid-icons/premium-solid-icons.css') !!}
    {!! Html::style('/plugins/ionicons/css/ionicons.min.css') !!}
    {!! Html::style('/plugins/themify-icons/themify-icons.min.css') !!}


    {!! Html::style('/plugins/dropzone/dropzone.css') !!}

    <!--FooTable [ OPTIONAL ]-->
    {!! Html::style('/plugins/footable-bootstrap/css/footable.bootstrap.min.css') !!}

    <!--Summernote [ OPTIONAL ]-->
    {!! Html::style('/plugins/summernote/summernote.min.css') !!}

     <!--Bootstrap Table [ OPTIONAL ]-->
    {!! Html::style('plugins/datatables/media/css/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/extensions/Responsive/css/responsive.dataTables.css') !!}
    {!! Html::style('plugins/datatables/extensions/Responsive/css/responsive.bootstrap.css') !!}


    {!! Html::style('plugins/jstree/proton/style.min.css') !!}

    <!--form Validation-->
    {!! Html::style('plugins/form-validation/css/formValidation.min.css') !!}

    {!! Html::style('plugins/chosen/chosen.min.css') !!}
    

    <!--Summernote [ OPTIONAL ]-->
    {!! Html::style('/css/custom.css') !!}

    {!! Html::style('/plugins/pace/pace.min.css') !!}


    <!--SCRIPT-->
    
    <!--Page Load Progress Bar [ OPTIONAL ]-->
    
    {!! Html::script('/plugins/pace/pace.min.js') !!}


    
    <!--

    REQUIRED
    You must include this in your project.

    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.

    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.

    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.

    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    -->
        
