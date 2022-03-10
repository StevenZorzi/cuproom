
<!-- BLOG -->

@can('view', App\Models\Core\Module::find(1))

<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

  <div class="modal fade" id="global-add-blog" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- BASIC FORM ELEMENTS -->
              <!--===================================================-->
              <form action="{{route('blog.store')}}" method="POST">

                  {{ csrf_field() }}
                  <!--Modal header-->
                  <div class="modal-header ">
                      <button data-dismiss="modal" class="close" type="button">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Nuovo Articolo</h4>
                  </div>

                  <!--Modal body-->
                  <div class="modal-body">

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <select class="form-control selectpicker" name="lang">
                                      <option value="">Seleziona per quale lingua...</option>
                                      @foreach($suppLangs as $localeCode => $language)
                                      <option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control title-modal" name="title" placeholder="Inserire titolo...">
                            </div>
                        </div>
                      </div>
                      
                      <div class="clearfix"></div><br>
                  
                  </div>
                    <!--Modal footer-->
                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default btn-rounded">@lang('interface.canceling')</button>
                      <button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!--End Modal-->
  <script>
  $(document).ready(function() {
      $('#global-add-blog form').formValidation({
          // I am validating Bootstrap form
          framework: 'bootstrap',
          // Feedback icons
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },

          // List of fields and their validation rules
          fields: {
              lang: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              },
              title: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              }
          }
      })
      .on('success.field.fv', function(e, data) {
        // Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

      });
  });
  </script>


@endcan


<!-- PORTFOLIO -->

@can('view', App\Models\Core\Module::find(2))

<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

  <div class="modal fade" id="global-add-portfolio" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- BASIC FORM ELEMENTS -->
              <!--===================================================-->
              <form action="{{route('portfolio.store')}}" method="POST">
                {{ csrf_field() }}

                <!--Modal header-->
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Nuovo Progetto</h4>
                </div>

                  <!--Modal body-->
                  <div class="modal-body">

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker" name="lang">
                                <option value="">Seleziona per quale lingua...</option>
                                @foreach($suppLangs as $localeCode => $language)
                                <option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
                                @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control title-modal" name="title" placeholder="Inserire titolo...">
                          </div>
                      </div>
                    </div>
                    
                    <div class="clearfix"></div><br>
                  <!--===================================================-->
                  <!-- END BASIC FORM ELEMENTS -->
                </div>
                  <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default btn-rounded">@lang('interface.canceling')</button>
                    <button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!--End Modal-->
  <script>
  $(document).ready(function() {
      $('#global-add-portfolio form').formValidation({
          // I am validating Bootstrap form
          framework: 'bootstrap',
          // Feedback icons
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },

          // List of fields and their validation rules
          fields: {
              lang: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              },
              title: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              }
          }
      })
      .on('success.field.fv', function(e, data) {
        // Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

      });
  });
  </script>

@endcan


<!-- GALLERY -->

@can('view', App\Models\Core\Module::find(4))

<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

  <div class="modal fade" id="global-add-gallery" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- BASIC FORM ELEMENTS -->
              <!--===================================================-->
              <form action="{{route('gallery.store')}}" method="POST">
                {{ csrf_field() }}

                <!--Modal header-->
                <div class="modal-header ">
                    <button data-dismiss="modal" class="close" type="button">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Nuova Gallery</h4>
                </div>

                  <!--Modal body-->
                  <div class="modal-body">

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <select class="form-control selectpicker" name="lang">
                                <option value="">Seleziona per quale lingua...</option>
                                @foreach($suppLangs as $localeCode => $language)
                                <option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
                                @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control title-modal" name="title" placeholder="Inserire titolo...">
                          </div>
                      </div>
                    </div>
                    
                    <div class="clearfix"></div><br>
                  <!--===================================================-->
                  <!-- END BASIC FORM ELEMENTS -->
                </div>
                  <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default btn-rounded">@lang('interface.canceling')</button>
                    <button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!--End Modal-->
  <script>
  $(document).ready(function() {
      $('#global-add-gallery form').formValidation({
          // I am validating Bootstrap form
          framework: 'bootstrap',
          // Feedback icons
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },

          // List of fields and their validation rules
          fields: {
              lang: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              },
              title: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              }
          }
      })
      .on('success.field.fv', function(e, data) {
        // Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

      });
  });
  </script>

@endcan


<!-- PRODOTTI -->

@can('view', App\Models\Core\Module::find(3))

<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

  <div class="modal fade" id="global-add-product" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- BASIC FORM ELEMENTS -->
              <!--===================================================-->
              <form action="{{route('products.store')}}" method="POST">
                  
                  {{ csrf_field() }}

                  <!--Modal header-->
                  <div class="modal-header ">
                      <button data-dismiss="modal" class="close" type="button">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Nuovo @lang('interface.product')</h4>
                  </div>

                  <!--Modal body-->
                  <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control selectpicker" name="lang">
                                    <option value="">Seleziona per quale lingua...</option>
                                    @foreach($suppLangs as $localeCode => $language)
                                    <option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control title-modal" name="name" placeholder="Inserire nome prodotto...">
                            </div>
                        </div>
                    </div>
                </div>
                  <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default btn-rounded">@lang('interface.canceling')</button>
                    <button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>


  <!--End Modal-->

  <div class="modal fade" id="variant-modal" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <form action="{{ route('variants.store') }}" method="post">
                  {{ csrf_field() }}

                  <!--Modal header-->
                  <div class="modal-header ">
                      <button data-dismiss="modal" class="close" type="button">
                      <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Aggiungi variante</h4>
                  </div>

                  <!--Modal body-->
                  <div class="modal-body">
                      
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label"><small>Tipologia</small></label>
                                  <select class="form-control selectpicker" name="type">
                                      <option value="size">{{ucfirst(trans('interface.size'))}}</option>
                                      <option value="color">{{ucfirst(trans('interface.color'))}}</option>
                                  </select>
                              </div>
                          </div>
                      </div>

                      <label class="control-label"><small>Nome descrittivo</small></label>
                      <div class="row">

                          @foreach($suppLangs as $localeCode => $language)
                          <div class="col-md-6">
                              <div class="input-group">
                                  <span class="input-group-addon"><img src="{{ asset('img/flags/'.$localeCode.'.png') }}"></span>
                                  <input type="text" class="form-control" name="name[{{$localeCode}}]">
                              </div>
                          </div>
                          @endforeach
                      </div>
                    
                  </div>

                  <!--Modal footer-->
                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default btn-rounded">@lang('interface.canceling')</button>
                      <button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
  
  <script>
  $(document).ready(function() {
      $('#global-add-product form').formValidation({
          // I am validating Bootstrap form
          framework: 'bootstrap',
          // Feedback icons
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },

          // List of fields and their validation rules
          fields: {
              lang: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              },
              name: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              }
          }
      })
      .on('success.field.fv', function(e, data) {
        // Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

      });


      $('#variant-modal form').formValidation({
          // I am validating Bootstrap form
          framework: 'bootstrap',
          // Feedback icons
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },

          // List of fields and their validation rules
          fields: {
              type: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              },
              name: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              }
          }
      })
      .on('success.field.fv', function(e, data) {
        // Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

      });
  });
  </script>

@endcan




<!-- BRANDS -->

@can('view', App\Models\Core\Module::find(6))

<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

  <div class="modal fade" id="global-add-brand" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- BASIC FORM ELEMENTS -->
              <!--===================================================-->
              <form action="{{route('brands.store')}}" method="POST">
                  
                  {{ csrf_field() }}

                  <!--Modal header-->
                  <div class="modal-header ">
                      <button data-dismiss="modal" class="close" type="button">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Nuovo @lang('interface.brand')</h4>
                  </div>

                  <!--Modal body-->
                  <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control selectpicker" name="lang">
                                    <option value="">Seleziona per quale lingua...</option>
                                    @foreach($suppLangs as $localeCode => $language)
                                    <option value="{{$localeCode}}" data-content="{{select_languages($language, $localeCode)}}" ></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control title-modal" name="name" placeholder="Inserire nome @lang('interface.brand')...">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div><br>
                </div>
                  <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default btn-rounded">@lang('interface.canceling')</button>
                    <button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <script>
  $(document).ready(function() {
      $('#global-add-brand form').formValidation({
          // I am validating Bootstrap form
          framework: 'bootstrap',
          // Feedback icons
          icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },

          // List of fields and their validation rules
          fields: {
              lang: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              },
              name: {
                  validators: {
                      notEmpty: {
                          message: v['not-empty']
                      }
                  }
              }
          }
      })
      .on('success.field.fv', function(e, data) {
        // Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

      });
  });
  </script>

@endcan



<!-- USER -->

@can('create', App\User::class)

<!-- MODAL PER AGGIUNTA LINGUE - Default Bootstrap Modal-->

  <div class="modal fade" id="global-add-user" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- BASIC FORM ELEMENTS -->
              <!--===================================================-->
              <form action="{{route('users.store')}}" method="POST">
                  {{ csrf_field() }}

                  <!--Modal header-->
                  <div class="modal-header ">
                      <button data-dismiss="modal" class="close" type="button">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Nuovo Utente</h4>
                  </div>

                  <!--Modal body-->
                  <div class="modal-body">

                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <small>@lang('interface.name')</small>
                                  <input class="form-control" name="name" type="text">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <small>@lang('interface.surname')</small>
                                  <input class="form-control" name="surname" type="text">
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-sm-7">
                              <div class="form-group">
                                  <small>E-mail</small>
                                  <input class="form-control" name="newemail" type="text">
                              </div>
                          </div>
                          <div class="col-sm-5">
                              <div class="form-group">
                                  <small>@lang('interface.gender')</small>
                                  <select class="form-control selectpicker" name="gender">
                                      <option value="M">Maschio</option>
                                      <option value="F">Femmina</option>
                                  </select>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <small>@lang('interface.type')</small>
                                  <select class="form-control selectpicker" name="role">
                                      <option value="user">User</option>
                                      <option value="admin">Admin</option>
                                      @if($authUser->isSuperAdmin())<option value="superadmin">SuperAdmin</option>@endif
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <small>Password</small>
                                  <input class="form-control" name="pwd" type="text" value="{{str_random(10)}}">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <small for="lang">@lang('interface.timezone')</small>
                                  <select class="selectpicker" id="timezone" name="timezone" data-live-search="search" data-size="10" data-width="100%">
                                  @include('include.timezone-select')
                                  </select>
                              </div>
                          </div>
                          
                      </div>
                      
                      <hr>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label class="form-checkbox form-icon active">
                                      <input type="checkbox" name="send"> <small class="text-muted">Invia e-mail all'utente con la password</small>
                                  </label>
                              </div>
                          </div>
                      </div>
                    
                    <!-- END BASIC FORM ELEMENTS -->
                  </div>

                    <!--Modal footer-->
                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default btn-rounded">@lang('interface.canceling')</button>
                      <button type="submit" class="btn btn-primary btn-rounded">@lang('interface.add')</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!--End Modal-->

  <script>
      $(document).ready(function() {

        $('#global-add-user form').formValidation({
            // I am validating Bootstrap form
            framework: 'bootstrap',
            excluded: [':disabled'],
            // Feedback icons
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },

            // List of fields and their validation rules
            fields: {
                role: {
                    validators: {
                        notEmpty: {
                            message: v['not-empty'],
                        }
                    }
                },
                name: {
                    validators: {
                        notEmpty: {
                            message: v['not-empty']
                        }
                    }
                },
                surname: {
                    validators: {
                        notEmpty: {
                            message: v['not-empty']
                        }
                    }
                },
                newemail: {
                  verbose: false, //verifica la validazione del campo regola per regola
                    validators: {
                        notEmpty: {
                            message: v['not-empty']
                        },
                        emailAddress: {
                            message: v['email-wrong']
                        },
                        remote: {
                          message: v['email-just'],
                          url: "{{route('user-check-email', ['user' => $authUser->id])}}",
                          type: 'POST'
                        }

                    }
                },
                lang: {
                    validators: {
                        notEmpty: {
                            message: v['not-empty']
                        }
                    }
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: v['not-empty']
                        }
                    }
                },
                timezone: {
                    validators: {
                        notEmpty: {
                            message: v['not-empty']
                        }
                    }
                },
            }
        })
        .on('success.field.fv', function(e, data) {
          // Non mostrare success
            var $parent = data.element.parents('.form-group');
            $parent.removeClass('has-success');
            data.element.data('fv.icon').hide();

        });
      });
  </script>

@endcan