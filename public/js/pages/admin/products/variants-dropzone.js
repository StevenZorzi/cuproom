Dropzone.autoDiscover = false;

$(document).on('click','.dropmodal',function(){

    var thumb = $(this);
    var element = $(this).attr('data-target');

    if(!$(element+'-form').hasClass('dz-clickable')){

        var v_id = $(element+'-form').find('input[name=id]').val();

        var myDropzone = new Dropzone(element+'-form', {

            uploadMultiple: false,
            maxFiles: 1,
            parallelUploads: 100,
            maxFilesize: 4,
            //previewsContainer: '#dropzonePreview',
            addRemoveLinks: true,
            dictRemoveFileConfirmation: "Sicuro di voler cancellare questa immagine?",
            dictRemoveFile: 'x',
            dictFileTooBig: 'Le dimensioni dell\'immagine superano i 4MB consentiti',
            dictMaxFilesExceeded: 'Può essere caricata solo un\'immagine',
            thumbnailWidth: null,
            thumbnailHeight: null,

            // The setting up of the dropzone
            init:function() {

                // Add server images
                var myDropzone = this;

                $.get(url['get_img'].substring(0,url['get_img'].length-1)+ v_id, function(data) {

                    var i = 0;
                    $.each(data.images, function (key, value) {
                        i++;
                        var file = {id: value.id, name: value.original, size: value.size, accepted: true};
                        myDropzone.emit("addedfile", file);
                        myDropzone.createThumbnailFromUrl(file, url['path_variants_img'].substring(0,url['path_variants_img'].length-1)+ v_id + "/small-" + value.server );
                        $(file.previewElement).prop('id', 'img_'+value.id);
                        myDropzone.emit("complete", file);
                        myDropzone.files.push(file);
                    });
                    if(i==0)
                        $(element+'-form').addClass("file-upload");

                })

                this.on("maxfilesexceeded", function(file) {
                });

                this.on("removedfile", function(file) {
                    $.ajax({
                        type: 'POST',
                        url: url['delete_img'].substring(0,url['delete_img'].length-1)+ v_id,
                        data: {id: file.id, _token: $('#csrf-token').val()},
                        dataType: 'html',
                        success: function(data){
                            success('img-delete');
                            
                            thumb.find('img').attr('src', url['noimg']);

                            if(myDropzone.files.length > 0){
                                $("#dropzonePreview").trigger('sortupdate');

                            }else{
                                $(element+'-form').addClass("file-upload");
                            }

                        },
                        error: function(data){

                            error('no-delete');
                        }
                    });

                });

                this.on("addedfile", function(file) {
                    $(element+'-form').removeClass("file-upload");
                    
                });
            },
            error: function(file, response) {
                if($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function(file,done) {
                file.id = done.id;
                $(file.previewElement).prop('id', 'img_'+file.id);

                thumb.find('img').attr('src', url['path_variants_img'].substring(0,url['path_variants_img'].length-1)+ v_id + "/thumb-" + done.filename);
            }

        });
    }
});