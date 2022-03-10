@extends('templates.template-admin', ['title' => 'menu.variants'])  

@section('content')

<div class="row text-center">
  <div class="col-sm-12">
    <button class="btn btn-primary btn-rounded btn-labeled btn-control fa fa-plus" data-target="#variant-modal" data-toggle="modal">@lang('interface.add')</button>
  </div>
</div>
<hr>
<div class="row">

  <div class="col-sm-6">
   
      <div class="panel">
          <div class="panel-heading">
              <div class="panel-control">
                
              </div>
              <h3 class="panel-title">@lang('menu.variants') @lang('interface.size')</h3>
          </div>

          <div class="panel-body">
      
            <div class="list-group" id="sortable">
              
              @foreach ($sizes as $size)
              <a id="s_{{ $size->id }}" class="ui-state-default list-group-item variant-list-item">
                  <form>
                      <div class="row">
                        <div class="col-md-9">
                            @foreach($suppLangs as $localeCode => $language)
                            <div class="col-xs-6 pad-no">
                                <div class="input-group" style="width: 100%;">
                                    <span class="input-group-addon" style="padding:6px; width:10px; min-width: 10px;"><img width="15" src="{{ asset('img/flags/'.$localeCode.'.png') }}"></span>
                                    <input type="text" class="form-control" name="name[{{$localeCode}}]" value="{{ $size->getText($localeCode)->name }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-3 text-center pad-no">
                            <button type="button" disabled class="save_variant btn btn-xs btn-success btn-icon btn-circle fa fa-refresh" data-action="{{route('variants.update', ['variant' => $size->id])}}"></button>
                            <button type="button" class="delete_variant btn btn-xs btn-danger btn-icon btn-circle fa fa-times" id="{{ $size->id }}" data-action="{{route('variants.destroy', ['variant' => $size->id])}}" @if($size->isUsed()) disabled @endif></button>
                            <button type="button" class="btn-trsp dropmodal" data-target="#mod-size-{{$size->id}}" data-toggle="modal"><img class="img-circle" src="{{url($size->preview())}}" width="30" height="30"></button>
                        </div>
                      </div>
                  </form>
              </a>
              @endforeach
              
            </div>

          </div>
      </div>

  </div>



  <div class="col-sm-6">

    <div class="panel">
      <div class="panel-heading">
        <div class="panel-control">
        </div>
        <h3 class="panel-title">@lang('menu.variants') @lang('interface.color')</h3>
      </div>

      <div class="panel-body">

        <div class="list-group" id="sortable2">
          
           @foreach ($colors as $color)
           <a id="c_{{ $color->id }}" class="ui-state-default list-group-item variant-list-item">
                <form>
                    <div class="row">
                        <div class="col-md-9">
                            @foreach($suppLangs as $localeCode => $language)
                            <div class="col-xs-6 pad-no">
                                <div class="input-group" style="width: 100%;">
                                    <span class="input-group-addon" style="padding:6px; width:10px; min-width: 10px;"><img src="{{ asset('img/flags/'.$localeCode.'.png') }}"></span>
                                    <input type="text" class="form-control" name="name[{{$localeCode}}]" value="{{ $color->getText($localeCode)->name }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="col-md-3 text-center pad-no">
                          <button type="button" disabled class="save_variant btn btn-xs btn-success btn-icon btn-circle fa fa-refresh" data-action="{{route('variants.update', ['variant' => $color->id])}}"></button>
                          <button type="button" id="{{ $color->id }}" class="delete_variant btn btn-xs btn-danger btn-icon btn-circle fa fa-times" data-action="{{route('variants.destroy', ['variant' => $color->id])}}" @if($color->isUsed()) disabled @endif></button>
                          <button type="button" class="btn-trsp dropmodal" data-target="#mod-color-{{$color->id}}" data-toggle="modal"><img class="img-circle" src="{{url($color->preview())}}" width="30" height="30"></button>
                        </div>

                    </div>
                </form>
            </a>
            @endforeach
          
        </div>
        <!--===================================================-->
      </div>
    </div>
  </div>

</div><!-- /row -->


@stop

@section('modals')

   @foreach ($sizes as $size)

        <div class="modal fade" id="mod-size-{{$size->id}}" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                      <!--Modal header-->
                      <div class="modal-header ">
                          <button data-dismiss="modal" class="close" type="button">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title">@lang('interface.img-assoc')</h4>
                      </div>

                      <!--Modal body-->
                      <div class="modal-body">

                          <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(['url' => route('variants-upload-img', ['variant' => $size->id ]), 'class' => 'dropzone', 'files'=>true, 'id'=>'mod-size-'.$size->id.'-form']) !!}
                                      <input type="hidden" value="{{$size->id}}" name="id">
                                      <div class="dz-message">

                                      </div>

                                      <div class="fallback">
                                          <input name="file" type="file" multiple />
                                      </div>

                                      <div class="dropzone-previews" id="dropzonePreview"></div>

                                {!! Form::close() !!}
                            </div>
                          </div>
                          
                          <div class="clearfix"></div><br>
                      
                      </div>
                        <!--Modal footer-->
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-primary btn-rounded">@lang('interface.close')</button>
                      </div>
                </div>
            </div>
        </div>

    @endforeach

    @foreach ($colors as $color)

        <div class="modal fade" id="mod-color-{{$color->id}}" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                      <!--Modal header-->
                      <div class="modal-header ">
                          <button data-dismiss="modal" class="close" type="button">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title">@lang('interface.img-assoc')</h4>
                      </div>

                      <!--Modal body-->
                      <div class="modal-body">

                          <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(['url' => route('variants-upload-img', ['variant' => $color->id ]), 'class' => 'dropzone', 'files'=>true, 'id'=>'mod-color-'.$color->id.'-form']) !!}
                                      <input type="hidden" value="{{$color->id}}" name="id">
                                      <div class="dz-message">

                                      </div>

                                      <div class="fallback">
                                          <input name="file" type="file" multiple />
                                      </div>

                                      <div class="dropzone-previews" id="dropzonePreview"></div>

                                {!! Form::close() !!}
                            </div>
                          </div>
                          
                          <div class="clearfix"></div><br>
                      
                      </div>
                        <!--Modal footer-->
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-primary btn-rounded">@lang('interface.close')</button>
                      </div>
                </div>
            </div>
        </div>

    @endforeach


@stop


@section('page-script')   
  
   <style type="text/css">
      .dropzone .dz-preview .dz-image {
          width: 100%;
          height: auto;
          position: relative;
          display: block; }
      .dropzone .dz-preview{ width:250px; position:relative; left:50%; margin-left: -125px;}
      .dropzone .dz-message{ margin:0; }
      .dropzone .dz-preview .dz-remove{ left: 110px; }

      .btn-trsp{ border: 1px #f3f3f3 solid; background: 0; padding: 0; border-radius: 15px; }
    </style>

    <script>

    url['noimg'] = "{{url('img/noimg.jpg')}}";
    url['reorder_sizes'] = "{{route('reorder-sizes')}}";
    url['reorder_colors'] = "{{route('reorder-colors')}}";

    url['get_img_info'] = "{{route('get-img-info')}}";
    url['update_img_info'] = "{{route('update-img-info')}}";

    url['path_variants_img'] = "{{url(config('paths.variants_img').'/0')}}";
    url['get_img'] = "{{route('variants-get-img', ['variant' => 0])}}";
    url['delete_img'] = "{{route('variants-delete-img', ['variant' => 0])}}";


    message['ok-update'] = 'Dati salvati con successo';
    message['ok-delete'] = 'Cancellazione avvenuta con successo';
    message['no-update'] = 'Attenzione! Errore durante il salvataggio dei dati, riprovare.';
    message['no-delete'] = 'Attenzione! Errore durante la cancellazione.';

    </script>

    <script src="{{ url('/plugins/ui-jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ url('/js/pages/admin/products/variants.js') }}"></script>
    <script src="{{ url('/js/pages/admin/products/variants-dropzone.js') }}"></script>

@stop
